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
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <?php
    if (isset($_POST["login"])) {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        require_once("database.php");

        $query = "SELECT * FROM users WHERE Email = ?";
        $stmt = mysqli_stmt_init($database_conn);

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);

            if ($user) {
                $storedHash = $user["Password"];
                if (password_verify($password, $storedHash)) {
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>❌ Password does not match!</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>❌ E-Mail does not exist!</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>❌ Failed to prepare login statement!</div>";
        }
    }
    ?>

    <form action="login.php" method="post">
        <div class="form-group">
            <input type="email" name="email" placeholder="Enter Email" class="form-control" required><br>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Enter Password" class="form-control" required><br>
        </div>
        <div class="form-group">
            <input type="submit" name="login" value="Login" class="btn btn-primary"><br>
        </div>
    </form>
</div>
</body>
</html>
