<?php

namespace Hyperion\RestAPI;

use WP_REST_Response;

class APIManagement
{
    public static function registerAPIEndpoint(APIEndpointInterface $APIEndpoint)
    {
        add_action('rest_api_init', function () use ($APIEndpoint) {
            register_rest_route($APIEndpoint::getAPINamespace(), '/' . $APIEndpoint::getEndpoint(), array(
                'methods' => implode(",", $APIEndpoint::getMethods()),
                'callback' => array($APIEndpoint, 'callback'),
                'permission_callback' => $APIEndpoint::getPermissions()
            ));
        });
    }

    public static function APIError(string $message, string $errorCode)
    {
        $data = [
            'message' => $message,
            'error' => $errorCode
        ];

        return new WP_REST_Response(json_encode($data, JSON_THROW_ON_ERROR), 400);
    }
}