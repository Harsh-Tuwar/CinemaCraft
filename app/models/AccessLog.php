<?php
  class AccessLog {
    public function __construct() {
      
    }

    public function getTotalNumberOfLogs() {
      $db = db_connect();
      $query = $db->prepare("SELECT count(*) as count FROM access_logs;");
      $query->execute();
      $rows = $query->fetch(PDO::FETCH_ASSOC);
      return $rows['count'];
    }

    public function getMaxStatsOfLogin() {
      $db = db_connect();
      $query = $db->prepare("
        (
            SELECT 
                username, 
                COUNT(*) AS login_count,
                'Failed' AS login_type
            FROM access_logs
            WHERE success_attempt = 0
            GROUP BY username
            ORDER BY login_count DESC
            LIMIT 1
        )
        UNION ALL
        (
            SELECT 
                username, 
                COUNT(*) AS login_count,
                'Successful' AS login_type
            FROM access_logs
            WHERE success_attempt = 1
            GROUP BY username
            ORDER BY login_count DESC
            LIMIT 1
        );
      ");
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_ASSOC); 

      $data = [
          'bad' => [
              'username' => $results[0]['username'] ?? null,
              'attempt'  => $results[0]['login_count'] ?? 0
          ],
          'good' => [
              'username' => $results[1]['username'] ?? null,
              'attempt'  => $results[1]['login_count'] ?? 0
          ]
      ];

      return $data;
    }
    
    public function logAccess($username, $success) {
      $db = db_connect();
      $serverTimestamp = date('Y-m-d H:i:s');
      
      $query = 'INSERT INTO access_logs (username, success_attempt, timestamp) VALUES (:username, :success, :timestamp)';
      
      $stmt = $db->prepare($query);
      
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':success', $success);
      $stmt->bindParam(':timestamp', $serverTimestamp);
      $stmt->execute();
      
      return;
    }

    public function getLastLogByUsername($username) {
      $db = db_connect();
      $query = "SELECT * FROM access_logs 
                WHERE username = :username 
                AND success_attempt = 0
                ORDER BY timestamp DESC 
                LIMIT 1";

      $stmt = $db->prepare($query);
      $stmt->bindParam(':username', $username);
      $stmt->execute();

      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllLogs() {
        $db = db_connect();
        $query = $db->prepare("SELECT * FROM access_logs ORDER BY timestamp DESC;");
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getLoginAttemptsByUser() {
        $db = db_connect();
        $query = $db->prepare("
            SELECT username, COUNT(*) as attempts
            FROM access_logs
            WHERE success_attempt = 1
            GROUP BY username
            ORDER BY attempts DESC;
        ");
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
}  
