<?php

namespace Hyperion\RestAPI;

use WP_REST_Request;
use WP_REST_Response;

interface APIEndpointInterface
{
    public static function callback(WP_REST_Request $request) : WP_REST_Response;
    public static function getEndpoint() : string;
    public static function getMethods() : array;
    public static function getPermissions() : string;
    public static function getUrl() : string;
}