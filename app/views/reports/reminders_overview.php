<?php require_once 'app/views/templates/header.php' ?>

<div class="container mt-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Home</a></li>
      <li class="breadcrumb-item"><a href="/reports">Reports</a></li>
      <li class="breadcrumb-item active" aria-current="page">All Reminders</li>
    </ol>
  </nav>

  <h1 class="mb-4">All Reminders</h1>

  <div class="row mb-4">
    <div class="col-12 mb-3">
      <div class="card border-dark shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Reminder Stats Overview</h5>
          <div class="row mt-3">
            <div class="col-md-4">
              <p class="mb-2">Total Reminders:</p>
              <h6><strong><?= $data['totals']['all'] ?></strong></h6>
            </div>
            <div class="col-md-4">
              <p class="mb-2 text-success">Completed:</p>
              <h6 class="text-success"><strong><?= $data['totals']['completed'] ?></strong></h6>
            </div>
            <div class="col-md-4">
              <p class="mb-2 text-danger">Incomplete:</p>
              <h6 class="text-danger"><strong><?= $data['totals']['incomplete'] ?></strong></h6>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-primary shadow-sm">
        <div class="card-body text-center">
          <h6 class="card-title mb-2">Most Reminders</h6>
          <p class="mb-1"><strong><?= htmlspecialchars($data['summary']['top_created']['username']) ?></strong></p>
          <small class="text-muted"><?= $data['summary']['top_created']['count'] ?> reminders</small>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-success shadow-sm">
        <div class="card-body text-center">
          <h6 class="card-title mb-2">Most Completed</h6>
          <p class="mb-1"><strong><?= htmlspecialchars($data['summary']['top_completed']['username']) ?></strong></p>
          <small class="text-muted"><?= $data['summary']['top_completed']['count'] ?> completed</small>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-danger shadow-sm">
        <div class="card-body text-center">
          <h6 class="card-title mb-2">Most Incomplete</h6>
          <p class="mb-1"><strong><?= htmlspecialchars($data['summary']['top_incomplete']['username']) ?></strong></p>
          <small class="text-muted"><?= $data['summary']['top_incomplete']['count'] ?> incomplete</small>
        </div>
      </div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
      <thead class="table-dark">
        <tr>
          <th>Reminder ID</th>
          <th>Username</th>
          <th>Subject</th>
          <th>Created At</th>
          <th>Completed</th>
          <th>Completed At</th>
          <th>Deleted</th>
          <th>Deleted At</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['reminders'] as $reminder): ?>
          <tr>
            <td><?= htmlspecialchars($reminder['reminder_id']) ?></td>
            <td><?= htmlspecialchars($reminder['username']) ?></td>
            <td><?= htmlspecialchars($reminder['subject']) ?></td>
            <td>
              <?php
                $created = new DateTime($reminder['createdAt']);
                echo $created->format('M j, Y g:i A');
              ?>
            </td>
            <td>
              <?= $reminder['completed'] ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-secondary">No</span>' ?>
            </td>
            <td>
              <?= $reminder['completedAt'] ? (new DateTime($reminder['completedAt']))->format('M j, Y g:i A') : '-' ?>
            </td>
            <td>
              <?= $reminder['deleted'] ? '<span class="badge bg-danger">Yes</span>' : '<span class="badge bg-secondary">No</span>' ?>
            </td>
            <td>
              <?= $reminder['deletedAt'] ? (new DateTime($reminder['deletedAt']))->format('M j, Y g:i A') : '-' ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>
