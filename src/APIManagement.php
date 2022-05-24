<?php

namespace Hyperion\RestAPI;

use Exception;
use WP_REST_Response;

class APIManagement
{
    private static string $apiNS;

    public static function registerAPIEndpoint(APIEndpointInterface $APIEndpoint)
    {
        if (!isset(self::$apiNS)) {
            self::$apiNS = get_option(\Hyperion\RestAPI\Plugin::API_NAMESPACE_OPTION);
            if (self::$apiNS === false) {
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

    public static function APIOk($message = null): WP_REST_Response
    {
        return new WP_REST_Response($message, $message ? 200 : 204);
    }

    public static function APIError(string $message, string $errorCode): WP_REST_Response
    {
        $data = [
            'message' => $message,
            'error' => $errorCode
        ];

        return new WP_REST_Response(json_encode($data, JSON_THROW_ON_ERROR), 400);
    }

    public static function APINotFound(): WP_REST_Response
    {
        return new WP_REST_Response(null, 404);
    }

    public static function APIForbidden(string $message = null): WP_REST_Response
    {
        return new WP_REST_Response($message, 403);
    }

    public static function APIRedirect(string $urlToRedirect)
    {
        return rest_ensure_response(new WP_REST_Response(
            null,
            302,
            array(
                'Location' => $urlToRedirect
            )
        ));
    }


    public static function APIClientDownloadWithURL(string $fileURL, string $filename)
    {
        $content = file_get_contents($fileURL);
        $response = new WP_REST_Response();
        $response->set_data($content);
        $response->set_headers([
            'Content-Type' => "application/pdf",
            'Content-Length' => strlen($content),
            'Content-Disposition' => 'attachment; filename = "' . $filename . '"'
        ]);

        add_filter('rest_pre_serve_request', ['\Hyperion\RestAPI\APIManagement', 'serveFileForDownloading'], 0, 2);

        return $response;
    }

    public static function serveFileForDownloading($served, $result)
    {
        echo $result->get_data();
        return true;
    }
}