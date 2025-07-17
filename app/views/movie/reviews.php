<?php require_once 'app/views/templates/header.php' ?>

<div class="container mt-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">My Reviews</li>
    </ol>
  </nav>

  <h1 class="mb-4">My Movie Reviews</h1>

  <?php if (empty($data['reviews'])): ?>
    <div class="alert alert-warning">No reviews submitted yet.</div>
  <?php else: ?>
    <div class="row g-4">
      <?php foreach ($data['reviews'] as $review): ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card h-100 shadow-sm border-0">
            <img 
              src="<?= htmlspecialchars($review['poster'] ?? 'https://placehold.co/300x400?text=No+Poster') ?>" 
              class="card-img-top" 
              alt="<?= htmlspecialchars($review['title']) ?>"
              style="height: 300px; object-fit: cover; border-radius: 0.5rem 0.5rem 0 0;"
            >
            <div class="card-body d-flex flex-column">
              <h6 class="card-title text-truncate mb-2"><?= htmlspecialchars($review['title']) ?></h6>
              <p class="card-text text-muted small mb-2">
                <?= (new DateTime($review['submittedAt']))->format('M j, Y g:i A') ?>
              </p>
              <div class="mt-auto">
                <div class="text-warning">
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
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php require_once 'app/views/templates/footer.php' ?>
