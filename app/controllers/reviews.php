<?php

class Reviews extends Controller {
  public function submit() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $userId = $_POST['user_id'];
      $title = filter_var($_POST['movie_title'], FILTER_SANITIZE_STRING);
      $poster = filter_var($_POST['movie_poster'], FILTER_SANITIZE_URL);
      $imdbId = $_POST['imdbId'];
      $rating = $_POST['rating'];

      $this->model('Review')->save($userId, $title, $poster, $imdbId, $rating);
      if (isset($_SESSION['auth'])) {
        header('Location: /dashboard');
      } else {
        header('Location: /home');
      }
      exit;
    }
  }

  public function all() {
    $this->view('movie/reviews');
    die;
  }
}

?>