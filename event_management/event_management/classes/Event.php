<?php
require_once 'config.php';

class Event {
    private $conn;
    private $table = 'events';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function create($user_id, $event_name, $description, $event_date, $location) {
        $sql = "INSERT INTO $this->table (user_id, event_name, description, event_date, location)
                VALUES (:user_id, :event_name, :description, :event_date, :location)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':event_name', $event_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':event_date', $event_date);
        $stmt->bindParam(':location', $location);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read($user_id) {
        $sql = "SELECT * FROM $this->table WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $event_name, $description, $event_date, $location) {
        $sql = "UPDATE $this->table SET event_name = :event_name, description = :description,
                event_date = :event_date, location = :location WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':event_name', $event_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':event_date', $event_date);
        $stmt->bindParam(':location', $location);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
