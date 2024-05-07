<?php

namespace app\core;

class App
{
  protected $controller = 'Home';
  protected $method = 'index';
  protected $error404 = false;
  protected $params = [];

  public function __construct()
  {
    $URL_ARRAY = $this->parseUrl();
    $this->getControllerFromUrl($URL_ARRAY);
    $this->getMethodFromUrl($URL_ARRAY);
    $this->getParamsFromUrl($URL_ARRAY);

    call_user_func_array([$this->controller, $this->method], $this->params);
  }
  private function parseUrl()
  {
    if (isset($_SERVER['REQUEST_URI'])) {

      $url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

      return $url;

    } else {
      return [];
    }
  }
  private function getControllerFromUrl($url)
  {
    if (!empty($url[0]) && isset($url[0])) {
      if (file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')) {
        $this->controller = ucfirst($url[0]);
      } else {
        $this->error404 = true;
        $this->method = 'pageNotFound';
      }
    }

    require '../app/controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller();
  }

  private function getMethodFromUrl($url)
  {
    if (!empty($url[1]) && isset($url[1])) {
      if (method_exists($this->controller, $url[1]) && !$this->error404) {
        $this->method = $url[1];
      } else {

        $this->method = 'pageNotFound';
      }
    }
  }

  private function getParamsFromUrl($url)
  {
    if (count($url) > 2) {
      $this->params = array_slice($url, 2);
    }
  }
}