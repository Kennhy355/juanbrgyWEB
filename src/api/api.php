<?php



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
