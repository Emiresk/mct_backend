<?php

namespace core\bootstrap;

use core\components\Pages\BasicPage;
use core\components\Pages\SkeletonPage;
use core\components\Requests\Requests;
use core\components\Uri\Uri;

class Bootstrap {

    private $uri = null;
    private $_default_destination = '/index';
    private $app = null;

    public function __construct () {
        $this->_init_application();
    }

    private function _init_application ()
    {
        $this->_pre_app_launch()
             ->_main_app_launch()
             ->_post_app_launch();
    }
    private function _pre_app_launch() {

        $this->uri = $_SERVER['REQUEST_URI'];

        if ( $this->uri == '/'){
            Requests::Instance()->Redirect($this->_default_destination);
        }

        return $this;
    }
    private function _main_app_launch()
    {
        $this->app = new SkeletonPage(  Uri::FetchUri( $this->uri ) );
        return $this;
    }
    private function _post_app_launch()
    {
       echo "<pre>";
       var_dump( $this );
    }
}
