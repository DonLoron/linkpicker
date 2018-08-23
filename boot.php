<?php

/* @var $this rex_addon */

//include js file
if(rex::isBackend()) {

  rex_extension::register("OUTPUT_FILTER", function($p){

    $page = $p->getSubject();

    $js = '<script type="text/javascript" src="' . rex_url::assets('addons/linkpicker/js/linkpicker.js?' . 't=' . time()) . '"></script>';
    $page = str_replace('</body>', $js . '</body>', $page);

    return $page;

  });
} else {
  //if there is a backend session and get param linkpicker is set, parse html
  if (rex_backend_login::hasSession() && (rex_request::get($this->getName(), "string") == "true" || rex_request::cookie($this->getName(), "string") == "true")) {

    rex_extension::register("OUTPUT_FILTER", function($p){

      $page = $p->getSubject();

      $js = '<script type="text/javascript" src="' . rex_url::assets('addons/linkpicker/js/linkpicker.js?' . 't=' . time()) . '"></script>';
      $page = str_replace('</body>', $js . '</body>', $page);

      $css = '<link rel="stylesheet" href="' . rex_url::assets('addons/linkpicker/css/linkpicker.css?' . 't=' . time()) . '">';
      $page = str_replace('</title>', '</title>' . $css, $page);

      $url = rex_getUrl(rex_article::getCurrentId());

      $page = preg_replace('/(<.*id=\"(.*)\".*>)/Ui', '$1<span class="' . $this->getName() . '-return" data-href="' . $url . '#$2">Link auswählen</span>', $page);

      return $page;

    });

  }
}