<?php require_once 'app/views/templates/header.php' ?>

<main class="container mt-5 flex-grow-1">
  <div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">

      <div class="card shadow-lg border-0 bg-light">
        <div class="card-body text-center p-5">
       
          <h1 class="display-5 fw-bold mb-3">
            Welcome back, <?= htmlspecialchars($_SESSION['username']) ?>! 👋
          </h1>

          <p class="lead text-muted mb-4">
            Today is <strong><?= date("l, F jS, Y") ?></strong>
          </p>

          <?php if (isset($_SESSION['admin'])): ?>
            <div class="alert alert-primary d-inline-block px-4 py-2 mb-4">
              <strong>Admin Mode:</strong> You have administrative privileges.
            </div>
          <?php endif; ?>

          <div class="d-flex justify-content-center gap-3 mt-3 flex-wrap">
            <?php if (isset($_SESSION['admin'])): ?>
              <a href="/reports" class="btn btn-outline-primary px-4">
                📊 View Reports
              </a>
            <?php endif; ?>
            <a href="/reminders" class="btn btn-outline-success px-4">
              📝 My Reminders
            </a>
            <a href="/logout" class="btn btn-danger px-4">
              🚪 Logout
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</main>

<?php require_once 'app/views/templates/footer.php' ?>
