/**
 * Created by Laurin Waller on 23.08.18.
 */

const addonName = 'linkpicker';

function linkpickerOpenIframe (that, callable) {

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

if(returnButtons.length > 0) {
  //bind event listeners

  // Get the element, add a click listener...
  document.getElementsByTagName("body")[0].addEventListener("click", function(e) {
    if(e.target && e.target.classList.contains(addonName + "-return")) {
      if(confirm("Möchten Sie die URL [" + e.target.getAttribute("data-href") + "] kopieren")) {
        eraseCookie(addonName);
        window.linepicker = e.target.getAttribute("data-href");
        window.opener.setInputText(window);
      }
    }
  });

  //write cookie so it is possible to browse complete page until return
  createCookie(addonName, "true", 1);
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

function fallbackCopyTextToClipboard(text) {
  var textArea = document.createElement("textarea");
  textArea.value = text;
  document.body.appendChild(textArea);
  textArea.focus();
  textArea.select();

  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    console.log('Fallback: Copying text command was ' + msg);
  } catch (err) {
    console.error('Fallback: Oops, unable to copy', err);
  }

  document.body.removeChild(textArea);
}

function copyTextToClipboard(text) {
  if (!navigator.clipboard) {
    fallbackCopyTextToClipboard(text);
    return;
  }
  navigator.clipboard.writeText(text).then(function() {
    console.log('Async: Copying to clipboard was successful!');
  }, function(err) {
    console.error('Async: Could not copy text: ', err);
  });
}