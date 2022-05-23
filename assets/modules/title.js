document.addEventListener('change', function (event) {
    if (!event.target || !event.target.hasAttribute('data-cms-module-title-type-field')) return;
    event.preventDefault();

    let preview = event.target.closest('.cms-module-edit').querySelector('.module-preview');
    let htmlElement = preview.querySelector("[data-cms-module-title-type]");

    htmlElement.outerHTML = htmlElement.outerHTML.trim()
        .replace('<'+htmlElement.nodeName.toLowerCase()+' ','<'+event.target.value+' ')
        .replace('</'+htmlElement.nodeName.toLowerCase()+'>','</'+event.target.value+'>');
});