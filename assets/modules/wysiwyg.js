// Simulate .on function
function delegate(el, evt, sel, handler) {
  el.addEventListener(evt, function(event) {
    var t = event.target;
    while (t && t !== this) {
      if (t.matches(sel)) {
        handler.call(t, event);
      }
      t = t.parentNode;
    }
  });
}
window.addEventListener('load', function () {
  if (typeof tinyMCE !== 'undefined') {
    delegate(document, 'hidden.bs.modal', '[data-wysiwyg-modal]', function(event) {
      var modal = event.target,
        moduleCont = event.target.closest('[data-edit-id-target]');
      var field = modal.querySelector('#' + tinyMCE.activeEditor.id).getAttribute('data-edit-content-input');

      if(field !== 'null') {
        let textCont = moduleCont.querySelector('[data-edit-content-target="' + field + '"]'),
            defaultText = textCont.getAttribute('data-default-text');
        textCont.innerHTML = (tinyMCE.activeEditor.getContent() == '' ? defaultText : tinyMCE.activeEditor.getContent());
      }
    });

    delegate(document, 'shown.bs.modal', '[data-wysiwyg-modal]', function(event) {
      var modal = event.target;
      if(modal.querySelectorAll('textarea').length > 1) {
        //More than one textarea
        let textarea = Array.from(modal.querySelectorAll('[data-edit-content-target]')).filter(s =>
          window.getComputedStyle(s).getPropertyValue('display') != 'none'
        );
        tinyMCE.get(textarea[0].querySelector('textarea').id).focus();
      }else {
        //Only one textarea
        tinyMCE.get(modal.querySelector('textarea').id).focus();
      }
    });
    // Fix tinymce dialogs actions
    document.addEventListener('focusin', function (e) {
      if (e.target.closest('.tox-tinymce-aux, .moxman-window, .tam-assetmanager-root, .tox-dialog, .mce-window, .tox-tbtn') !== null) {
        e.stopImmediatePropagation();
      }
    });

  }
}, false);
