<?php require_once 'app/views/templates/header.php' ?>

<div class="container mt-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Reminders</li>
    </ol>
  </nav>
  
  <div class="page-header mb-4 d-flex justify-content-between align-items-center">
    <h1>Reminders</h1>
    <a href="/reminders/create" class="btn btn-primary">
      + New Reminder
    </a>
  </div>

  <?php if (isset($_SESSION['reminder_error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?php echo $_SESSION['reminder_error']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>
  
  <?php if (!empty($data['reminders'])): ?>
    <div class="list-group">
      <?php foreach ($data['reminders'] as $note): ?>
        <div class="list-group-item d-flex justify-content-between align-items-start 
                    <?php echo $note['completed'] ? 'list-group-item-success' : ''; ?>">
          <div class="me-auto">
            <h5 class="mb-1"><?php echo htmlspecialchars($note['subject']); ?></h5>
            <small class="text-muted">
              Created on: <?php echo date('M d, Y H:i', strtotime($note['createdAt'])); ?>
            </small>
            <br>

            <?php if (!empty($note['completed']) && !empty($note['completedAt'])): ?>
              <small class="text-success">
                Completed on: <?php echo date('M d, Y H:i', strtotime($note['completedAt'])); ?>
              </small><br>
            <?php endif; ?>

            <?php if (!empty($note['deleted']) && !empty($note['deletedAt'])): ?>
              <small class="text-danger">
                Deleted on: <?php echo date('M d, Y H:i', strtotime($note['deletedAt'])); ?>
              </small>
            <?php endif; ?>
          </div>

          <div class="text-end">
            <?php if ($note['completed']): ?>
              <span class="badge bg-success">Completed</span>
            <?php else: ?>
              <span class="badge bg-warning text-dark">Pending</span>
            <?php endif; ?>

            <?php if ($note['deleted']): ?>
              <span class="badge bg-danger ms-1">Deleted</span>
            <?php endif; ?>

            <div class="mt-2">
              <a href="/reminders/edit/<?php echo $note['id']; ?>" class="btn btn-sm btn-outline-secondary me-1">
                Edit
              </a>

              <form action="/reminders/delete/<?php echo $note['id']; ?>" method="POST" style="display:inline;">
                <input type="hidden" name="note_id" value="<?php echo $note['id'] ?>">
                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this reminder?');">
                  Delete
                </button>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="alert alert-info">No reminders found.</div>
  <?php endif; ?>
</div>

<?php require_once 'app/views/templates/footer.php' ?>
