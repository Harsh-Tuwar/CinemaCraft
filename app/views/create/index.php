<?php require_once 'app/views/templates/headerPublic.php' ?>

<main role="main" class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
  <div class="col-md-6 col-lg-5">

    <div class="text-center mb-4">
      <h1 class="h3 fw-bold text-primary">Create Your Account</h1>
      <p class="text-muted">Join us today. It's quick and easy.</p>
    </div>

    <?php if (isset($_SESSION['signup_error'])): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_SESSION['signup_error']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php unset($_SESSION['signup_error']); endif; ?>

    <div class="card shadow-sm border-0">
      <div class="card-body p-4">
        <form action="/create/new_account" method="post">

          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input required type="text" class="form-control" name="username" id="username" placeholder="Choose a username">
          </div>

          <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input required type="password" class="form-control" name="password" id="password" placeholder="Create a password">
          </div>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Create Account</button>
            <a href="/login" class="btn btn-outline-secondary">Already have an account? Sign in</a>
          </div>

        </form>
      </div>
    </div>

  </div>
</main>

<?php require_once 'app/views/templates/footer.php' ?>
