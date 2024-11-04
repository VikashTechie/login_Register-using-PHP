<?php
session_start();
if (!isset($_SESSION["user"]))
{
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            animation: backgroundAnimation 15s ease infinite;
        }

        @keyframes backgroundAnimation {
            0% {
                background: linear-gradient(45deg, #6a11cb, #2575fc);
            }
            25% {
                background: linear-gradient(45deg, #00c6ff, #0072ff);
            }
            50% {
                background: linear-gradient(45deg, #ff416c, #ff4b2b);
            }
            75% {
                background: linear-gradient(45deg, #ff758c, #ff7eb3);
            }
            100% {
                background: linear-gradient(45deg, #6a11cb, #2575fc);
            }
        }

        .dashboard-container {
            max-width: 800px;
            width: 100%;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            background-color: rgba(255, 255, 255, 0.9);
            z-index: 1;
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .card {
            margin-bottom: 1.8rem;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding-bottom: 10px;
        }

        .card-title {
            font-weight: 500;
        }

        .card-body {
            font-size: 1rem;
            color: #555;
        }

        .btn-primary{
            background-color: #2575fc;
            border: none;
            font-weight: 600;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-warning{
            border: none;
            font-weight: 600;
            width: 96%;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-left: 15px;
            margin-right: 30px;
            color: white;
        }
        .btn-primary:hover {
            background-color: #6a11cb;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h2> <?php 
            echo "Hi! ", $_SESSION["user"];
            ?> </h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Welcome to Dashboard</h5>
            <p class="card-text">Here You can manage your tasks and view statistics.</p>
            <a href="#" class="btn btn-primary">Get Started</a>
        </div>
        <a href="logout.php" class="btn btn-warning">Logout</a>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>