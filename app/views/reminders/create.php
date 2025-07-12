<?php require_once 'app/views/templates/header.php' ?>

<div class="container mt-5">
  <div class="page-header mb-4 d-flex justify-content-between align-items-center">
    <h1>Create a Reminder</h1>
  </div>

  <?php if (isset($_SESSION['reminder_error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?php echo $_SESSION['reminder_error']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <form action="/reminders/save" method="POST">
    <div class="mb-3">
      <label for="subject" class="form-label">Subject</label>
      <input 
        type="text" 
        class="form-control" 
        id="subject" 
        name="subject" 
        placeholder="Enter reminder subject" 
        required>
    </div>

    <div class="form-check mb-3">
      <input 
        class="form-check-input" 
        type="checkbox" 
        value="1" 
        id="completed" 
        name="completed">
      <label class="form-check-label" for="completed">
        Mark as Completed
      </label>
    </div>

    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">

    <button type="submit" class="btn btn-success">Create Reminder</button>
    <a href="/reminders" class="btn btn-secondary ms-2">Cancel</a>
  </form>
</div>

<?php require_once 'app/views/templates/footer.php' ?>
