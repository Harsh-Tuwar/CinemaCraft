<?php

class Review extends Controller {
  public function submit() {
    $userId = $_SESSION['user_id'];
    $movieTitle = $_POST['movie_title'];
    $moviePoster = $_POST['movie_poster'];
    $imdbId = $_POST['imdbId'];
    $rating = $_POST['rating'];

    $reviewModel = $this->model('Review');
    $reviewId = $reviewModel->create($userId, $movieTitle, $moviePoster, $imdbId, $rating);
  }
}

?>