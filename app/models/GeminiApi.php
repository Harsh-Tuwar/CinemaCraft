<?php

require_once 'app/models/Api.php';

class GeminiApi extends Api {
  private $model;

  public function __construct($apiKey, $model = 'gemini-2.5-flash') {
    parent::__construct('https://generativelanguage.googleapis.com/v1beta/models/');
    $this->apiKey = $apiKey; // store API key
    $this->model = $model;
  }

  public function generateContent($prompt) {
    $endpoint = "/{$this->model}:generateContent";
    
    $requestBody = [
      'contents' => [
        [
          'parts' => [
            ['text' => $prompt]
          ]
        ]
      ]
    ];

    $jsonData = json_encode($requestBody);

    // Include API key header as required by Gemini
    $headers = [
      'x-goog-api-key' => $this->apiKey
    ];

    // print_r($endpoint);
    // die;
    
    $results = $this->makeRequest(
      $endpoint,
      [],
      $headers, // pass custom headers including API key
      'POST',
      $jsonData
    );

    // print_r($results);
    // die;
    
    return $results;
  }
}

?>
