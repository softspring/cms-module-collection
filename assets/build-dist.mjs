import {access, cp, mkdir, readdir, rm, writeFile} from 'node:fs/promises';
import {constants} from 'node:fs';
import {dirname, join, relative, resolve} from 'node:path';
import {fileURLToPath} from 'node:url';

const {compile} = await import('sass');

const assetsRoot = fileURLToPath(new URL('.', import.meta.url));
const bundleRoot = resolve(assetsRoot, '..');
const distRoot = resolve(assetsRoot, 'dist');
const loadPaths = [resolve(bundleRoot, 'node_modules')];

await rm(distRoot, {recursive: true, force: true});
await mkdir(distRoot, {recursive: true});

async function copyDirectory(sourceDir, targetDir) {
  await mkdir(targetDir, {recursive: true});

  const items = await readdir(sourceDir, {withFileTypes: true});
  for (const item of items) {
    const sourcePath = join(sourceDir, item.name);
    const targetPath = join(targetDir, item.name);

    if (item.isDirectory()) {
      await copyDirectory(sourcePath, targetPath);
      continue;
    }

    if (item.name.endsWith('.scss')) {
      continue;
    }

    await cp(sourcePath, targetPath);
  }
}

for (const entry of ['modules.js']) {
  const source = resolve(assetsRoot, entry);
  try {
    await access(source, constants.F_OK);
    await cp(source, resolve(distRoot, entry));
  } catch {
    // Optional asset files are skipped.
  }
}

for (const entry of ['modules']) {
  const source = resolve(assetsRoot, entry);
  try {
    await access(source, constants.F_OK);
    await copyDirectory(source, resolve(distRoot, entry));
  } catch {
    // Optional asset folders are skipped.
  }
}

async function compileScssFiles(sourceDir) {
  const items = await readdir(sourceDir, {withFileTypes: true});

  for (const item of items) {
    const sourcePath = resolve(sourceDir, item.name);

    if (item.name === 'dist' || item.name === 'node_modules') {
      continue;
    }

    if (item.isDirectory()) {
      await compileScssFiles(sourcePath);
      continue;
    }

    if (!item.isFile() || !item.name.endsWith('.scss') || item.name.startsWith('_')) {
      continue;
    }

    const css = compile(sourcePath, {
      style: 'expanded',
      loadPaths: [assetsRoot, ...loadPaths],
    }).css;

    const targetPath = resolve(distRoot, relative(assetsRoot, sourcePath).replace(/\.scss$/, '.css'));
    await mkdir(dirname(targetPath), {recursive: true});
    await writeFile(targetPath, css);
  }
}

await compileScssFiles(assetsRoot);
