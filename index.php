<?php
require 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = trim($_POST['full_name'] ?? '');
    $studentId = trim($_POST['student_id'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $department = trim($_POST['department'] ?? '');
    $workshop = trim($_POST['workshop'] ?? '');
    $expectation = trim($_POST['expectation'] ?? '');

    if (!empty($fullName) && !empty($studentId) && !empty($email) && !empty($department) && !empty($workshop)) {
        $sql = "INSERT INTO registrations (full_name, student_id, email, department, workshop, expectation) 
                VALUES (:full_name, :student_id, :email, :department, :workshop, :expectation)";
        
        $stmt = $pdo->prepare($sql);
        $success = $stmt->execute([
            ':full_name'   => $fullName,
            ':student_id'  => $studentId,
            ':email'       => $email,
            ':department'  => $department,
            ':workshop'    => $workshop,
            ':expectation' => $expectation
        ]);

        if ($success) {
            $message = "<p style='color:green;'>Registration successful!</p>";
        } else {
            $message = "<p style='color:red;'>Something went wrong!</p>";
        }
    } else {
        $message = "<p style='color:red;'>Please fill in all required fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Workshop Registration</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .form-box { max-width: 500px; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        button { margin-top: 15px; padding: 10px 15px; background: #00796b; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Student Workshop Registration</h2>
    <?php echo $message; ?>
    
    <form action="index.php" method="POST">
        <label>Full Name:</label>
        <input type="text" name="full_name" required>

        <label>Student ID:</label>
        <input type="text" name="student_id" required>

        <label>Email Address:</label>
        <input type="email" name="email" required>

        <label>Department:</label>
        <select name="department" required>
            <option value="">Select Department</option>
            <option value="CSE">CSE</option>
            <option value="EEE">EEE</option>
            <option value="Textile Engineering">Textile Engineering</option>
            <option value="English">English</option>
        </select>

        <label>Workshop:</label>
        <select name="workshop" required>
            <option value="">Select Workshop</option>
            <option value="HTML and CSS Foundations">HTML and CSS Foundations</option>
            <option value="JavaScript Basics">JavaScript Basics</option>
            <option value="PHP and MySQL Basics">PHP and MySQL Basics</option>
        </select>

        <label>What do you expect to learn?:</label>
        <textarea name="expectation" rows="4"></textarea>

        <button type="submit">Register</button>
    </form>
    
    <br>
    <a href="registrations.php">View Saved Registrations &raquo;</a>
</div>

</body>
</html>