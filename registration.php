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
    <title>Registaration Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <style>
        body {
        background: linear-gradient(120deg, #ff9a9e, #fad0c4, #fad0c4, #fbc2eb, #a18cd1, #fbc2eb, #fad0c4);
        background-size: 150% 150%;
        animation: gradientAnimation 10s ease infinite;
        color: #ffffff;
        }
    @keyframes gradientAnimation {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
        }
      
.btn {
    background-color: #c5a3ff; 
    color: #ffffff;
    border: none;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 20px;
    transition: background-color 0.5s;
    }

    .btn:hover {
        background-color: #ffb6b9; 
    }
    input::placeholder {
        color: #d3d3d3; 
    }

input {
    color: #ffffff;
    background-color: rgba(255, 255, 255, 0.1); /* Light transparent background for inputs */
    border: 1px solid #ffffff;
}
        .form-container {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.85);
            color: #333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 600;
            color: #333;
        }
        input[type="submit"]
        {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
            if(isset($_POST['submit']))
            {
                $fullname=$_POST["fullname"];
                $email=$_POST["email"];
                $password=$_POST["password"];
                $passwordRepeat=$_POST["repeat_password"];
                $errors=array();

                $password_hash=password_hash($password,PASSWORD_DEFAULT);

                if(empty($fullname) or empty($email) or empty($password) or empty($passwordRepeat))
                {
                    array_push($errors,"All Fields are required");
                }
                if(!filter_var($email,FILTER_VALIDATE_EMAIL))
                {
                    array_push($errors,"Email is not valid");
                }
                if(strlen($password)<8)
                {
                    array_push($errors,"Password must be at least 8 characters long");
                }
                if($password!== $passwordRepeat)
                {
                    array_push($errors,"Password doesn't match");
                }
                
                require_once("database.php");
                $sql="SELECT * FROM users WHERE email='$email'";
                $result=mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)> 0)
                {
                    array_push($errors,"Email already Exists");
                }

                if(count($errors)>0)
                {
                    foreach($errors as $error)
                    {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                }
                else
                {
                       $sql="INSERT INTO users (full_name,email,password) values(?,?,?)";
                       $stmt=mysqli_stmt_init($conn);
                       $prepareStmt=mysqli_stmt_prepare($stmt,$sql);
                       if($prepareStmt)
                       {
                        mysqli_stmt_bind_param($stmt,'sss',$fullname,$email,$password_hash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>You are registered Successfully!</div>";
                       }
                       else
                       {
                        die("Something went Wrong");
                       }
                }
                
            }
            
        ?>
        <h2 style="text-align: center;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Registration Form</h2>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Enter Full Name">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Enter Confirm Password">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" name="submit" value="Register">
            </div>
        </form>
        <div>
            <p style="font-size: 20px;">Already an account? Click here <a href="login.php" style="font-weight: bold;">Sign in</a></p>
        </div>
    </div>

    
<script>
    particlesJS("particles-js", {
        particles: {
            number: { value: 80 },
            size: { value: 3 },
            color: { value: "#ffffff" },
            line_linked: { color: "#ffffff" },
            move: { speed: 1 }
        }
    });
</script>

</body>
</html>