<?php
    include_once 'db.php';  

    if(array_key_exists('requisicao', $_REQUEST)){
        switch($_REQUEST['requisicao']) {
            case 'cadastrar':
                cadastrarUsuarios($_REQUEST);
                header('Location: /index.php?action=cadastrado');
                break;
            case 'deletar':
                deletarUsuario($_REQUEST['id']);
                header('Location: /index.php?action=deletado');
                break;
            case 'editar':
                editarUsuario($_REQUEST);
                header('Location: /index.php?action=editado');
                break;
        } 
    }
    
    
    function listarUsuarios() {
        $sql = <<< SQL
            SELECT 
                *
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
        $todasPermissoes = extrairPermissoes($dadosUsuario['permissao']);
        $dataAtual = date('Y-m-d h:m:s');
        $uuid = uniqid();
        $status = $_REQUEST['status'] == 'ativo' ? 1 : 0;
        $cpfFormatado = preg_replace('/[^0-9]/', '', $dadosUsuario['cpf']);

        $sql = <<< SQL
            INSERT INTO usuario (`uuid`, `nome`, `cpf`, `email`, `senha`, `permissao`, `data_criacao`, `data_atualizacao`, `status`)
        VALUES (
            '{$uuid}', '{$dadosUsuario['nome']}', {$cpfFormatado}, '{$dadosUsuario['email']}', '{$dadosUsuario['senha']}', 
            '$todasPermissoes','{$dataAtual}', '{$dataAtual}', '{$status}'
        )
        SQL; 
        print_r($sql);
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

    function editarUsuario($dadosUsuario) {
        $permissoes = extrairPermissoes($dadosUsuario['permissao']);
        $dataAtual = date('Y-m-d h:m:s');
        $status = $_REQUEST['status'] == 'ativo' ? 1 : 0;

        $sql = <<<SQL
            UPDATE usuario
            SET 
                `nome` = '{$dadosUsuario['nome']}', 
                `cpf` = '{$dadosUsuario['cpf']}', 
                `email` = '{$dadosUsuario['email']}', 
                `senha` = '{$dadosUsuario['senha']}',
                `permissao` = '{$permissoes}',
                `data_atualizacao` = '{$dataAtual}',
                `status` = '{$status}'
            WHERE id = {$dadosUsuario['id']}
        SQL;

        global $conn;
        $conn->query($sql);
        $conn->close();
    }

    function extrairPermissoes($permissoes) {
        $todasPermissoes = '';
        foreach($permissoes as $permissao){
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

        return $todasPermissoes;
    }
