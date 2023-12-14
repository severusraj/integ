<?php
// Include the user management database connection file
include("../db/db_user_management.php");

// Initialize variables to store form data and error messages
$username = $password = $email = "";
$registrationMessage = $errorMessage = "";

// Process regular user registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $username = mysqli_real_escape_string($userConn, $_POST["username"]);
    $password = mysqli_real_escape_string($userConn, $_POST["password"]);
    $email = mysqli_real_escape_string($userConn, $_POST["email"]);

    // Validate password
    if (!isValidPassword($password)) {
        $errorMessage = "Password must be at least 8 characters long, contain at least one capital letter, and at least one number.";
    } else {
        // Use a prepared statement to insert regular user data into the user management database
        $stmt = $userConn->prepare("INSERT INTO users (username, password, email, user_type) VALUES (?, ?, ?, 'regular')");
        $stmt->bind_param("sss", $username, $password, $email);

        if ($stmt->execute()) {
            $registrationMessage = "Regular User Registration successful! Redirecting to the dashboard...";

            // Close the prepared statement
            $stmt->close();

            // Close the user management database connection
            $userConn->close();

            // Redirect to the dashboard after a brief delay (adjust as needed)
            header("refresh:3;url=../main/dashboard.php");
            exit; // Ensure no further code execution after the redirection
        } else {
            $errorMessage = "Error: " . $stmt->error;
        }
    }
}

// Function to validate password
function isValidPassword($password)
{
    // Password must be at least 8 characters long, contain at least one capital letter, and at least one number
    return (strlen($password) >= 8 && preg_match('/[A-Z]/', $password) && preg_match('/[0-9]/', $password));
}

// Close the user management database connection if not already closed
if (isset($userConn)) {
    $userConn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

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
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Register as regular user</h2>
            <?php
            // Display registration success or error message
            if (isset($registrationMessage)) {
                echo "<p class='success-message'>$registrationMessage</p>";
            } elseif (!empty($errorMessage)) {
                echo "<p class='error-message'>$errorMessage</p>";
            }
            ?>
        </div>

        <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="regular_user_registration.php" method="POST">
                <div>
                    <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                    <div class="mt-2">
                        <input name="username" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                               value="<?php echo htmlspecialchars($username); ?>">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2 mb-2">
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                               value="<?php echo htmlspecialchars($email); ?>">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        <div class="text-sm">
                            <a href="regular_user_registration.php"
                               class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                        </div>
                    </div>
                    <div class="mt-2 mb-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                               required>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
