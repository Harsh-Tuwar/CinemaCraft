<?php require_once 'app/views/templates/headerPublic.php'; ?>

<style>
  body {
    background-color: #f8f9fa; /* light neutral background */
  }
  .movie-card {
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 10px;
    background-color: #000;
  }
  .movie-card img {
    object-fit: cover;
    width: 100%;
    height: 320px;
    display: block;
    border-radius: 10px;
  }
  .movie-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    z-index: 10;
  }
  .movie-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 0.4rem;
    background: rgba(0, 0, 0, 0.65);
    color: #fff;
    text-align: center;
  }
  .movie-title {
    font-size: 0.95rem;
    font-weight: 600;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .movie-year {
    font-size: 0.8rem;
    margin: 0;
    opacity: 0.8;
  }
  .results-header {
    font-size: 1.1rem;
    font-weight: 500;
    color: #666;
    margin-bottom: 1.2rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }
</style>

<main class="container py-4">
  <?php require_once 'app/views/components/search.php'; ?>
  
  <h6 class="results-header">Search Results</h6>

  <?php if (!empty($data['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($data['error']) ?></div>
  <?php elseif (!empty($data['movies']['Search'])): ?>
    <div class="row g-3">
      <?php foreach ($data['movies']['Search'] as $movie): ?>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <div class="movie-card">
            <?php
              $poster = ($movie['Poster'] !== 'N/A' && !empty($movie['Poster']))
                ? htmlspecialchars($movie['Poster'])
                : "https://placehold.co/300x436";
            ?>
            <img 
              src="<?= $poster ?>" 
              alt="<?= htmlspecialchars($movie['Title']) ?>"
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
