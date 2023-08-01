<?php
    include_once './server/db.php';  

    
    
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
            // output data of each row
            while($row = $dadosUsuarios->fetch_assoc()) {
              $arrayUsuarios[] = $row;
            }
        }
        
        $conn->close();
        return $arrayUsuarios;
    };