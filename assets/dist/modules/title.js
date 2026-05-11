/**
 * @deprecated
 */
document.addEventListener('change', function (event) {
    if (!event.target || !event.target.hasAttribute('data-cms-module-title-type-field')) return;
    event.preventDefault();

    console.log('data-cms-module-title-type-field is deprecated, use data-edit-tag-type-input instead');

    let preview = event.target.closest('.cms-module-edit').querySelector('.module-preview');
    let htmlElements = preview.querySelectorAll("[data-cms-module-title-type]");

    if (htmlElements.length) {
        htmlElements.forEach(function(htmlElement) {
            htmlElement.outerHTML = htmlElement.outerHTML.trim()
                .replace('<'+htmlElement.nodeName.toLowerCase()+' ','<'+event.target.value+' ')
                .replace('</'+htmlElement.nodeName.toLowerCase()+'>','</'+event.target.value+'>');
        });
    }
});
