 <!DOCTYPE html>
<html>
        <head>
                <meta charset="utf-8" />
   
                <title>Tikets</title>
                <style>
                        table,td,th{
                            border: 1px solid black;
                            border-collapse:collapse;
                        }

                        td,th{
                            padding:10px;

                        }
                        th{
                            text-align: left;
                            background-color:black;
                            color: white;
                        }
                        tr:nth-child(even){
                            background-color:silver;
                        }
                        tr:nth-child(odd){
                            background-color: white;
                        }
                </style>
        </head>
    <body>
    
<h1>Tikets</h1>

<p>Gerenciador de tickets</p>

   <!-- FORMULÁRIO DE CADASTRO -->

    <form action = "index.php" method="post">
            <label>Problema</label>
            <input type = "text" name= "titulo"/>
            <input type = "submit"  name = "botao_adicionar" value = "Adicionar"/>
    </form>

    <?php
        $servidor = "ambiente_db_1";
        $usuario = "root";
        $senha = "phprs";
        $banco = "tickets";

        $conn = new mysqli ($servidor,$usuario,$senha,$banco);

        if($conn->connect_error){
            die("Falha de conexão: " . $conn->connect_error);

        }

            //TRATAR DADOS ENVIADOS PARA A PÁGINA
            if($_POST["titulo"] != ""){
                $sql = "INSERT INTO `tickets`(`titulo`,`status`) VALUES ('".utf8_encode($_POST["titulo"])."',0)";
                if($conn->query($sql)===TRUE){
                    echo"Ticket Adicionado!";
                }else{
                    echo"ocorreu um erro: " .$sql. "<br/>".$conn->error;
                }

            }

            // Recuperar todos os registros da tabela tickets
            $sql = "SELECT * FROM tickets";
            $result = $conn->query($sql);

    ?>
              
            <?php
                if($result->num_rows > 0){
                
            ?>
            <table>

            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Status</th>
            </tr>            

            <?php    

                while($row = $result ->fetch_assoc()){
                    echo"<tr>";
                    echo"<td>" . $row["id"]."</td>";
                    echo"<td>" . utf8_decode($row["titulo"])."</td>";
                    echo"<td>"; 
                    if($row["status"] == 0){
                        echo"Aberto";
                    }else{
                        echo "Fechado";
                    }
                    echo"</td>";
                    echo "</tr>";
                }
            ?>    
                </table>
            <?php    
                }else{
                        echo"Nenhum Registro.";
                }

                $conn->close();
            ?>
    </body>
</html>   



