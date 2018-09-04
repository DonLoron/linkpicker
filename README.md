##Linkpicker

Creates a new REX_VAR REX_LINKPICKER with which a widget will be generated with a pop up where a url can be picked or every element with a id attribute can be chosen  to set an achor on the link. This addon is specifically designed to make the non power users experience better.

Syntax:

`REX_LINKPICKER[id={int 1 - 20}]` - Generates Widget with according id

`REX_LINKPICKER[widget={int 1}]` - Widget or not?

`REX_LINKPICKER[output={string}]` - Output type, default is url
 * url: returns complete url -> rex_getUrl(id) + hash. **Allways returns FULL DOMAIN URL!**
 * id: returns article id
 * hash: returns hash only
 * array: returns url, id and hash as array

You can use the addon also for extracting urls by using the addonpage popup that copies the given url to your clipboard.

The Addon also comes with a plugin for [Redactor Editor 2](https://github.com/FriendsOfREDAXO/redactor2), just link the plugin file found in linkpicker addon assets.