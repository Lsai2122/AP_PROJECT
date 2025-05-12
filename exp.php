<?php
    $conn = new mysqli("localhost", "root", "", "learning");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM learning WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_POST['username']);
?>
<html>
    <body>
        <h1>Welcome to the REG PAGE</h1>
        <form action="exp.php" method="post">
            <input type="text" name="username" id="username" placeholder="Enter your username">
            <input type="password" name="password" id="password" placeholder="Enter your password">
            <button type="submit">Submit</button>
        </form>
        
    </body>
</html>
