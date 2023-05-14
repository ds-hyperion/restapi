<?php

namespace Hyperion\RestAPI;

class Plugin
{
    public const API_NAMESPACE_OPTION = 'hyperion_api_namespace';
    public const API_ORIGIN_CORS_OPTION = 'hyperion_api_cors';
    public const API_ANTIBOT_SALT_OPTION = 'hyperion_api_antibot_salt';
    public const ADD_API_ENDPOINT_ACTION = 'add_api_endpoint';

    public static function install()
    {
        add_option(self::API_NAMESPACE_OPTION);
        add_option(self::API_ORIGIN_CORS_OPTION);
        add_option(self::API_ANTIBOT_SALT_OPTION);
    }

    public static function uninstall()
    {
        // Remove option from wordpress option
        delete_option(self::API_NAMESPACE_OPTION);
        delete_option(self::API_ORIGIN_CORS_OPTION);
        delete_option(self::API_ANTIBOT_SALT_OPTION);
    }

    public static function activeCors($value)
    {
        $origin = get_http_origin();
        $allowed_origins = explode(",",get_option(\Hyperion\RestAPI\Plugin::API_ORIGIN_CORS_OPTION));

        if ( $origin && in_array($origin, $allowed_origins, true)) {
            header( 'Access-Control-Allow-Origin: ' . esc_url_raw( $origin ) );
            header( 'Access-Control-Allow-Methods: GET,POST' );
            header( 'Access-Control-Allow-Credentials: true' );
        }

        return $value;
    }
}