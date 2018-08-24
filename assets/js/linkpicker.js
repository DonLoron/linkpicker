/**
 * Created by walderwerber on 23.08.18.
 */

const addonName = 'linkpicker';

function linepickerOpenIframe (that, callable) {

  var win = window.open('/?' + addonName + '=true', '_blank', 'width=1300,height=800');
  win.focus();

  window.setInputText = function(closedWindow) {

    if(callable) callable(closedWindow.linepicker);
    else that.parentNode.previousSibling.value = closedWindow.linepicker;

    closedWindow.close();
    return null;
  };
}

//this indicates where on choosing window
var returnButtons = document.querySelectorAll("." + addonName + "-return");
console.log(returnButtons);
if(returnButtons.length > 0) {
  //bind event listeners
  for (var i = 0; i < returnButtons.length; i++) {
    returnButtons[i].addEventListener('click', function() {
      if(confirm("Möchten Sie die URL [" + this.getAttribute("data-href") + "] kopieren")) {
        eraseCookie(addonName);
        window.linepicker = this.getAttribute("data-href");
        window.opener.setInputText(window);
      }
    }, false);
  }

  //write cookie so it is possible to browse complete page until return
  createCookie(addonName, "true", 1);
}

//add class to elements with id
var elementsWithIDs = document.querySelectorAll("[id]");

if(elementsWithIDs.length > 0) {
  for (var i = 0; i < elementsWithIDs.length; i++) {
    elementsWithIDs[i].classList.add(addonName + '-container');
  }
}

// Create cookie
function createCookie(name, value, days) {
  var expires;
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    expires = "; expires="+date.toGMTString();
  }
  else {
    expires = "";
  }
  document.cookie = name+"="+value+expires+"; path=/";
}

// Read cookie
function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0) === ' ') {
      c = c.substring(1,c.length);
    }
    if (c.indexOf(nameEQ) === 0) {
      return c.substring(nameEQ.length,c.length);
    }
  }
  return null;
}

// Erase cookie
function eraseCookie(name) {
  createCookie(name,"",-1);
}
