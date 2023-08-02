<?php
    include_once 'db.php';  

    if(array_key_exists('requisicao', $_REQUEST)){
        switch($_REQUEST['requisicao']) {
            case 'cadastrar':
                cadastrarUsuarios($_REQUEST);
                header('Location: /index.php?cadastrado=true');
                break;
            case 'deletar':
                deletarUsuario($_REQUEST['id']);
                header('Location: /index.php?deletado=true');
                break;
        } 
    }
    
    
    function listarUsuarios() {
        $sql = <<< SQL
            SELECT 
                `id`, `nome`, `cpf`, `email`, `data_criacao`, `status` 
            FROM  usuario;
        SQL;
       
        global $conn;
        $dadosUsuarios = $conn->query($sql);
        $arrayUsuarios = [];

        if ($dadosUsuarios->num_rows > 0) {
            while($row = $dadosUsuarios->fetch_assoc()) {
              $arrayUsuarios[] = $row;
            }
        }
        
        $conn->close();
        return $arrayUsuarios;
    };

    function cadastrarUsuarios($dadosUsuario){
        $todasPermissoes = '';
        foreach($dadosUsuario['permissao'] as $permissao){
            switch ($permissao){
                case 'login':
                    $todasPermissoes .= 'l';
                    break;
                case 'usuario_add':
                    $todasPermissoes .= 'a';
                    break;
                case 'usuario_editar':
                    $todasPermissoes .= 'e';
                    break;
                case 'usuario_deletar':
                    $todasPermissoes .= 'd';
                    break;
            }
        }

        $dataAtual = date('Y-m-d h:m:s');
        $uuid = uniqid();
        $status = $_REQUEST['status'] == 'ativo' ? 1 : 0;

        print_r($dataAtual);

        $sql = <<< SQL
            INSERT INTO usuario (`uuid`, `nome`, `cpf`, `email`, `senha`, `permissao`, `data_criacao`, `data_atualizacao`, `status`)
        VALUES (
            '{$uuid}', '{$dadosUsuario['nome']}', {$dadosUsuario['cpf']}, '{$dadosUsuario['email']}', '{$dadosUsuario['senha']}', 
            '$todasPermissoes','{$dataAtual}', '{$dataAtual}', '{$status}'
        )
        SQL; 

        global $conn;
        $conn->query($sql);
        $conn->close();
    };

    function deletarUsuario($idUsuario) {
        $sql = <<<SQL
            DELETE FROM usuario WHERE id = {$idUsuario};
        SQL;

        global $conn;
        $conn->query($sql);
        $conn->close();
    }
