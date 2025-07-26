<?php

class Reviews extends Controller {
  
  //  this function is not used, but it is here for redirect
  public function index() {
    if (isset($_SESSION['auth'])) {
      header('Location: /reviews/all');
    } else {
      header('Location: /home');
    }
  }
  
  public function submit() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $userId = $_POST['user_id'];
      $title = filter_var($_POST['movie_title'], FILTER_SANITIZE_STRING);
      $poster = filter_var($_POST['movie_poster'], FILTER_SANITIZE_URL);
      $imdbId = $_POST['imdbId'];
      $rating = $_POST['rating'];
      
      $review = filter_var($_POST['review'], FILTER_SANITIZE_STRING);

      $this->model('Review')->save($userId, $title, $poster, $imdbId, $rating, $review);
      
      if (isset($_SESSION['auth'])) {
        header('Location: /reviews/all');
      } else {
        header('Location: /home');
      }
      exit;
    }
  }

  public function all() {
    $reviews = $this->model('Review')->getAllReviewsByUserId($_SESSION['user_id']);
    
    $this->view('movie/reviews', ['reviews' => $reviews]);
    die;
  }
}

?>