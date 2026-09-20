<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM registrations ORDER BY id DESC");
$registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saved Registrations</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #e0f2f1; }
    </style>
</head>
<body>

<h2>Saved Registrations</h2>

<?php if (count($registrations) === 0): ?>
    <p>No registration found.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Student ID</th>
                <th>Email</th>
                <th>Department</th>
                <th>Workshop</th>
                <th>Expectation</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($registrations as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['department']); ?></td>
                    <td><?php echo htmlspecialchars($row['workshop']); ?></td>
                    <td><?php echo htmlspecialchars($row['expectation']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<br>
<a href="index.php">&laquo; Back to Registration Form</a>

</body>
</html>