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
  if (rex_backend_login::hasSession() && rex_request::get($this->getName(), "string") == "true") {

    rex_extension::register("OUTPUT_FILTER", function($p){

      $page = $p->getSubject();

      $js = '<script type="text/javascript" src="' . rex_url::assets('addons/linkpicker/js/linkpicker.js?' . 't=' . time()) . '"></script>';
      $js .= '<link rel="stylesheet" href="' . rex_url::assets('addons/linkpicker/css/linkpicker.css?' . 't=' . time()) . '">';
      $page = str_replace('</body>', $js . '</body>', $page);

      $url = rex_getUrl(rex_article::getCurrentId());

      $page = preg_replace('/(<.*id=\"(.*)\".*>)/Ui', '$1<a class="' . $this->getName() . '-return" href="#" data-href="' . $url . '#$2">Auswählen</a>', $page);

      return $page;

    });

  }
}