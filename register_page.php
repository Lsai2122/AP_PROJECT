<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="files/styles/register.css">
</head>
<body>
    <div class="block-background">
    <div class="signup-main">
        <div class="signup-logo">
            <img src="images/square_mouse.png" class="signup-mouse">
        </div>
        <div class="signup-heading">Eventora</div>
        <form action="reg.php" method="POST" class="signup-form_container">
            <div class="signup-form">
                <label class="signup-input_text">Username</label><br>
                <input type="text" class="signup-input" name="username"><br>
                <label class="signup-input_text">Phone</label><br>
                <input type="text" class="signup-input" name="phone"><br>
                <label class="signup-input_text">Email</label><br>
                <input type="text" class="signup-input" name="email"><br>
                <label class="signup-input_text">Password</label><br>
                <input type="password" class="signup-input" name="password"><br>
                <button class="signup-login">Sign Up</button>
            </div>
            <div class="signup-bottom_txt">
                Log in
            </div>
        </form>
    </div> 
    </div>
</body>
</html>