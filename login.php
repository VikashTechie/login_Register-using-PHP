<?php
session_start();
if (isset($_SESSION["user"]))
{
    header("Location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
            background: linear-gradient(270deg, #ff6a00, #ee0979);
            animation: backgroundAnimation 10s linear infinite;
        }

        @keyframes backgroundAnimation {
            0% {
                background: linear-gradient(270deg, #ff6a00, #ee0979);
            }
            50% {
                background: linear-gradient(270deg, #00c6ff, #0072ff);
            }
            100% {
                background: linear-gradient(270deg, #ff6a00, #ee0979);
            }
        }
        .form-container {
            position: relative;
            z-index: 1;
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            background-color: rgba(255, 255, 255, 0.9);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        input[type="email"],
        input[type="password"] {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            background-color: #f7f7f7;
            font-size: 1rem;
            color: #333;
            transition: all 0.3s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #a18cd1;
            box-shadow: 0 0 8px rgba(161, 140, 209, 0.5);
            outline: none;
            background-color: #fff;
        }

        input::placeholder {
            color: #aaa;
            font-style: italic;
        }

        .btn-primary {
            background-color: #a18cd1;
            color: #fff;
            border: none;
            font-weight: 600;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #6c5b7b;
            cursor: pointer;
        }
    </style>
</head>
<body>
</div>
    <div class="container">
        <?php
            if (isset($_POST['login']))
            {
                $email=$_POST["email"];
                $password=$_POST["password"];
                require_once("database.php");
                $sql="SELECT * FROM users WHERE email='$email'";
                $result=mysqli_query($conn,$sql);
                $user=mysqli_fetch_array($result,MYSQLI_ASSOC);
                if(empty($email) or empty($password))
                {
                    echo "<div class='alert alert-danger'>All fields are required</div>";
                }
                else
                {
                    if($user)
                    {
                        if(password_verify($password,$user["password"]))
                        {
                            session_start();
                            $_SESSION['user']=$user["full_name"];
                            header("Location:index.php");
                            die();
                        }
                        else
                        {
                        echo "<div class='alert alert-danger'>Incorrect Password</div>";
                        }
                    }
                    else
                    {
                            echo "<div class='alert alert-danger'>Email Doesn't exist!</div>";
                    }
                }
            }
            
        ?>

<h2 style="text-align: center;font-family: 'Poppins', sans-serif;">Login Form</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Enter Email address">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <div><br>
        <p>Don't have Account! Click here for
        <a href="registration.php" style="color:white;font-size: 20px;">Registration</a></p>
    </div>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>