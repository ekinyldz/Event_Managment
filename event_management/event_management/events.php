<?php
require_once 'classes/User.php';
require_once 'classes/Event.php';

$user = new User();
$event = new Event();

if (!$user->isLoggedIn()) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        $event_name = $_POST['event_name'];
        $description = $_POST['description'];
        $event_date = $_POST['event_date'];
        $location = $_POST['location'];
        $user_id = $_SESSION['user_id'];

        if ($event->create($user_id, $event_name, $description, $event_date, $location)) {
            echo 'Event created successfully';
        } else {
            echo 'Failed to create event';
        }
    }

    if (isset($_POST['update'])) {
        // similar handling for updating the event
    }

    if (isset($_POST['delete'])) {
        $id = $_POST['event_id'];
        if ($event->delete($id)) {
            echo 'Event deleted successfully';
        } else {
            echo 'Failed to delete event';
        }
    }
}

$events = $event->read($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="styles.css">

    <meta charset="UTF-8">
    <title>Manage Events</title>
</head>
<body>
    <h1>Manage Events</h1>
    <form action="events.php" method="post">
        <label>Event Name: <input type="text" name="event_name" required></label><br>
        <label>Description: <input type="text" name="description" required></label><br>
        <label>Date and Time: <input type="datetime-local" name="event_date" required></label><br>
        <label>Location: <input type="text" name="location" required></label><br>
        <input type="submit" name="create" value="Create Event">
    </form>
    <h2>Your Events</h2>
    <ul>
        <?php foreach ($events as $event) : ?>
            <li>
                <?= htmlspecialchars($event['event_name']) ?> - 
                <?= htmlspecialchars($event['description']) ?> - 
                <?= htmlspecialchars($event['event_date']) ?> - 
                <?= htmlspecialchars($event['location']) ?>
                <form action="events.php" method="post" style="display:inline;">
                    <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                    <input type="submit" name="delete" value="Delete">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="logout.php">Logout</a>
</body>
</html>
