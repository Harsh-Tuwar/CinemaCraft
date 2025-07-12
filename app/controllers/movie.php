<?php

require_once 'app/models/OmdbApi.php';

class Movie extends Controller {
  private $omdbApi;

  public function __construct() {
    $this->omdbApi = new OmdbApi($_ENV['OMDB_API_KEY']);
  }

  public function search() {
    $query = $_GET['query'] ?? '';

    if (!empty($query)) {
      try {
        $movies = $this->omdbApi->search($query);
      } catch (Exception $e) {
        $movies = ['error' => $e->getMessage()];
      }
    } else {
      $movies = ['error' => 'No query provided' ];
    }

    $this->view('movie/results', ['movies' => $movies]);
    die;
  }
}

?>