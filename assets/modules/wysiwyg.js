import './_wysiwyg.scss';

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

const initTinyMCE =  function(wyysiwyg, content) {
  document.getElementById(wyysiwyg.getAttribute('id')).setAttribute('value',content);
    tinymce.init({
      selector: '#'+wyysiwyg.getAttribute('id'),
      height: 300,
      menubar: false,
      plugins:
        'code ' +
        'image link media template code ' +
        'table charmap pagebreak nonbreaking anchor ' +
        'insertdatetime advlist lists wordcount help ' +
        'charmap quickbars emoticons',
      toolbar: 'undo redo | bold italic underline strikethrough |' +
                ' alignleft aligncenter alignright alignjustify |' +
                ' outdent indent |  numlist bullist | forecolor removeformat | ' +
                ' link anchor code | ltr rtl | fontsize blocks | ' +
                ' charmap emoticons',
      toolbar_sticky: false,
      extended_valid_elements:"svg[*],defs[*],pattern[*],desc[*],metadata[*],g[*],mask[*],path[*],line[*],marker[*],rect[*],circle[*],i[*]",
      setup: function (editor) {
      editor.on('init', function (e) {
        editor.setContent(content);
      });
    }
  });
};

window.addEventListener('load', function () {

  let description = [];

  if (typeof tinyMCE !== 'undefined') {
    delegate(document, 'hidden.bs.modal', '[data-wysiwyg-modal]', function(event) {
      var modal = event.target,
        moduleCont = event.target.closest('[data-edit-id-target]');
      var field = modal.querySelector('#' + tinyMCE.activeEditor.id).getAttribute('data-edit-content-input');

      if(field !== 'null') {
        let textCont = moduleCont.querySelector('[data-edit-content-target="' + field + '"]'),
            defaultText = textCont.getAttribute('data-default-text');
        textCont.innerHTML = (tinyMCE.activeEditor.getContent() == '' ? defaultText : tinyMCE.activeEditor.getContent());
        modal.querySelector('#' + tinyMCE.activeEditor.id).setAttribute('data-initial-value', tinyMCE.activeEditor.getContent());
        modal.querySelector('#' + tinyMCE.activeEditor.id).setAttribute('value', tinyMCE.activeEditor.getContent());
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

    document.querySelectorAll('[data-wysiwyg]').forEach(function(element) {
      initTinyMCE(element, element.getAttribute('data-initial-value'));
    });

    document.addEventListener('polymorphic.node.add', function (e) {
      const module = e.detail.module;

      module.querySelectorAll('[data-wysiwyg]').forEach(function(element) {
        initTinyMCE(element, element.getAttribute('data-initial-value'));
      });
    });

    document.addEventListener('polymorphic.node.down.before', function (e) {
      const module = e.detail.module,
          index = parseInt(module.getAttribute('data-index'));
      description = [];

      description[index] = [];
      module.querySelectorAll('[data-wysiwyg]').forEach(function(element) {
        description[index][element.getAttribute('data-edit-content-input')] = tinymce.get(element.getAttribute('id')).getContent();
        tinymce.remove('#'+element.getAttribute('id'));
      });
      description[index+1] = [];
      module.closest('.polymorphic-collection-widget').querySelector('[data-index="'+ (index+1) +'"]').querySelectorAll('[data-wysiwyg]').forEach(function(element) {
        description[index+1][element.getAttribute('data-edit-content-input')] = tinymce.get(element.getAttribute('id')).getContent();
        tinymce.remove('#'+element.getAttribute('id'));
      });
    });

    document.addEventListener('polymorphic.node.down', function (e) {
      const module = e.detail.module,
          index = parseInt(module.getAttribute('data-index'));

      module.querySelectorAll('[data-wysiwyg]').forEach(function(element) {
        let content = description[index-1][element.getAttribute('data-edit-content-input')];
        initTinyMCE(element,content);
      });

      module.closest('.polymorphic-collection-widget').querySelector('[data-index="'+ (index-1) +'"]').querySelectorAll('[data-wysiwyg]').forEach(function(element) {
        let content = description[index][element.getAttribute('data-edit-content-input')];
        initTinyMCE(element,content);
      });
    });

    document.addEventListener('polymorphic.node.up.before', function (e) {
      const module = e.detail.module,
          index = parseInt(module.getAttribute('data-index'));
      description = [];

      description[index] = [];
      module.querySelectorAll('[data-wysiwyg]').forEach(function(element) {
        description[index][element.getAttribute('data-edit-content-input')] = tinymce.get(element.getAttribute('id')).getContent();
        tinymce.remove('#'+element.getAttribute('id'));
      });

      description[index-1] = [];
      module.closest('.polymorphic-collection-widget').querySelector('[data-index="'+ (index-1) +'"]').querySelectorAll('[data-wysiwyg]').forEach(function(element) {
       description[index-1][element.getAttribute('data-edit-content-input')] = tinymce.get(element.getAttribute('id')).getContent();
        tinymce.remove('#'+element.getAttribute('id'));
      });
    });

    document.addEventListener('polymorphic.node.up', function (e) {
      const module = e.detail.module,
          index = parseInt(module.getAttribute('data-index'));

      module.querySelectorAll('[data-wysiwyg]').forEach(function(element) {
        let content = description[index+1][element.getAttribute('data-edit-content-input')]
        initTinyMCE(element,content);
      });

      module.closest('.polymorphic-collection-widget').querySelector('[data-index="'+ (index+1) +'"]').querySelectorAll('[data-wysiwyg]').forEach(function(element) {
        let content = description[index][element.getAttribute('data-edit-content-input')]
        initTinyMCE(element,content);
      });
    });
  }
}, false);
