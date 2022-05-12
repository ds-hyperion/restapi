<?php

namespace Hyperion\RestAPI;

use Exception;
use WP_REST_Response;

class APIManagement
{
    private static string $apiNS;

    public static function registerAPIEndpoint(APIEndpointInterface $APIEndpoint)
    {
        if(!isset(self::$apiNS)) {
            self::$apiNS = get_option(\Hyperion\RestAPI\Plugin::API_NAMESPACE_OPTION);
            if(self::$apiNS === false) {
                throw new Exception("API Namespace has not been set");
            }
        }

        add_action('rest_api_init', function () use ($APIEndpoint) {
            register_rest_route(self::$apiNS, '/' . $APIEndpoint::getEndpoint(), array(
                'methods' => implode(",", $APIEndpoint::getMethods()),
                'callback' => array($APIEndpoint, 'callback'),
                'permission_callback' => $APIEndpoint::getPermissions()
            ));
        });
    }

    public static function APIOk($message = null) : WP_REST_Response
    {
        return new WP_REST_Response($message , $message ? 200 : 204);
    }

    public static function APIError(string $message, string $errorCode) : WP_REST_Response
    {
        $data = [
            'message' => $message,
            'error' => $errorCode
        ];

        return new WP_REST_Response(json_encode($data, JSON_THROW_ON_ERROR), 400);
    }
}