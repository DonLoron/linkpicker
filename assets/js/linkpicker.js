/**
 * Created by walderwerber on 23.08.18.
 */

const addonName = 'linkpicker';

function linepickerOpenIframe (that) {
  var win = window.open('/?' + addonName + '=true', '_blank', 'width=1300,height=800');
  win.focus();
  win.onbeforeunload = function(){
    that.parentNode.previousSibling.value = this.linepicker;
    return null;
  }
}

var returnButtons = document.getElementsByClassName(addonName + "-return");

if(returnButtons.length > 0) {
  for (var i = 0; i < returnButtons.length; i++) {
    returnButtons[i].addEventListener('click', function() {
      if(confirm("Möchten Sie die URL [" + this.getAttribute("data-href") + "] kopieren")) {
        window.linepicker = this.getAttribute("data-href");
        window.close();
      }
    }, false);
  }
}