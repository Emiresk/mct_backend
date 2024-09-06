<?php

namespace core\components\Pages;

class SkeletonPage
{
    protected $abs_page;
    private $abs_path = MODULE . DS . "%s" . DS;
    private $abs_routes  = MODULE . DS . "%s" . DS . "routes" .DS. "routes.php";
    private $abs_view = MODULE . DS.  "%s" . DS . "views" .DS. "view.html";
    private $type;
    public function __construct ( $page )
    {
        $this->abs_page = $page;
        $this->type = (count($this->abs_page) >= 4 && $this->abs_page[0] == 'apireq') ? "api" : "basic";
    }

    protected function GetModule()
    {
        if ( count( $this->abs_page ) > 0 )
        {
            return $this->abs_page[0];
        }

        return "index";
    }

    protected function GetMethod()
    {
        if ( count( $this->abs_page ) > 1 )
        {
            return $this->abs_page[1];
        }

        return "main";
    }


    protected function GetArgument()
    {
        if ( count( $this->abs_page) > 2 )
        {
            return $this->abs_page[2];
        }

        return "";
    }

    protected function GetArguments()
    {
        $result = '';

        if ( count( $this->abs_page) > 3 )
        {
            $result = array_slice( $this->abs_page, 2);

            $result = array_values( $result);
        }

        return $result;
    }

    protected function GetPageModulePath ()
    {
        return sprintf( $this->abs_path, $this->GetModule() );
    }

    protected function GetPageModuleView (){
        return sprintf( $this->abs_view, $this->GetModule() );
    }

    protected function GetPageModuleRoutes (){
        return sprintf( $this->abs_routes, $this->GetModule() );
    }
}