<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <?php
    if (isset($_POST["register"])) {
        // Get and trim input values (like whitespaces)
        $first_name = trim($_POST["first_name"]);
        $last_name = trim($_POST["last_name"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $repeat_password = trim($_POST["repeat_password"]);

        // encrypt password in database
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        //empty list of array is created for occuring errors
        //needed to safe (and collect) errors and list to the user
        $errors = []; 

        // Validate inputs
        if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($repeat_password)) {
            $errors[] = "All fields are required!";
        }
        //filter_var filters a variable with the specified filter (e. g. correct email)
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email is not valid!";
        }

        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long!";
        }

        if ($password !== $repeat_password) {
            $errors[] = "Passwords do not match!";
        }

        require_once "database.php";
        //check  db connection
        if (!$database_conn) {
            die("<div class='alert alert-danger'>❌ Connection failed!</div>");
        }

        // Check if email already exists (duplicates)
        //safety for SQL injection
        $checkQuery = "SELECT * FROM users WHERE Email = ?";
        $stmt = mysqli_stmt_init($database_conn);
       
        if (mysqli_stmt_prepare($stmt, $checkQuery)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if (mysqli_num_rows($result) > 0) {
                $errors[] = "Email already exists!";
            }
        }

        // Display errors
        if (!empty($errors)) {
            //iterate through array
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            // Insert user into database
            $insertQuery = "INSERT INTO users (FirstName, LastName, Password, Email) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($database_conn);
            if (mysqli_stmt_prepare($stmt, $insertQuery)) {
                mysqli_stmt_bind_param($stmt, "ssss", $first_name, $last_name, $passwordHash, $email);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>✅ You registered successfully! Redirecting to login ...</div>";
                
                //after 1 sec directing to login.php
                header("refresh:1;url = login.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>❌ Prepare failed!</div>";
            }
        }
    }
    ?>

    <form action="registration.php" method="post">
        <div class="form-group">
            <input type="text" name="first_name" placeholder="First name" class="form-control"><br>
        </div>
        <div class="form-group">
            <input type="text" name="last_name" placeholder="Last name" class="form-control"><br>
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="E-Mail" class="form-control"><br>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" class="form-control"><br>
        </div>
        <div class="form-group">
            <input type="password" name="repeat_password" placeholder="Repeat Password" class="form-control"><br>
        </div>
        <div class="form-button">
            <input type="submit" class="btn btn-primary" value="Register" name="register">
        </div>
    </form>
</div>
</body>
</html>
