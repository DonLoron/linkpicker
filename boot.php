<?php

/* @var $this rex_addon */

//include js file
if(rex::isBackend()) {

  rex_view::addJsFile($this->getAssetsUrl('js/linkpicker.js'));

} else {
  //if there is a backend session and get param linkpicker is set, parse html
  if (rex_backend_login::hasSession() && (rex_request::get($this->getName(), "string") == "true" || rex_request::cookie($this->getName(), "string") == "true")) {

    rex_extension::register("OUTPUT_FILTER", function($p){

      $page = $p->getSubject();

      $currentId = rex_article::getCurrentId();
      $url = rex_getUrl(rex_article::getCurrentId());

      //allways make absolute paths
      if(strpos($url, 'http') === false) {
        $url = substr(rex::getServer(), 0, strlen(rex::getServer()) - 1) . $url;
      }

      //first get all ids, then loop through them by doing dom doc
      preg_match_all('/<.*id=\"(.*)\".*>/Ui', $page, $matches);

      $doc = new DOMDocument();
      @$doc->loadHTML(mb_convert_encoding($page, 'HTML-ENTITIES', 'UTF-8'));
      $containerClass = $this->getName() . '-container';
      foreach($matches[1] as $match) {
        $domElement = $doc->getElementById($match);
        if($domElement !== null) $domElement->setAttribute('class', ($domElement->getAttribute('class') == "" ? $containerClass : $containerClass . ' ' . $domElement->getAttribute('class')));
      }
      $page = $doc->saveHTML();

      //then add the linkpicker return url
      $page = preg_replace('/(<.*id=\"(.*)\".*>)/Ui', '$1<span class="' . $this->getName() . '-return" data-url="' . $url . '#$2" data-hash="#$2" data-id="' . $currentId . '">Link auswählen</span>', $page);

      $pagePickButton = "<span class=\"" . $this->getName() . "-return " . $this->getName() . "-pagepicker\" data-url=\"$url\" data-id=\"$currentId\" data-hash=\"\">Seite auswählen</span>";

      $js = '<script type="text/javascript" src="' . rex_url::assets('addons/linkpicker/js/linkpicker.js?' . 't=' . time()) . '"></script>';
      $page = str_replace('</body>', $pagePickButton . $js . '</body>', $page);

      $css = '<link rel="stylesheet" href="' . rex_url::assets('addons/linkpicker/css/linkpicker.css?' . 't=' . time()) . '">';
      $page = str_replace('</title>', '</title>' . $css, $page);

      return $page;

    });

  }
}