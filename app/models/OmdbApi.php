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

    return $this->makeRequest('', $params);
  }
}

?>