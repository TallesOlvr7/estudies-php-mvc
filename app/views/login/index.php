<h1>
    Login
</h1>

<form action="/login/sigin" method="post">
    <label for="email">E-mail</label><br>
    <input type="email" id="email" name="email"> <br> <br>

    <label for="password">Senha</label> <br>
    <input type="password" id="password" name="password"> <br> <br>

    <input type="submit" name="loginButton" id="loginButton" value="Login">
</form> <br> <br>

<?php
    if(isset($data['error'])){
        echo($data['error']);
    }
?>

<a href="/home">
    Voltar para a home
</a>