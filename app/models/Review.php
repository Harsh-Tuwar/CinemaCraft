<?php

class Review {
  public function create($userId, $movieTitle, $moviePoster, $imdbId, $rating) {
    $db = db_connect();
    $statement = $db->prepare("INSERT INTO reviews (user_id, movie_title, movie_poster, imdbId, rating) VALUES (:user_id, :movie_title, :movie_poster, :imdbId, :rating)");
    $statement->bindValue(':user_id', $userId);
    $statement->bindValue(':movie_title', $movieTitle);
    $statement->bindValue(':movie_poster', $moviePoster);
    $statement->bindValue(':imdbId', $imdbId);
    $statement->bindValue(':rating', $rating);
    $statement->execute();
    return $db->lastInsertId();
  }
}

?>