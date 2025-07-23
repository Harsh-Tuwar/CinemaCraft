<?php 
if (!isset($_SESSION['auth'])) {
  require_once 'app/views/templates/headerPublic.php'; 
} else {
  require_once 'app/views/templates/header.php';
}
?>

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
            <input type="hidden" id="imdbId" value="<?= $movie['imdbID'] ?>">
            
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

<form action="/reviews/submit" method="POST">
  <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="reviewModalLabel">Leave a Review</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body text-center">
          <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
          <input type="hidden" name="movie_title" id="formMovieTitle">
          <input type="hidden" name="movie_poster" id="formMoviePoster">
          <input type="hidden" name="imdbId" id="formImdbId">
          <input type="hidden" name="rating" id="formRating">

          <p id="modalMovieTitle" class="mb-3 fw-bold"></p>

          <div class="star-rating mb-3">
            <?php for ($i = 1; $i <= 5; $i++): ?>
              <i class="bi bi-star" data-value="<?= $i ?>"></i>
            <?php endfor; ?>
          </div>

          <div class="mb-3 text-start">
            <label for="modalGeneratedReview" class="form-label bold">Write your review</label>
            <textarea class="form-control" id="modalGeneratedReview" rows="8" placeholder="Write your review here..." name="review"></textarea>
          </div>

          <button type="button" class="btn btn-secondary" id="generateReviewButton">
            Generate Review
          </button>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit Review</button>
        </div>

      </div>
    </div>
  </div>
</form>



<script>
  const reviewModal = document.getElementById('reviewModal');

  reviewModal.addEventListener('show.bs.modal', function (event) {
    const card = event.relatedTarget;
    const title = card.getAttribute('data-title');
    const poster = card.querySelector('img').getAttribute('src');
    const imdbId = card.getAttribute('data-imdbid');

    document.getElementById('modalMovieTitle').textContent = title;
    document.getElementById('formMovieTitle').value = title;
    document.getElementById('formMoviePoster').value = poster;
    document.getElementById('formImdbId').value = imdbId;

    // reset stars
    document.querySelectorAll('.star-rating i').forEach(star => {
      star.classList.remove('selected', 'bi-star-fill');
      star.classList.add('bi-star');
    });
    document.getElementById('formRating').value = '';
  });

  reviewModal.addEventListener('hidden.bs.modal', function () {
    const reviewContainer = document.getElementById('modalGeneratedReview');

    reviewContainer.value = '';
  });

  document.getElementById('generateReviewButton').addEventListener('click', () => {
    const title = document.getElementById('formMovieTitle').value;
    const reviewContainer = document.getElementById('modalGeneratedReview');

    reviewContainer.value = '🤖 Generating review using AI...';
    reviewContainer.disabled = true;

    fetch(`/movies/generateReview?title=${encodeURIComponent(title)}`)
      .then(response => {
        if (!response.ok) {
          throw new Error('Failed to fetch review');
        }
        return response.json();
      })
      .then(data => {
        if (data.review) {
          reviewContainer.value = data.review;
        } else {
          reviewContainer.value = 'No review generated.';
        }
      })
      .catch(error => {
        console.error(error);
        reviewContainer.value = 'Error loading review.';
      }).finally(() => {
        reviewContainer.disabled = false;
      });
  });

  document.querySelectorAll('.star-rating i').forEach(star => {
    star.addEventListener('click', () => {
      const rating = star.getAttribute('data-value');
      document.getElementById('formRating').value = rating;

      document.querySelectorAll('.star-rating i').forEach(s => {
        s.classList.remove('selected', 'bi-star-fill');
        s.classList.add('bi-star');
      });

      for (let i = 0; i < rating; i++) {
        const s = document.querySelectorAll('.star-rating i')[i];
        s.classList.add('selected', 'bi-star-fill');
        s.classList.remove('bi-star');
      }
    });
  });
</script>

<?php require_once 'app/views/templates/footer.php'; ?>
