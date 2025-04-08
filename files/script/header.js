document.querySelector('.head-login').addEventListener('click',()=> {
    const login=`
        <div class="block-background">
            <div class="login-page">
                <div class="logo">
                    <img src="images/logo.png" class="logo-pic">
                    <p class="logo-name">Eventora</p>
                </div>
                <form class="">
                    <label for="email">Email</label>
                    <br>
                    <input type="email" name="email" class="email">
                    <br>
                    <label for="password">Password</label>
                    <br>
                    <input type="password" name="password" class="password">
                    <br>
                    <input type="submit" name="submit" class="login-button" value="Login">
                </form>
                <div class="sign-up">
                    <button class="sign-up-button">Sign Up</button>
                </div>
            </div>
        </div>
    `;
    document.querySelector('.login-into').innerHTML=login;
    document.body.style.overflow = "hidden";
});