<?php
  if (!isset($_SESSION['auth'])) {
      header('Location: /home');
      exit;
  }
?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <title>Cinema Craft</title>
    <link rel="icon" href="/favicon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <style>
      html, body {
        height: 100%;
      }

      body {
        display: flex;
        flex-direction: column;
      }

      main {
        flex: 1 0 auto;
      }

      footer {
        flex-shrink: 0;
      }

      .nav-link.active {
        font-weight: bold;
        border-bottom: 2px solid #0d6efd;
      }

      .navbar-brand {
        font-size: 1.5rem;
        font-weight: 700;
      }
    </style>
  </head>
  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm border-bottom">
      <div class="container">
        <a class="navbar-brand" href="/dashboard">Cinema Craft</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <!-- Left Links -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    
            <li class="nav-item">
              <a class="nav-link<?= $_SERVER['REQUEST_URI'] === '/dashboard' ? ' active' : '' ?>" href="/dashboard">Dashboard</a>
            </li>
    
            <li class="nav-item">
              <a class="nav-link<?= str_contains($_SERVER['REQUEST_URI'], 'reminders') && !str_contains($_SERVER['REQUEST_URI'], 'reports') ? ' active' : '' ?>" href="/reminders">Reminders</a>
            </li>

            <li class="nav-item">
              <a class="nav-link<?= str_contains($_SERVER['REQUEST_URI'], 'reviews') ? ' active' : '' ?>" href="/reviews/all">Reviews</a>
            </li>
            
            <?php if (isset($_SESSION['admin'])): ?>
              <li class="nav-item">
                <a class="nav-link<?= in_array($_SERVER['REQUEST_URI'], ['/reports', '/reports/all_logs', '/reports/reminders'])  ? ' active' : '' ?>" href="/reports">Reports</a>
              </li>
            <?php endif; ?>
          
          </ul>

          <!-- Right Side: User + Logout -->
          <ul class="navbar-nav ms-auto">
            <li class="nav-item d-flex align-items-center me-3 text-muted">
              👤 <?= htmlspecialchars($_SESSION['username']) ?>
            </li>
            <li class="nav-item">
              <a href="/logout" class="btn btn-outline-danger">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
