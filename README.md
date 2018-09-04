## Linkpicker

**Bevor du startest: stelle sicher, dass Elemente die du verlinken WILLST ein id-Attribut haben. Dieses Addon generiert KEINE id-Attribute**

Das Addon ermöglicht dir das verwenden einer neuen REX_VAR - REX_LINKPICKER - die im backend ein widget erzeugt (ähnlich REX_LINK) welches die Möglichkeit bietet per Pop-Up ein Element mit id-Attribut auszuwählen und damit eine url mit hash zurückzuliefern. Dieses Addon is eigentlich spezifisch dafür dem Endandwender eine userfreundliche Möglichkeit zu bieten, Anker selbst zu setzen. 

Syntax:

`REX_LINKPICKER[id={int 1 - 20}]` - Generiert ein Widget mit der angegeben id, beachte, es wird eine value gefüllt, kein link!

`REX_LINKPICKER[widget={int 1}]` - Widget aktiv (wie media oder link widget)?

`REX_LINKPICKER[output={string}]` - Output type, default ist url
 * url: gibt komplette url zurück -> rex_getUrl(id) + hash. **Gibt immer die VOLLE DOMAIN URL zurück**
 * id: gibt artikel id zurück
 * hash: gibt nur den hash zurück
 * array: gibt url, id und hash als array zurück, `rex_var::toArray()` brauchen

Daraus resultieren folgende möglichkeiten:

| Output Type | Ouput |
|---|---|
| REX_LINKPICKER[3] | http://addons.dev/#id-2 |
| REX_LINKPICKER[id=3 output=url] | http://addons.dev/#id-2 |
| REX_LINKPICKER[id=3 output=id] | 1 |
| REX_LINKPICKER[id=3 output=hash] | #id-2 |
| REX_LINKPICKER[id=3 output=array] | {"url":"http:\/\/addons.dev\/#id-2","hash":"#id-2","id":"1"} |


Das Addon ermöglicht auch via Addon-Leiste das PopUp direkt zu öffnen und die ausgewählte URL in die Zwischenablage zu speichern. Das ist zum Beispiel hilfreich wenn ein slug auf einen anker weitergeleitet werden soll.

### Redactor Plugin
Das Addon liefert zudem ein Plugin für den [Redactor Editor 2](https://github.com/FriendsOfREDAXO/redactor2), einfach das Addon-Asset in der Redactor Konfiguration hinzufügen.

## Linkpicker for our english friends

**Before you start: make sure, elements you WANT to be pickable have the id-attribute. This addon does not generate ANY id's for you.**

Creates a new REX_VAR REX_LINKPICKER with which a widget will be generated with a pop up where a url can be picked or every element with a id attribute can be chosen  to set an achor on the link. This addon is specifically designed to make the non poweruser experience better.

Syntax:

`REX_LINKPICKER[id={int 1 - 20}]` - Generates Widget in backend with according id, mind that a value will be used, not a link.

`REX_LINKPICKER[widget={int 1}]` - Widget or not (same as media or link widget)?

`REX_LINKPICKER[output={string}]` - Output typ, default is url
 * url: returns complete url -> rex_getUrl(id) + hash. **Allways returns FULL DOMAIN URL!**
 * id: returns article id
 * hash: returns hash only
 * array: returns url, id and hash as array, use `rex_var::toArray()`

This is results in following output types:

| Output Type | Ouput |
|---|---|
| REX_LINKPICKER[3] | http://addons.dev/#id-2 |
| REX_LINKPICKER[id=3 output=url] | http://addons.dev/#id-2 |
| REX_LINKPICKER[id=3 output=id] | 1 |
| REX_LINKPICKER[id=3 output=hash] | #id-2 |
| REX_LINKPICKER[id=3 output=array] | {"url":"http:\/\/addons.dev\/#id-2","hash":"#id-2","id":"1"} |
 
You can use the addon also for extracting urls by using the addonpage popup that copies the given url to your clipboard. This is usefull if you want to use the url in e.g. yRewrite for redirecting a slug to a given url with a hash.

### Redactor Plugin
The Addon also comes with a plugin for [Redactor Editor 2](https://github.com/FriendsOfREDAXO/redactor2), just link the plugin file found in linkpicker addon assets.
