<?php

class Api {
  protected $baseUrl;
  protected $apiKey;

  public function __construct($baseUrl, $apiKey = null) {
    $this->baseUrl = rtrim($baseUrl, '/');
    $this->apiKey = $apiKey;
  }

  protected function makeRequest(
    string $endpoint,  // The API endpoint
    array $params = [], // For GET requests
    array $headers = [], // Additional headers
    string $method = 'GET', // Default to GET
    ?string $jsonData = null // For POST/PUT requests, optional
  ) {
    $url = $this->baseUrl . $endpoint;

    if ($method === 'GET' && !empty($params)) {
      $url .= '?' . http_build_query($params);
    }

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    $defaultHeaders = [
      'Content-Type: application/json',
      'Accept: application/json',
    ];

    if ($jsonData !== null) {
      $defaultHeaders[] = 'Content-Type: application/json';
    }

    $allHeaders = array_merge($defaultHeaders, $this->formatHeaders($headers));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $allHeaders);


    if (in_array($method, ['POST', 'PUT']) && $jsonData !== null) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    }

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
      $error = curl_error($ch);
      curl_close($ch);
      throw new Exception("cURL Error: $error");
    }

    curl_close($ch);

    $decoded = json_decode($response, true);

    if ($decoded === null) {
      throw new Exception("Invalid JSON response");
    }

    return $decoded;
  }

  private function formatHeaders(array $headers) {
    $result = [];

    foreach ($headers as $key => $value) {
      $result[] = "$key: $value";
    }

    return $result;
  }

}

?>