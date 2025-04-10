function LoginDisplay(){
    const login=`
        <div class="block-background">
            <div class="login-page">
            <div class="back">
                <img src="images/back_button.png" class="login-back" onclick="Back()">
            </div>
                <div class="logo">
                    <img src="images/logo.png" class="logo-pic">
                    <p class="logo-name">Eventora</p>
                </div>
                <form id = "loginForm">
                    <label for="email">Email</label>
                    <br>
                    <input type="email" name="email" class="email">
                    <br>
                    <label for="password">Password</label>
                    <br>
                    <input type="password" name="password" class="password">
                    <br>
                    <input type="submit"  class="login-button" value="Login">
                </form>
                <div id="loginStatus"></div>
                <div class="sign-up">
                    <button class="sign-up-button" onclick="signUpFunction()">Sign Up</button>
                </div>
            </div>
        </div>
    `;
    document.querySelector('.login-into').innerHTML=login;
    document.body.style.overflow = "hidden";

    document.getElementById("loginForm").addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        fetch("login.php", {
            method: "POST",
            body: new FormData(this)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById("loginStatus").style.color = "green";
                document.getElementById("loginStatus").innerText = `Welcome ${data.username}!`;
        
                // Store in localStorage or pass to header via JS
                localStorage.setItem('username', data.username);
                localStorage.setItem('user_id', data.user_id);
                localStorage.setItem('phone', data.phone);
        
                // You can now update the header with this info
                Back();
                document.querySelector(".head-login").innerHTML=`<img src="images/user-logo.png">`;
        
                // Optionally close login form
                setTimeout(() => Back(), 1000);
            } else {
                document.getElementById("loginStatus").style.color = "red";
                document.getElementById("loginStatus").innerText = data.message;
            }
        })
        .catch(err => {
            document.getElementById("loginStatus").innerText = "Login failed. Try again.";
            console.error(err);
        });
        
    });
}
function signUpFunction(){
    const login=`
    <div class="block-background">
    <div class="signup-main">
    <div class="back">
                <img src="images/back_button.png" class="login-back" onclick="Back()">
            </div>
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
            <button class="sign-up-button" onclick="LoginDisplay()">
                Log in
            </button>
        </form>
    </div> 
    </div>
    `;
    document.querySelector('.login-into').innerHTML=login;
    document.body.style.overflow = "hidden";
};
function Back(){
    const login = "";
    document.querySelector('.login-into').innerHTML=login;
    document.body.style.overflow = "auto";
}
