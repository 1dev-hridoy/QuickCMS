<?php
include_once '../../server/dbcon.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin["password_hash"])) {
        $_SESSION["admin_logged_in"] = true;
        $_SESSION["admin_email"] = $admin["email"];
        header("Location: ../");
        exit;
    } else {
        $error = "Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Secure Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="stylesheet" href="../assets/css/auth.css">
  <script src="../assets/js/auth__theme.js"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-100 to-purple-100 p-4">
  <div class="w-full max-w-6xl grid md:grid-cols-2 gap-8 items-center">
    <div class="hidden md:flex flex-col items-center justify-center relative">
      <div class="relative w-full h-[400px] animate-fade-in-rotate">
        <img src="../assets/images/auth__login.png" alt="Login security illustration" class="object-contain w-full h-full animate-float"/>
      </div>
      <div class="mt-6 text-center">
        <h2 class="text-2xl font-bold text-[#1e2a78]">Admin Portal</h2>
        <p class="text-gray-600 mt-2">Secure administrative access to system controls</p>
      </div>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md mx-auto animate-glow">
      <div class="mb-8 text-center">
        <div class="w-20 h-20 bg-blue-500 rounded-full mx-auto mb-4 flex items-center justify-center animate-pulse">
          <i data-lucide="shield" class="text-white" size="40"></i>
        </div>
        <h1 class="text-3xl font-bold text-gray-800">Admin Login</h1>
        <p class="text-gray-500 mt-2">Access your administrative dashboard</p>
      </div>

      <?php if (isset($error)) echo "<p class='text-red-500 text-center'>$error</p>"; ?>

      <form method="POST" class="space-y-6">
        <div class="space-y-4">
          <div class="relative">
            <input type="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg pl-12 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Admin Email" required/>
            <i data-lucide="mail" class="absolute left-4 top-3.5 text-gray-400" size="20"></i>
          </div>
        </div>

        <div class="space-y-2">
          <div class="relative">
            <input type="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg pl-12 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Admin Password" required/>
            <i data-lucide="lock" class="absolute left-4 top-3.5 text-gray-400" size="20"></i>
          </div>
        </div>

        <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-[#d53f8c] to-[#805ad5] text-white rounded-lg font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center">
          <i data-lucide="lock" class="mr-2" size="18"></i> Access Admin Panel
        </button>

        <div class="text-center mt-6">
          <p class="text-xs text-gray-500">Secure administrative access only. Unauthorized access is prohibited.</p>
        </div>
      </form>
    </div>
  </div>

  <div class="fixed top-0 left-0 w-full h-full pointer-events-none overflow-hidden z-0">
    <div class="absolute top-[15%] left-[10%] w-16 h-16 bg-blue-400 rounded-full opacity-20 animate-float" style="animation-delay: 0s;"></div>
    <div class="absolute top-[40%] left-[80%] w-24 h-24 bg-pink-400 rounded-full opacity-20 animate-float" style="animation-delay: 1s;"></div>
    <div class="absolute top-[70%] left-[20%] w-20 h-20 bg-purple-400 rounded-full opacity-20 animate-float" style="animation-delay: 2s;"></div>
  </div>
<script src="../assets/js/auth.js"></script>
</body>
</html>
