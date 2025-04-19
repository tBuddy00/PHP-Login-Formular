<?php
    session_start();
  
    if(isset($_SESSION["user"])){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel ="stylesheet" href="style.css">   
    <title>User Dashboard</title>
</head>
<body>
    <div class="class">
        <h1>Welcome to Dashboard</h1><br>
        <h2> ♥️ Thank You for testing! ♥️</h2><br>
        <h3> © Taylan Özer (2025)</h3><br>s
    </div>
</body>
</html>