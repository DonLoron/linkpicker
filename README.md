#Linkpicker

Creates a new REX_VAR REX_LINKPICKER with which a widget will be generated with a pop up where a url can be picked or every element with a id attribute can be chosen  to set an achor on the link. this addon is specifically designed to make the non power users experience better.

Syntax:

`REX_LINKPICKER[id={int 1 - 20}]` Generates Widget with accoring id

`REX_LINKPICKER[widget={int 1}]` widget or not?

`REX_LINKPICKER[output={type}]` output type, default is url
 * url: returns complete url -> rex_getUrl(id) + hash
 * id: returns article id
 * hash: returns hash only
 * array: returns url, id and hash as array