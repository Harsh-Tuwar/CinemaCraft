<?php require_once 'app/views/templates/headerPublic.php'; ?>

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
    text-overflow: no-wrap;
    /* white-space: normal; */
    /* overflow-wrap: break-word; */
  }
  .movie-date {
    font-size: 0.8rem;
    color: #aaa;
  }
  .star-rating {
    color: #f1c40f;
    font-size: 1rem;
  }
  #modalMovieReview {
    font-size: 1rem;
    line-height: 1.6;
  }
</style>

<main class="container mt-5 flex-grow-1">

  <?php require_once 'app/views/components/search.php'; ?>

  <div class="text-center mt-4">
    <p class="text-muted"><a href="/login">Login</a> or <a href="/create">register</a> to store your reviews.</p>
  </div>

  <?php if (empty($data['reviews'])): ?>
    <div class="alert alert-warning bg-dark text-white border border-warning">No reviews submitted yet.</div>
  <?php else: ?>
    <div class="position-relative" style="overflow: visible;">
      <div class="row g-3">
        <?php foreach ($data['reviews'] as $review): ?>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="movie-card" 
             data-title="<?= htmlspecialchars($review['movieTitle']) ?>"
             data-review="<?= htmlspecialchars(html_entity_decode($review['review']))  ?>"
             data-bs-toggle="modal" 
             data-bs-target="#movieReviewModal">
              <img 
                src="<?= htmlspecialchars($review['moviePosterUrl'] ?? 'https://placehold.co/300x400?text=No+Poster') ?>" 
                alt="<?= htmlspecialchars($review['movieTitle']) ?>"
              >
              <div class="movie-info">
                <div class="movie-title" style="white-space: normal; overflow-wrap: break-word;">
                  <?= htmlspecialchars($review['movieTitle']) ?>
                </div>
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
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
</main>

<!-- Review Modal -->
<div class="modal fade" id="movieReviewModal" tabindex="-1" aria-labelledby="movieReviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="movieReviewModalLabel">Movie Review</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5 id="modalMovieTitle"></h5>
        <p id="modalMovieReview" class="mt-3"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  const reviewModal = document.getElementById('movieReviewModal');

  reviewModal.addEventListener('show.bs.modal', function (event) {
    const card = event.relatedTarget;
    const title = card.getAttribute('data-title');
    const review = card.getAttribute('data-review');

    document.getElementById('modalMovieTitle').textContent = title;
    document.getElementById('modalMovieReview').textContent = review || 'No review available.';
  });
</script>

<?php require_once 'app/views/templates/footer.php'; ?>
