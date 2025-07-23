<?php

require_once 'app/models/OmdbApi.php';

class Movies extends Controller {
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
    
    $this->view(
      'movie/results', 
      [
        'movies' => $movies
      ]
    );
    die;
  }

  public function generateReview() {
    header('Content-Type: application/json');

    $movieTitle = $_GET['title'] ?? '';
    
    if (empty($movieTitle)) {
      echo json_encode(['error' => 'No movie title provided']);
      die;
    }

    // Call the Movie model to generate the review
    $movieModel = $this->model('Movie');
    $review = $movieModel->generate_review($movieTitle);

    echo json_encode(['review' => $review]);
    die;
  }
}

?>