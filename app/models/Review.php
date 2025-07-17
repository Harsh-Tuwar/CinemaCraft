<?php

class Review {
  public function __construct() {}
  
  public function save($userId, $movieTitle, $moviePoster, $imdbId, $rating) {
    $db = db_connect();
    $serverTimestamp = date('Y-m-d H:i:s');
    
    $statement = $db->prepare("INSERT INTO reviews (userId, movieTitle, moviePosterUrl, imdbId, rating, createdAt) VALUES (:user_id, :movie_title, :movie_poster, :imdbId, :rating, :timestamp)");
    
    $statement->bindValue(':user_id', $userId ?? 0, PDO::PARAM_INT);
    $statement->bindValue(':movie_title', $movieTitle);
    $statement->bindValue(':movie_poster', $moviePoster);
    $statement->bindValue(':imdbId', $imdbId);
    $statement->bindValue(':rating', intval($rating));
    $statement->bindParam(':timestamp', $serverTimestamp);
    
    $statement->execute();
    
    return $db->lastInsertId();
  }
}

?>