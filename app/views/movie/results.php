<?php require_once 'app/views/templates/headerPublic.php'; ?>

<style>
  body {
    background-color: #f8f9fa;
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
  .star-rating i {
    font-size: 1.8rem;
    color: #ccc;
    cursor: pointer;
    transition: color 0.2s;
  }
  .star-rating i.selected {
    color: #f1c40f;
  }
  /* .star-rating i:hover, */
  /* .star-rating i:hover ~ i */
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
          <div class="movie-card" data-imdbid="<?php echo $movie['imdbID'] ?>" data-bs-toggle="modal" data-bs-target="#reviewModal" data-title="<?= htmlspecialchars($movie['Title']) ?>">
            <?php
              $poster = ($movie['Poster'] !== 'N/A' && !empty($movie['Poster'])) && getimagesize($movie['Poster'])
                ? htmlspecialchars($movie['Poster'])
                : "https://placehold.co/300x436?text=" . urlencode($movie['Title']);
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

<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reviewModalLabel">Leave a Review</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p id="movieTitle" class="mb-3 fw-bold"></p>
        <div class="star-rating">
          <i class="bi bi-star" data-value="1"></i>
          <i class="bi bi-star" data-value="2"></i>
          <i class="bi bi-star" data-value="3"></i>
          <i class="bi bi-star" data-value="4"></i>
          <i class="bi bi-star" data-value="5"></i>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Submit Review</button>
      </div>
    </div>
  </div>
</div>

<script>
  const reviewModal = document.getElementById('reviewModal');
  reviewModal.addEventListener('show.bs.modal', function (event) {
    const card = event.relatedTarget;
    const title = card.getAttribute('data-title');
    const modalTitle = reviewModal.querySelector('#movieTitle');
    modalTitle.textContent = title;

    reviewModal.querySelectorAll('.star-rating i').forEach(star => star.classList.remove('selected'));
  });

  function highlightStars(value) {
    document.querySelectorAll('.star-rating i').forEach((star, index) => {
      if (index < value) {
        star.classList.add('bi-star-fill');
        star.classList.add('selected');
        star.classList.remove('bi-star');
      } else {
        star.classList.remove('bi-star-fill');
        star.classList.remove('selected');
        star.classList.add('bi-star');
      }
    }); 
  }

  function handleSubmit() {
    const selectedStars = document.querySelectorAll('.star-rating i.selected').length;
    const reviewModal = document.getElementById('reviewModal');

    console.log(`Selected Rating: ${selectedStars}`);
    highlightStars(0);
    const bootstrapModal = bootstrap.Modal.getInstance(reviewModal);
    bootstrapModal.hide();
  }
  
  const stars = document.querySelectorAll('.star-rating i');
  stars.forEach((item) => {
    item.addEventListener('mouseover', function() {
      highlightStars(item.dataset.value);
    });

    item.addEventListener('click', () => handleSubmit());
  });

  document.querySelector('.modal-footer button').addEventListener('click', function() {
    handleSubmit();
  });
</script>

<?php require_once 'app/views/templates/footer.php'; ?>
