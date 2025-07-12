<?php require_once 'app/views/templates/headerPublic.php'; ?>

<style>
  .movie-card {
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease;
    border-radius: 8px;
  }
  .movie-card img {
    object-fit: cover;
    width: 100%;
    height: 350px;
    display: block;
  }
  .movie-card:hover {
    transform: scale(1.05);
    z-index: 10;
  }
  .movie-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 0.5rem;
    background: rgba(0, 0, 0, 0.7);
    color: #fff;
    text-align: center;
  }
  .movie-title {
    font-size: 1rem;
    font-weight: bold;
    margin: 0;
  }
  .movie-year {
    font-size: 0.85rem;
    margin: 0;
  }
</style>

<main class="container py-4">
  <h1 class="h3 mb-4">Search Results</h1>

  <?php if (!empty($data['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($data['error']) ?></div>
  <?php elseif (!empty($data['movies']['Search'])): ?>
    <div class="row g-3">
      <?php foreach ($data['movies']['Search'] as $movie): ?>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <div class="movie-card shadow-sm">
            <?php
              // Default poster placeholder size matching card dimensions (350px height, adjust width accordingly)
              $posterWidth = 600;
              $posterHeight = 350;

              $poster = ($movie['Poster'] !== 'N/A' && !empty($movie['Poster']))
                ? htmlspecialchars($movie['Poster'])
                : "https://placehold.co/{$posterWidth}x{$posterHeight}";
            ?>
            <img 
              src="<?= $poster ?>" 
              alt="<?= htmlspecialchars($movie['Title']) ?>" 
              onerror="this.onerror=null;this.src='https://placehold.co/300x436';"
            >
            <div class="movie-overlay">
              <p class="movie-title"><?= htmlspecialchars($movie['Title']) ?></p>
              <p class="movie-year"><?= htmlspecialchars($movie['Year']) ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p>No results found.</p>
  <?php endif; ?>

</main>

<?php require_once 'app/views/templates/footer.php'; ?>
