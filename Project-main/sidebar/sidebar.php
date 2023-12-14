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
</head>

<div class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="../main/event_setup.php">Set Up Event</a>
    <a href="events.php">Events</a>
    <a href="ticket.php">My Tickets</a>
    <a href="history.php">History</a>
    <a href="profile.php">Profile</a>
    <button type="button"  class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600
"onclick="location.href='logout.php'">
  Log out
</button>

</div>


