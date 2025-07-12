<?php

class Reports extends Controller {
  
  public function index() {
      $users = $this->model('User');
      $reminders = $this->model('Reminder');
      $logs = $this->model('AccessLog');

      $total_users = $users->getNumberOfUsers();
      $total_reminders = $reminders->getTotalNumberOfReminders();
      $total_logs = $logs->getTotalNumberOfLogs();
      $total_logins_by_username = $logs->getLoginAttemptsByUser();
      $max_stats = $logs->getMaxStatsOfLogin();

      $x_axis = array_column($total_logins_by_username, 'username');
      $y_axis = array_map('intval', array_column($total_logins_by_username, 'attempts'));

      $chart_data = [
          'labels' => $x_axis,
          'counts' => $y_axis
      ];

      $this->view('reports/index', [
          'total_users' => $total_users,
          'total_reminders' => $total_reminders,
          'total_logs' => $total_logs,
          'failed_attempts' => $max_stats['bad'],
          'successful_attempts' => $max_stats['good'],
          'chart_data' => $chart_data,
      ]);
  }

  public function all_logs() {
    $this->view('reports/all_logs', [
                'logs' => $this->model('AccessLog')->getAllLogs()
    ]);
  }

  public function reminders() {
    $reminders = $this->model('Reminder');
    $accessLogs = $this->model('AccessLog');

    $reminder_totals = $reminders->getReminderTotals();
    $summary = $reminders->getReminderTopsSummary();
    
    $this->view('reports/reminders_overview', [
                'reminders' => $reminders->getAllReminders(),
                'totals' => $reminder_totals,
                'summary' => $summary,
    ]);
  }
}

?>