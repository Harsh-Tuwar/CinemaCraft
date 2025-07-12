<?php

require_once 'app/models/Api.php';

class OmdbApi extends Api {
  public function __construct($apiKey) {
    parent::__construct('https://www.omdbapi.com/', $apiKey);
  }

  public function search($query) {
    $params = [
      's' => $query,
      'apikey' => $this->apiKey,
    ];

    $results = $this->makeRequest('', $params);

    // echo '<pre>';
    // echo htmlspecialchars(print_r($results, true));
    // die;
    
    // return $this->makeRequest('', $params);
    return $results;
  }
}

?>