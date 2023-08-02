<?php
    if(array_key_exists('cadastrado', $_REQUEST)){ 
        echo <<<HTML
            <script>
                alert('Usuário cadastrado com sucesso');
            </script>
        HTML;
    }

    if(array_key_exists('deletado', $_REQUEST)){ 
        echo <<<HTML
            <script>
                alert('Usuário deletado com sucesso');
            </script>
        HTML;
    }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div id="site">
        <header>
            <h1>USUÁRIOS</h1>
            <form class="busca" action="">
                <i><img src="images/lupa.svg"></i>
                <input type="text" name="pesquisa" placeholder="Pesquisar...">
            </form>
            <figure></figure>
            <a class="sair" href="login.php">sair</a>
        </header>

        

        <ul>
            <li class='titulo'>
                <div class='texto nome'>Nome</div>
                <div class='texto cpf'>CPF</div>
                <div class='texto email'>E-MAIL</div>
                <div class='texto data'>DATA</div>
                <div class='texto status'>STATUS</div>
                <div class='editar'></div>
                <div class='deletar'></div>
            </li>
            <?php
                include_once './server/functions.php';
                $usuarios = listarUsuarios();
                foreach($usuarios as $usuario) {
                    echo "
                        <li class='dado'>
                            <div class='texto nome'>{$usuario['nome']}</div>
                            <div class='texto cpf'>{$usuario['cpf']}</div>
                            <div class='texto email'>{$usuario['email']}</div>
                            <div class='texto data'>{$usuario['data_criacao']}</div>
                            <div class='texto status'>{$usuario['status']}</div>
                            <div class='editar'>
                                <a href='form.php?id={$usuario['id']}&cpf={$usuario['cpf']}&nome={$usuario['nome']}&email={$usuario['email']}&dataCriacao={$usuario['data_criacao']}&status={$usuario['status']}&senha={$usuario['senha']}&permissao={$usuario['permissao']}'>
                                    <img src='images/editar.svg'>
                                </a>
                            </div>
                            <div class='deletar'>
                                <a href='/index.php?requisicao=deletar&id={$usuario['id']}'>
                                    <img src='images/deletar.svg'>
                                </a>
                                
                            </div>
                        </li>
                    ";
                }   
            ?>
        </ul>
        <div class="pagina">
            <p class="resultado">4 resultados</p>
            <a href="">Anterior</a>
            <a href="">Próxima</a>
        </div>
        <a href="form.php" class="botao_add">Adicionar novo</a>
    </div>
</body>

</html>
