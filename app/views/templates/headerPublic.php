  <?php
  if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
      header('Location: /home');
      exit;
  }
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>COSC 4806 | Dashboard</title>
    <link rel="icon" href="/favicon.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
      html, body {
        height: 100%;
      }

      body {
        display: flex;
        flex-direction: column;
        font-family: 'Segoe UI', sans-serif;
        background-color: #f8f9fa;
      }

      main {
        flex: 1 0 auto;
      }

      footer {
        flex-shrink: 0;
      }

      .navbar-brand {
        font-weight: 600;
        font-size: 1.25rem;
        letter-spacing: 0.5px;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand text-primary" href="/">
          <i class="bi bi-shield-lock-fill me-1"></i> COSC 4806
        </a>
        <div class="d-flex">
          <a href="/login" class="btn btn-outline-primary me-2">Login</a>
          <a href="/create" class="btn btn-primary">Register</a>
        </div>
      </div>
    </nav>
