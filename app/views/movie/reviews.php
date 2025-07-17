<?php require_once 'app/views/templates/header.php' ?>

<style>
  .review-section-title {
    font-size: 1.6rem;
    font-weight: 600;
    margin-bottom: 1rem;
  }
  .review-scroll-container {
    display: flex;
    gap: 1rem;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding-bottom: 1rem;
  }
  .review-scroll-container::-webkit-scrollbar {
    height: 8px;
  }
  .review-scroll-container::-webkit-scrollbar-thumb {
    background: #444;
    border-radius: 4px;
  }
  .movie-card {
    min-width: 200px;
    background-color: #222;
    border: none;
    border-radius: 10px;
    overflow: hidden;
    flex-shrink: 0;
    transition: transform 0.3s ease;
    position: relative;
  }
  .movie-card:hover {
    transform: scale(1.05);
    z-index: 2;
  }
  .movie-card img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    display: block;
  }
  .movie-info {
    padding: 0.7rem;
  }
  .movie-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.2rem;
    color: #fff;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .movie-date {
    font-size: 0.8rem;
    color: #aaa;
  }
  .star-rating {
    color: #f1c40f;
    font-size: 1rem;
  }
</style>

<div class="container mt-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/dashboard" class="breadcrumb-item">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">My Reviews</li>
    </ol>
  </nav>

  <h1 class="review-section-title">My Movie Reviews</h1>

  <?php if (empty($data['reviews'])): ?>
    <div class="alert alert-warning bg-dark text-white border border-warning">No reviews submitted yet.</div>
  <?php else: ?>
    <div class="position-relative" style="overflow: visible;">
      <div class="review-scroll-container p-3">
        <?php foreach ($data['reviews'] as $review): ?>
          <div class="movie-card">
            <img 
              src="<?= htmlspecialchars($review['moviePosterUrl'] ?? 'https://placehold.co/300x400?text=No+Poster') ?>" 
              alt="<?= htmlspecialchars($review['movieTitle']) ?>"
            >
            <div class="movie-info">
              <div class="movie-title"><?= htmlspecialchars($review['movieTitle']) ?></div>
              <div class="movie-date">
                <?= (new DateTime($review['createdAt']))->format('M j, Y') ?>
              </div>
              <div class="star-rating mt-1">
                <?php
                  $rating = (int)$review['rating'];
                  for ($i = 1; $i <= 5; $i++) {
                    echo $i <= $rating ? '★' : '☆';
                  }
                ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
</div>

<?php require_once 'app/views/templates/footer.php' ?>
