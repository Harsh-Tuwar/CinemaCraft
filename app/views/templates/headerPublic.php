<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cinema Craft | Dashboard</title>
    <link rel="icon" href="/favicon.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

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
          <i class="bi bi-shield-lock-fill me-1"></i> Cinema Craft
        </a>
        <div class="d-flex">
          <a href="/home" class="btn btn-link">Search a movie</a>
          <a href="/login" class="btn btn-outline-primary me-2">Login</a>
          <a href="/create" class="btn btn-primary">Register</a>
        </div>
      </div>
    </nav>
