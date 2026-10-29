<?php

require_once __DIR__ . '/../../config/config.php';

requireRole('admin');

// Get all activity logs
try {
    $stmt = $pdo->query("
    SELECT *
    FROM activity_logs
    ORDER BY activity_log_created_at DESC
    ");

    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database query error: " . htmlspecialchars($e->getMessage()));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>
</head>

<body>

    <h1>Hello Admin</h1>

    <a href="../auth/signout.php">Sign Out</a>

    <h2>Activity Logs</h2>

    <table border="1" cellpadding="8" cellspacing="0">

        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Action</th>
                <th>Status</th>
                <th>IP Address</th>
                <th>User Agent</th>
                <th>Timestamp</th>
            </tr>
        </thead>

        <tbody>

            <?php if (!empty($activities)): ?>

                <?php foreach ($activities as $activity): ?>

                    <tr>
                        <td>
                            <?= htmlspecialchars((string)($activity['activity_log_id'] ?? '')) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string)($activity['user_id'] ?? '')) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string)($activity['activity_log_action'] ?? '')) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string)($activity['activity_log_status'] ?? '')) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string)($activity['activity_log_ip_address'] ?? '')) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string)($activity['activity_log_user_agent'] ?? '')) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string)($activity['activity_log_created_at'] ?? '')) ?>
                        </td>
                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="7">No activity logs found.</td>
                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</body>
</html>