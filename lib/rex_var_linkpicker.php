<?php
/**
 * Creates a new REX_VAR REX_LINKPICKER with which a widget will be generated with a pop up where a url can be picked
 * or every element with a id attribute can be chosen to set an achor on the link. this addon is specifically designed
 * to make the non power users experience better.
 *
 * Syntax:
 *     REX_LINKPICKER[id={int 1 - 20}] // Generates Widget with accoring id
 *     REX_LINKPICKER[widget={int 1}] // widget or not?
 *     REX_LINKPICKER[output={type}] // output type, default is url
 *     - url: returns complete url -> rex_getUrl(id) + hash
 *     - id: returns article id
 *     - hash: returns hash only
 *     - array: returns url, id and hash as array
 */
class rex_var_linkpicker extends rex_var
{

  const VAR_NAME = "REX_LINKPICKER";
  const PREFIX = "linkpicker-";

  /**
   * @return bool|string
   */
  protected function getOutput()
  {

    //get arguments
    $id = $this->getArg('id', 0, true);
    $outputType = $this->getArg('output', 'url');

    if (!in_array($this->getContext(), ['module', 'action']) || !is_numeric($id) || $id < 1 || $id > 20) {
      return false;
    }

    if ($this->hasArg('widget') && $this->getArg('widget')) {
      $value = self::getWidget($id, $this->getContextData()->getValue('value' . $id));
    } else {

      $var = rex_var::toArray($this->getContextData()->getValue('value' . $id));

      switch($outputType) {
        case 'hash':
          $value = $var['hash'];
          break;
        case 'id':
          $value = $var['id'];
          break;
        case 'array':
          $value = $var;
          break;
        default:
          $value = $var['url'];
          break;
      }

    }

    return self::quote($value);
  }

  /**
   * Generates the input field, could also be used in any other place
   * @param $name string name attribute of the input
   * @param string $value string value of the input
   * @param bool $generateREXInput gnerate as REX_INPUT_NAME or just take the name
   * @return string returns the widget
   */
  public static function getWidget($name, $value = "", $generateREXInput = true) {

    if(!is_array($value)) $value = rex_var::toArray($value);

    //this way, it will be generated for input.php
    if($generateREXInput) {
      $nameURL = "REX_INPUT_VALUE[$name][url]";
      $nameHash = "REX_INPUT_VALUE[$name][hash]";
      $nameID = "REX_INPUT_VALUE[$name][id]";
    } else {
      $nameURL = $name . "[url]";
      $nameHash = $name . "[hash]";
      $nameID = $name . "[id]";
    }

    $e = [];
    $e['before'] = '';
    $e['field'] = '<input class="form-control" type="text" name="' . $nameURL . '" value="' . $value['url']  . '" id="' . self::VAR_NAME . '_' . rex_string::normalize($name) . '_url" />';
    $e['field'] .= '<input class="form-control" type="hidden" name="' . $nameHash . '" value="' . $value['hash']  . '" id="' . self::VAR_NAME . '_' . rex_string::normalize($name) . '_hash" />';
    $e['field'] .= '<input class="form-control" type="hidden" name="' . $nameID . '" value="' . $value['id']  . '" id="' . self::VAR_NAME . '_' . rex_string::normalize($name) . '_id" />';
    $e['functionButtons'] = '<a href="#" class="btn btn-popup" onclick="linkpickerOpenIframe(this); return false;" id="' . self::VAR_NAME . '_' . rex_string::normalize($name) . '" ><i class="rex-icon fa-crosshairs"></i></a>';

    $fragment = new rex_fragment();
    $fragment->setVar('elements', [$e], false);
    $media = $fragment->parse('core/form/widget.php');

    return $media;
  }
}