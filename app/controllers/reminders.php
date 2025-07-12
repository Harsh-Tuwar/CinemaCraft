<?php

class Reminders extends Controller {

   public function index() {
     $reminder = $this->model('Reminder');
     $userId = $_SESSION['user_id'] ?? null;
     $reminders = $reminder->getAllRemindersByUserId($userId);
     $this->view('reminders/index', ['reminders' => $reminders]);
   }

    public function create() {
      $this->view('reminders/create');
    }

    public function edit() {
      $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
      $segments = explode('/', $uri);

      $id = isset($segments[2]) ? (int) $segments[2] : null;
      
      if (!$id) {
          $_SESSION['reminder_error'] = "Missing reminder ID.";
          header("Location: /reminders");
          exit;
      }

      $reminder = $this->model('Reminder');
      $reminderData = $reminder->getReminderById($id);
      $this->view('reminders/edit', ['reminder' => $reminderData]);
    }

    public function save() {
      $reminder = $this->model('Reminder');
      
      $subject = $_REQUEST['subject'];
      $user_id = $_REQUEST['user_id'];
      $completed = isset($_REQUEST['completed']) ? 1 : 0;
      $note_id = isset($_REQUEST['note_id']) ? $_REQUEST['note_id'] : null;

      if ($note_id) {
        $reminder->updateReminder($note_id, $subject, $completed);
      } else {
        $reminder->createReminder($user_id, $subject, $completed);
      }
    }

    public function delete() {
      $reminder = $this->model('Reminder');
      $reminderId = $_REQUEST['note_id'];
      $reminder->deleteReminder($reminderId);
    }
}