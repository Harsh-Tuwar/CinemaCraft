<?php require_once 'app/views/templates/headerPublic.php'; ?>

<main class="container py-4">
  <h1 class="h3 mb-4">Search Results</h1>

  <?php if (!empty($data['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($data['error']) ?></div>
  <?php elseif (!empty($data['movies']['Search'])): ?>
    <div class="row">
      <?php foreach ($data['movies']['Search'] as $movie): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <?php
              $poster = ($movie['Poster'] !== 'N/A' && !empty($movie['Poster']))
                ? htmlspecialchars($movie['Poster'])
                : 'https://placehold.co/600x400';
            ?>
            <img 
              src="<?= $poster ?>" 
              class="card-img-top" 
              alt="<?= htmlspecialchars($movie['Title']) ?>" 
              onerror="this.onerror=null;this.src='https://placehold.co/600x400';"
            >
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($movie['Title']) ?></h5>
              <p class="card-text"><?= htmlspecialchars($movie['Year']) ?></p>
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
