<?php

namespace Luma\API;

use Luma\API\ApiInterface;

class API implements ApiInterface
{
    /**
     * Initializes a cURL session with the given URL and sets basic options.
     *
     * @param string $url The URL to request.
     * @return \CurlHandle The initialized cURL handle.
     */
    private static function initCurl(string $url): \CurlHandle
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); // Set the request URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $_ENV['PRODUCTION']); // Enable SSL verification in production
        return $ch;
    }

    /**
     * Makes an HTTP request to the specified URL using cURL.
     *
     * @param string $url        The endpoint URL.
     * @param string $method     The HTTP method (GET, POST, PUT, PATCH, DELETE).
     * @param array $parameters  Optional parameters to send with the request.
     * @param array $headers     Optional headers to include in the request.
     * @return string            JSON-encoded response with status and data or error.
     */
    private static function call(string $url, string $method, array $parameters = [], array $headers = []): string
    {
        $method = strtoupper($method);

        // Build URL for GET requests with parameters
        if ($method === 'GET' && !empty($parameters)) {
            $url .= '?' . http_build_query($parameters);
        }

        $ch = self::initCurl($url);

        // Set cURL options for different HTTP methods
        switch ($method) {
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                break;
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                if (!empty($parameters)) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                }
                break;
        }

        // Set custom headers if provided
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $response = curl_exec($ch);

        // Error handling for cURL errors
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            unset($ch);
            return json_encode(['error' => $error]);
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        unset($ch);

        // Return the HTTP status code and the decoded response (if JSON), or raw response
        return json_encode([
            'status' => $httpCode,
            'response' => json_decode($response, true) ?? $response
        ]);
    }

    /**
     * Makes a GET HTTP request to the specified URL using cURL.
     *
     * @param string $url        The endpoint URL.
     * @param array $parameters  Optional parameters to send with the request.
     * @param array $headers     Optional headers to include in the request.
     * @return string            JSON-encoded response with status and data or error.
     */
    public static function get(string $url, array $parameters = [], array $headers = []): string
    {
        return self::call($url, 'GET', $parameters, $headers);
    }

    /**
     * Makes a POST HTTP request to the specified URL using cURL.
     *
     * @param string $url        The endpoint URL.
     * @param array $parameters  Parameters to send with the request.
     * @param array $headers     Optional headers to include in the request.
     * @return string            JSON-encoded response with status and data or error.
     */
    public static function post(string $url, array $parameters = [], array $headers = []): string
    {
        return self::call($url, 'POST', $parameters, $headers);
    }

     /**
     * Makes a PUT HTTP request to the specified URL using cURL.
     *
     * @param string $url        The endpoint URL.
     * @param array $parameters  Parameters to send with the request.
     * @param array $headers     Optional headers to include in the request.
     * @return string            JSON-encoded response with status and data or error.
     */
    public static function put(string $url, array $parameters = [], array $headers = []): string
    {
        return self::call($url, 'PUT', $parameters, $headers);
    }

     /**
     * Makes a PATCH HTTP request to the specified URL using cURL.
     *
     * @param string $url        The endpoint URL.
     * @param array $parameters  Parameters to send with the request.
     * @param array $headers     Optional headers to include in the request.
     * @return string            JSON-encoded response with status and data or error.
     */
    public static function patch(string $url, array $parameters = [], array $headers = []): string
    {
        return self::call($url, 'PATCH', $parameters, $headers);
    }

     /**
     * Makes a DELETE HTTP request to the specified URL using cURL.
     *
     * @param string $url        The endpoint URL.
     * @param array $parameters  Parameters to send with the request.
     * @param array $headers     Optional headers to include in the request.
     * @return string            JSON-encoded response with status and data or error.
     */
    public static function delete(string $url, array $parameters = [], array $headers = []): string
    {
        return self::call($url, 'DELETE', $parameters, $headers);
    }
}
