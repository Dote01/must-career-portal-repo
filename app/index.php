<?php
require_once "includes/auth.php"; // Ensures user is logged in
include("includes/header.php");
?>

<style>
    .welcome-banner {
        background: linear-gradient(to right, #004080, #0066cc);
        color: white;
        padding: 40px 30px;
        text-align: center;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .welcome-banner h2 {
        font-size: 2em;
        margin: 0 0 10px;
    }

    .welcome-banner p {
        font-size: 1.1em;
        margin: 0;
    }

    .card-section {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 25px;
        margin-top: 30px;
    }

    .card {
        background: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        padding: 20px;
        width: 280px;
        text-align: center;
        transition: transform 0.2s ease;
    }

    .card:hover {
        transform: scale(1.03);
    }

    .card h3 {
        margin-top: 0;
        color: #003366;
    }

    .card p {
        font-size: 0.95em;
        color: #555;
    }

    .card a {
        display: inline-block;
        margin-top: 10px;
        color: white;
        background: #0066cc;
        padding: 8px 16px;
        border-radius: 5px;
        text-decoration: none;
    }

    .card a:hover {
        background: #004c99;
    }
</style>

<div class="welcome-banner">
    <h2>Welcome to MUST Career Support Portal</h2>
    <p>Your gateway to career guidance, job opportunities, and personal growth.</p>
</div>

<div class="card-section">
    <div class="card">
        <h3>Career Guidance</h3>
        <p>Access tips, resources, and advice tailored to your academic and career journey.</p>
        <a href="career.php">Explore</a>
    </div>
    <div class="card">
        <h3>Job Listings</h3>
        <p>Browse available job opportunities from verified companies and organizations.</p>
        <a href="jobs.php">View Jobs</a>
    </div>
    <div class="card">
        <h3>Post a Job</h3>
        <p>Are you a company? Share your openings and connect with talented students.</p>
        <a href="job-create.php">Post Now</a>
    </div>
</div>

<?php include("includes/footer.php"); ?>
