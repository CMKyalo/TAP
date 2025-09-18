<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['add_task'])) {
    $task = $_POST['task'];
    $stmt = $conn->prepare("INSERT INTO tasks (user_id, task_description) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $task);
    $stmt->execute();
}

if (isset($_GET['complete'])) {
    $task_id = $_GET['complete'];
    $stmt = $conn->prepare("UPDATE tasks SET status='Completed' WHERE id=? AND user_id=?");
    $stmt->bind_param("ii", $task_id, $user_id);
    $stmt->execute();
}

$result = $conn->query("SELECT * FROM tasks WHERE user_id=$user_id ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Welcome, <?php echo $_SESSION['email']; ?> 👋</h2>
<a href="logout.php">Logout</a>

<h3>Add Task</h3>
<form method="POST">
    <input type="text" name="task" placeholder="New Task" required>
    <button type="submit" name="add_task">Add</button>
</form>

<h3>Your Tasks</h3>
<ul>
<?php while($row = $result->fetch_assoc()): ?>
    <li>
        <?php echo $row['task_description'] . " - " . $row['status']; ?>
        <?php if ($row['status'] === 'Pending'): ?>
            <a href="dashboard.php?complete=<?php echo $row['id']; ?>">✅ Complete</a>
        <?php endif; ?>
    </li>
<?php endwhile; ?>
</ul>
</body>
</html>
