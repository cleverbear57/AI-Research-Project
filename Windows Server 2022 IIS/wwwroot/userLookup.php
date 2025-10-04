<?php
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // WMIC query for a specific user
    $cmd = "wmic useraccount where name='$username' get Name,SID,Status /format:list 2>&1";
    $output = shell_exec($cmd);

    if ($output) {
        echo "<pre>" . htmlspecialchars($output) . "</pre>";
    } else {
        echo "<p>No information found for user: " . htmlspecialchars($username) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Lookup</title>
</head>
<body>
    <h2>Check Windows User Info (FOR DEBUGGING ONLY)</h2>
    <form method="get">
        <label for="username">Enter Username:</label>
        <input type="text" id="username" name="username" required>
        <button type="submit">Lookup</button>
    </form>
</body>
</html>

