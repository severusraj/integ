<?php
session_start();
// Check if the user is already logged in, redirect to the dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: ../main/dashboard.php");
    exit();
}


// Include the user management database connection file
include("../db/db_user_management.php");

// Initialize variables for login form
$username = $password = "";
$errorMessage = "";

// Process login form submission
// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve and sanitize user input
  $username = isset($_POST["username"]) ? trim($_POST["username"]) : "";
  $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";

  if (!empty($username) && !empty($password)) {
      // Use a prepared statement to avoid SQL injection
      $stmt = $userConn->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
      $stmt->bind_param("ss", $username, $password);
      $stmt->execute();
      $stmt->store_result();

      if ($stmt->num_rows == 1) {
          // Login successful, set session variables
          $stmt->bind_result($user_id);
          $stmt->fetch();
          $_SESSION['user_id'] = $user_id;

          // Redirect to the main dashboard or another secure page
          header("Location: ../main/dashboard.php");
          exit();
      } else {
          // Login failed
          $errorMessage = "Invalid username or password";
      }

      $stmt->close();
  } else {
      // Username or password is empty
      $errorMessage = "Please enter both username and password";
  }
}


// Close the user management database connection
$userConn->close();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="login-box">

            <?php
            // Display login error message
            if (!empty($errorMessage)) {
                echo "<p class='error-message'>$errorMessage</p>";
            }
            ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="login-box">

            <?php
            // Display login error message
            if (!empty($errorMessage)) {
                echo "<p class='error-message'>$errorMessage</p>";
            }
            ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config.js
        module.exports = {
            // ...
            plugins: [
                // ...
                require('@tailwindcss/forms'),
            ],
        }
    </script>
    <title>Regular User Registration</title>
</head>

<body class="h-full">
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="login.php" method="POST">
      <div>
        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
        <div class="mt-2">
          <input name="username" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
          <div class="text-sm">
            <a href="login.php" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
          </div>
        </div>
        <div class="mt-2">
          <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
      </div>
      <a href="../entry/index.html" class="font-semibold leading-6 text-indigo-600 hover:text-red-500">Back to entry page</a>
    </p>
    </form>
  </div>
</div>


