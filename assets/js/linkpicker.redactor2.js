$.Redactor.prototype.linkpicker = function() {
  return {
    langs: {
      de: {
        "linkpicker": "Anker auswählen",
        "linkpicker_linktext": "Linktext",
        "linkpicker_linkurl": "URL",
        "linkpicker_insert": "Einfügen",
        "linkpicker_abort": "Abbrechen"
      },
      en: {
        "linkpicker": "Choose anchor",
        "linkpicker_linktext": "Linktext",
        "linkpicker_linkurl": "URL",
        "linkpicker_insert": "Insert",
        "linkpicker_abort": "Cancel"
      },
      es: {
        "linkpicker": "Choose anchor",
        "linkpicker_linktext": "Linktext",
        "linkpicker_linkurl": "URL",
        "linkpicker_insert": "Insert",
        "linkpicker_abort": "Cancel"
      }
    },
    getTemplate: function() {

      var that = this;

      var selectedText = this.selection.text();

      var modalContent = '';
      modalContent += '<div class="modal-section" id="redactor-modal-linkpicker">';

      if (selectedText == '') {
        modalContent += '  <section>';
        modalContent += '    <label for="linkpicker_linktext">' + this.lang.get('linkpicker_linktext') + '</label>';
        modalContent += '    <input type="text" id="linkpicker_linktext">';
        modalContent += '  </section>';
      }

      modalContent += '  <section class="form-horizontal"><label for="linkpicker_link_url">' + this.lang.get('linkpicker_linkurl') + '</label><div class="input-group"><input type="text" class="form-control" name="linkpicker_link_url" id="linkpicker_link_url" /><span class="input-group-btn"><a href="#" class="btn btn-popup" id="linkpicker_link" onclick="linkpickerOpenIframe(this); return false;" ><i class="rex-icon fa-crosshairs"></i></a></span></div></section>';
      modalContent += '  <section>';
      modalContent += '    <button id="redactor-modal-button-action">' + this.lang.get('linkpicker_insert') + '</button>';
      modalContent += '    <button id="redactor-modal-button-cancel">' + this.lang.get('linkpicker_abort') + '</button>';
      modalContent += '  </section>';
      modalContent += '</div>';

      return String() + modalContent;
    },
    init: function() {
      var button = this.button.add('linkpicker', this.lang.get('linkpicker'));
      this.button.setIcon(button, '<i class="fa fa-crosshairs"></i>');
      this.button.addCallback(button, this.linkpicker.show);
    },
    show: function() {
      this.modal.addTemplate('linkpicker', this.linkpicker.getTemplate());
      this.modal.load('linkpicker', this.lang.get('linkpicker'), 600);

      var button = this.modal.getActionButton();
      button.on('click', this.linkpicker.set);

      this.modal.show();

      setTimeout(function() {
        if ($('#linkpicker_linktext').length != 0) {
          $('#linkpicker_linktext').focus();
        } else {
          $('#linkpicker_link_url').focus();
        }
      }, 1);
    },
    set: function() {
      var linktext = $('#linkpicker_linktext').val();
      var linkurl = $('#linkpicker_link_url').val();
      this.modal.close();

      var selectedText = this.selection.text();

      if (selectedText != '') {
        var linktext = selectedText;
      }

      this.insert.html('<a href="'+linkurl+'">'+linktext+'</a>');
    }
  };
};