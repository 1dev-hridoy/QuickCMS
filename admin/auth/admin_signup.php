<?php
include_once '../../server/dbcon.php';

$stmt = $pdo->query("SELECT COUNT(*) FROM admin");
$adminExists = $stmt->fetchColumn() > 0;

if ($adminExists) {
    header("Location: ./");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (!empty($name) && !empty($email) && !empty($password)) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO admin (name, email, password_hash) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $passwordHash])) {
            echo "<script>alert('Admin created successfully!'); window.location.href='./';</script>";
            exit;
        } else {
            $error = "Failed to create admin!";
        }
    } else {
        $error = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-6 rounded-lg shadow-lg w-96">
    <h2 class="text-xl font-bold text-center mb-4">Create Admin</h2>
    <?php if (isset($error)) echo "<p class='text-red-500 text-sm text-center'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Admin Name" class="w-full p-2 mb-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <input type="email" name="email" placeholder="Admin Email" class="w-full p-2 mb-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <input type="password" name="password" placeholder="Password" class="w-full p-2 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600">Create Admin</button>
    </form>
</div>

</body>
</html>
