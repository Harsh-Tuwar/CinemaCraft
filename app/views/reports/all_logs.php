<?php require_once 'app/views/templates/header.php' ?>

<div class="container mt-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Home</a></li>
      <li class="breadcrumb-item"><a href="/reports">Reports</a></li>
      <li class="breadcrumb-item active" aria-current="page">All Logs</li>
    </ol>
  </nav>
  
  <h1 class="mb-4">All Logs</h1>

  <div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
      <thead class="table-dark">
        <tr>
          <th>Log ID</th>
          <th>Username</th>
          <th>Login Type</th>
          <th>Timestamp</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data["logs"] as $log): ?>
          <tr>
            <td><?= htmlspecialchars($log['id']) ?></td>
            <td><?= htmlspecialchars($log['username']) ?></td>
            <td>
              <?= $log['success_attempt'] == 1
                  ? '<span class="badge bg-success">Successful</span>'
                  : '<span class="badge bg-danger">Failed</span>' ?>
            </td>
            <td>
              <?php
                $date = new DateTime($log['timestamp']);
                echo $date->format('M j, Y g:i A'); // e.g. Jul 9, 2025 5:04 PM
              ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>
