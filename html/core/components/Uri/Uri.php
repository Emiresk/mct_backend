<?php

namespace core\components\Uri;

class Uri {
    public static function FetchUri ( $uri )
    {
        $path = parse_url( $uri , PHP_URL_PATH );
        $path = ( explode( '/', $path ));
        $path = array_filter( $path );
        $path = array_values( $path );

        return array_map( '\core\components\Uri\Uri::_escapeString', $path );
    }

    private static function _escapeString( $string )
    {
        $str = preg_replace('/[\x00-\x2E\x3A-\x40\x5B-\x60\x7B-\x7F]/u', '', $string );
        return trim( $str );
    }
}