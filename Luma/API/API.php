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
     * @param string $method     The HTTP method (GET or POST).
     * @param array $parameters  Optional parameters to send with the request.
     * @param array $headers     Optional headers to include in the request.
     * @return string            JSON-encoded response with status and data or error.
     */
    public static function call(string $url, string $method = 'GET', array $parameters = [], array $headers = []): string
    {
        // Build URL for GET requests with parameters
        if (strtoupper($method) === 'GET' && !empty($parameters)) {
            $url .= '?' . http_build_query($parameters);
        }
        
        $ch = self::initCurl($url);
        
        // Set POST options if method is POST
        if (strtoupper($method) === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        }
        
        // Set custom headers if provided
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        
        $response = curl_exec($ch);
        
        // Error handling for cURL errors
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return json_encode(['error' => $error]);
        }
        
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // Return the HTTP status code and the decoded response (if JSON), or raw response
        return json_encode([
            'status' => $httpCode,
            'response' => json_decode($response, true) ?? $response
        ]);
    }
}
