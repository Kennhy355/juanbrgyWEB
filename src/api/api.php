<?php
/**
 * API Helper
 * 
 * Functions for making API calls and handling responses.
 */

/**
 * Make a GET request to an API endpoint.
 *
 * @param string $url  The API endpoint URL.
 * @param array  $headers  Optional headers.
 * @return array|false  Decoded JSON response or false on failure.
 */
function api_get(string $url, array $headers = []): array|false
{
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => implode("\r\n", $headers),
        ],
    ]);

    $response = file_get_contents($url, false, $context);
    return $response !== false ? json_decode($response, true) : false;
}

/**
 * Make a POST request to an API endpoint.
 *
 * @param string $url   The API endpoint URL.
 * @param array  $data  The data to send as JSON.
 * @param array  $headers  Optional headers.
 * @return array|false  Decoded JSON response or false on failure.
 */
function api_post(string $url, array $data, array $headers = []): array|false
{
    $headers[] = 'Content-Type: application/json';

    $context = stream_context_create([
        'http' => [
            'method'  => 'POST',
            'header'  => implode("\r\n", $headers),
            'content' => json_encode($data),
        ],
    ]);

    $response = file_get_contents($url, false, $context);
    return $response !== false ? json_decode($response, true) : false;
}
