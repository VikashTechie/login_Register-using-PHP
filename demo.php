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
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h4>
            <?php
            echo "Hi! ", $_SESSION["user"];
            ?>
        </h4><br>
        <h1>Welcome to Dashboard</h1>
        <a href="logout.php" class="btn btn-warning">LOGOUT</a>
    </div>
</body>
</html>
