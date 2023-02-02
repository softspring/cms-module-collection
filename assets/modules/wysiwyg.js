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

const initAllTinyMCE =  function(wyysiwyg, content) {
  //Init all elements
  document.querySelectorAll('[data-wysiwyg]').forEach(function(element) {
    initTinyMCE(element, element.value);
  });
};
const removeAllTinyMCE =  function(wyysiwyg, content) {
  //Remove all elements
  document.querySelectorAll('[data-wysiwyg]').forEach(function(element) {
    tinymce.remove('#'+element.getAttribute('id'));
  });
};

window.addEventListener('load', function () {

  let description = [];

  if (typeof tinyMCE !== 'undefined') {
    delegate(document, 'hidden.bs.modal', '[data-wysiwyg-modal]', function(event) {
      let modal = event.target,
        moduleCont = event.target.closest('[data-edit-id-target]');

      if(modal.querySelector('#' + tinyMCE.activeEditor.id) === null) return;

      let field = modal.querySelector('#' + tinyMCE.activeEditor.id).getAttribute('data-edit-content-input');
      let textCont = moduleCont.querySelector('[data-edit-content-target="' + field + '"]'),
          defaultText = textCont.getAttribute('data-default-text');
      textCont.innerHTML = (tinyMCE.activeEditor.getContent() == '' ? defaultText : tinyMCE.activeEditor.getContent());
      modal.querySelector('#' + tinyMCE.activeEditor.id).setAttribute('data-initial-value', tinyMCE.activeEditor.getContent());
      modal.querySelector('#' + tinyMCE.activeEditor.id).setAttribute('value', tinyMCE.activeEditor.getContent());
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

    initAllTinyMCE();

    document.addEventListener('polymorphic.node.insert.before', function (e) {
      removeAllTinyMCE();
    });

    document.addEventListener('polymorphic.node.insert.after', function (e) {
      initAllTinyMCE();
    });

    document.addEventListener('polymorphic.node.delete.before', function (e) {
      removeAllTinyMCE();
    });

    document.addEventListener('polymorphic.node.delete.after', function (e) {
      initAllTinyMCE();
    });

    document.addEventListener('polymorphic.node.down.before', function (e) {
      const module = e.node(),
          index = parseInt(module.getAttribute('data-index'));
      description = [];

      description[index] = [];
      module.querySelectorAll('[data-wysiwyg]').forEach(function(element) {
        description[index][element.getAttribute('data-edit-content-input')] = tinymce.get(element.getAttribute('id')).getContent();
        tinymce.remove('#'+element.getAttribute('id'));
      });
      description[index+1] = [];
      module.closest('[data-polymorphic="collection"]').querySelector('[data-index="'+ (index+1) +'"]').querySelectorAll('[data-wysiwyg]').forEach(function(element) {
        description[index+1][element.getAttribute('data-edit-content-input')] = tinymce.get(element.getAttribute('id')).getContent();
        tinymce.remove('#'+element.getAttribute('id'));
      });
    });

    document.addEventListener('polymorphic.node.down.after', function (e) {
      const module = e.node(),
          index = parseInt(module.getAttribute('data-index'));

      module.querySelectorAll('[data-wysiwyg]').forEach(function(element) {
        let content = description[index-1][element.getAttribute('data-edit-content-input')];
        initTinyMCE(element,content);
      });

      module.closest('[data-polymorphic="collection"]').querySelector('[data-index="'+ (index-1) +'"]').querySelectorAll('[data-wysiwyg]').forEach(function(element) {
        let content = description[index][element.getAttribute('data-edit-content-input')];
        initTinyMCE(element,content);
      });
    });

    document.addEventListener('polymorphic.node.up.before', function (e) {
      const module = e.node(),
          index = parseInt(module.getAttribute('data-index'));
      description = [];

      description[index] = [];
      module.querySelectorAll('[data-wysiwyg]').forEach(function(element) {
        description[index][element.getAttribute('data-edit-content-input')] = tinymce.get(element.getAttribute('id')).getContent();
        tinymce.remove('#'+element.getAttribute('id'));
      });

      description[index-1] = [];
      module.closest('[data-polymorphic="collection"]').querySelector('[data-index="'+ (index-1) +'"]').querySelectorAll('[data-wysiwyg]').forEach(function(element) {
       description[index-1][element.getAttribute('data-edit-content-input')] = tinymce.get(element.getAttribute('id')).getContent();
        tinymce.remove('#'+element.getAttribute('id'));
      });
      console.log('------description polymorphic.node.up.before')
      console.log(description)
    });

    document.addEventListener('polymorphic.node.up.after', function (e) {
      const module = e.node(),
          index = parseInt(module.getAttribute('data-index'));

      module.querySelectorAll('[data-wysiwyg]').forEach(function(element) {
        let content = description[index+1][element.getAttribute('data-edit-content-input')]
        initTinyMCE(element,content);
      });

      module.closest('[data-polymorphic="collection"]').querySelector('[data-index="'+ (index+1) +'"]').querySelectorAll('[data-wysiwyg]').forEach(function(element) {
        let content = description[index][element.getAttribute('data-edit-content-input')]
        initTinyMCE(element,content);
      });
    });
  }
}, false);
