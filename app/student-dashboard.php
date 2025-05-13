

<?php

include 'includes/database.php'; // Make sure database connection is established

// Fetch user profile data
$user_id = $_SESSION['user_id'];
$user_query = $conn->query("SELECT username, email FROM users WHERE id = $user_id");
$user = $user_query->fetch_assoc();

// Job application stats (you can expand this later)
$app_query = $conn->query("SELECT COUNT(*) AS total FROM applications WHERE user_id = $user_id");
$app_stats = $app_query->fetch_assoc();
$total_applications = $app_stats['total'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .dashboard-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 20px;
        }
        .profile-box, .stats-box {
            padding: 15px;
            background: #f5f5f5;
            border-radius: 8px;
            box-shadow: 0 0 5px #ccc;
        }
        canvas {
            max-width: 600px;
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="dashboard-container">
        <h2>Welcome to the Student Dashboard</h2>
        <p>Here you can find career resources, job listings, and application history.</p>

        <!-- Profile Info -->
        <div class="profile-box">
            <h3>Your Profile</h3>
            <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        </div>

        <!-- Application Stats -->
        <div class="stats-box">
            <h3>Application Statistics</h3>
            <canvas id="appChart"></canvas>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('appChart').getContext('2d');
        const appChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Applications'],
                datasets: [{
                    label: 'Total Applications Submitted',
                    data: [<?= $total_applications ?>],
                    backgroundColor: '#3498db'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>

    <?php include 'includes/footer.php'; ?>
</body>

</html>
