<?php

error_reporting( E_ALL );

DEFINE ("DS" , DIRECTORY_SEPARATOR );
DEFINE ("ROOT_DIR", dirname( __FILE__) . DS );
DEFINE ("CORE", ROOT_DIR . "core");
DEFINE ("MODULE", ROOT_DIR . "module");
DEFINE ("APP", CORE . DS . "app");

spl_autoload_register( function ( $CallableClass ) {
    $sourceClassFile = ROOT_DIR . str_replace( '\\', DS, $CallableClass ) . ".php";

    ( file_exists( $sourceClassFile ))
        ? require_once $sourceClassFile
        : die ("Class file or Class is missed by destination path -> {$sourceClassFile}");
});