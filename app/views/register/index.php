<h1>
    Registrar Alunos
</h1>

<form action="/register/submit" method="post">
    <label for="nome">Nome completo: </label><br>
    <input type="text" name="nome" id="nome"> <br> <br>

    <label for="email">Email: </label> <br>
    <input type="email" name="email" id="email"> <br> <br>

    <label for="ra">Ra: </label> <br>
    <input type="number" name="ra" id="ra"> <br> <br>

    <label for="cpf">CPF: </label> <br>
    <input type="text" name="cpf" id="cpf"> <br><br>

    <label for="nascimento">Data de nascimento: </label> <br>
    <input type="date" name="nascimento" id="nascimento"> <br><br>

    <input type="submit" name="submit" id="submit" value="cadastrar"> 
</form> <br>

<?php
    if(isset($data['error'])){
        echo($data['error']);
    }
?>

<a href='/home'>
    Voltar
</a> <br>