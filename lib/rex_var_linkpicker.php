<?php
/**
 * Erstellt die Variable REX_LINKPICKER[]. Mit ihr wird ein widget geöffnet, aus dem beliebig die url gepickt werden kann.
 *
 * Syntax:
 *     REX_WEBSITE_TITLE[] // Gibt den Titel aus
 *     REX_WEBSITE_TITLE[id={int 1 - 20}] // Generiert Textfeld mit dieser REX_INPUT_VAR[id]
 *     REX_WEBSITE_TITLE[widget={int 1}] // generiert ein widget oder gibt den wert aus
 */
class rex_var_linkpicker extends rex_var
{

  const VAR_NAME = "REX_LINKPICKER";
  const PREFIX = "linkpicker-";

  protected function getOutput()
  {

    //get arguments
    $id = $this->getArg('id', 0, true);
    $wigdet = $this->getArg('widget') == '1';

    if (!in_array($this->getContext(), ['module', 'action']) || !is_numeric($id) || $id < 1 || $id > 20) {
      return false;
    }

    if ($this->hasArg('widget') && $this->getArg('widget')) {

      $value = self::getWidget($id, $this->getContextData()->getValue('value' . $id));

    } else {
      $value = $this->getContextData()->getValue('value' . $id);
    }

    return self::quote($value);
  }

  public static function getWidget($id, $value = "", $generateREXInput = true) {

    //this way, it will be generated for input.php
    if($generateREXInput) {
      $name = self::VAR_NAME . "[$id]";
    } else {
      $name = $id;
    }

    $e = [];
    $e['before'] = '';
    $e['field'] = '<input class="form-control" type="text" name="' . $name . '" value="' . $value  . '" id="REX_MEDIA_' . $id . '" />';
    $e['functionButtons'] = '<a href="#" class="btn btn-popup" onclick="linepickerOpenIframe(this); return false;" ><i class="rex-icon fa-crosshairs"></i></a>';

    $fragment = new rex_fragment();
    $fragment->setVar('elements', [$e], false);
    $media = $fragment->parse('core/form/widget.php');

    return $media;
  }
}