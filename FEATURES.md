# CMS Module Collection Features

Functional contract for `softspring/cms-module-collection` on `6.1`.

## Implemented capabilities

- Provide reusable definitions, Symfony form options, Twig rendering/edit templates, translations and browser assets for Armonic CMS modules.
- Include button, card, carousel, code, embed_video, hero, media, paragraph, quote, text_section, title, two_columns, wysiwyg and wysiwyg_translatable modules.
- Declare `module.meta.ai_instructions` for every shipped module, describing its intended use, composition choices and alternatives.
- Recommend individual paragraph modules for ordinary body copy and reserve wysiwyg modules for content that needs richer HTML.
- Recommend visually strong hero imagery while keeping text readable and respecting the configured media requirements.
- Let project collections override guidance through the normal CMS definition precedence.
- Expose guidance through the CMS shared serializers, API/MCP context and module prototypes when those integrations are enabled.
- Preserve existing module revisions, stored data, form fields and rendering behavior when adding or changing instructions.

## Limits

- Module availability is controlled by the host CMS configuration and container restrictions.
- Guidance does not grant permissions, replace form validation or authorize publication.
- Assistant behavior depends on the client and model consuming the guidance.
