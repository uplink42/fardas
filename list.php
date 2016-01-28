<title>Listagem</title>

<?php
    include ("connect.php");
    $q = mysql_set_charset('utf8');

    $lista_deps = mysqli_query($con, "SELECT * FROM departamentos ORDER BY iddepartamentos") 
            or die (mysqli_error($con));
    
    $lista_deps2 = mysqli_query($con, "SELECT * FROM departamentos ORDER BY iddepartamentos") 
            or die (mysqli_error($con));
    echo "<br>";
    
    function toogleTable($id) { //tabela invisivel
        ?>
    <script>
    <?php
    echo "var reasonTable = document.getElementById($id)";
    ?>
    reasonTable.style.display = "block";
    </script>
    <?php
    }
    
    /*while($tnc = mysqli_fetch_array($lista_deps2))
    {
        $departamento_nome = $tnc['nome'];
        echo  $departamento_nome . " | ";
        echo "<script>";
    }*/
   
    $div = 0;
    while($row = mysqli_fetch_array($lista_deps)) //ciclo que gera todas as tabelas
    {
        //$div = $div+1;
        //echo "<div id='$div'>";
       $tablenumber = 1;
       $tablenumber = $tablenumber +1;
       
       
       $departamento_id = $row['iddepartamentos'];
       $departamento_nome = $row['nome'];
       //preenche os headers com as roupas desse dep
       $lista_roupas_dep = mysqli_query($con, "SELECT * FROM roupas WHERE departamentos_iddepartamentos = '$departamento_id' ORDER BY idroupa") 
               or die (mysqli_error($con));
       $lista_users_dep = mysqli_query($con, "SELECT * FROM users WHERE departamentos_iddepartamentos = '$departamento_id' ORDER BY nome")
               or die (mysqli_error($con));
       
       $fardas_dep = mysqli_query($con, "SELECT SUM(users_has_roupas.quantidade) AS quant_dep, departamentos.nome "
                . "FROM users_has_roupas "
                . "LEFT JOIN users "
                . "ON users_has_roupas.users_idusers = users.idusers "
                . "RIGHT JOIN departamentos ON users.departamentos_iddepartamentos = departamentos.iddepartamentos "
                . "WHERE users.departamentos_iddepartamentos = '$departamento_id'");
               $fardas_dep_c = mysqli_fetch_array($fardas_dep, MYSQLI_ASSOC);
               $fardas_dep_str = $fardas_dep_c['quant_dep'];
               
              if($fardas_dep_str >0) {
       echo "<table border = '1' id = '$tablenumber'>";
       echo "<tr><th>" . "<b>" . $departamento_nome . "</b>" ."</th></tr>";
       echo "<tr><th>Pessoal</th>" ;
       
               
               while ($row2 = mysqli_fetch_array($lista_roupas_dep, MYSQLI_ASSOC)) //ciclo que gera as colunas da primeira linha de cada tabela
               {
               $nome_roupa = $row2['nome'];    
               echo "<th>" . $nome_roupa . "</th>";   
               }
               echo "</tr>";
       
               while ($row3 = mysqli_fetch_array($lista_users_dep, MYSQLI_ASSOC)) //ciclo que gera as linhas de users de cada tabela
               {
               $nome_user = $row3['nome'];
               $id_user = $row3['idusers'];
               $lista_roupas_dep2 = mysqli_query($con, "SELECT * FROM roupas WHERE departamentos_iddepartamentos = '$departamento_id' ORDER BY idroupa")
                    or die (mysqli_error($con));
               
               
               
               echo "<tr><td>" . $nome_user . "</td>"; 
                    
                    
                    while($row4 = mysqli_fetch_array($lista_roupas_dep2)) //ciclo que mostra a quantidade de cada user x roupa
                    {
                    $id_roupas = $row4['idroupa'];
                    
                    $quant_user_roupa = mysqli_query($con, "SELECT quantidade FROM users_has_roupas WHERE users_idusers = '$id_user' AND roupas_idroupa = '$id_roupas'")
                    or die (mysqli_error($con));
                    $quant = mysqli_fetch_array($quant_user_roupa, MYSQLI_ASSOC);
                    $quant_str = $quant['quantidade'];
                        if($quant_str == 0) {$quant_str = null;} //remover zeros
                        echo "<td>" . $quant_str . "</td>";
                    }
    
               }
               echo "</table><br><br>";
              }
             //  echo "<div/>";
               else {
                   
               }
    }
 
?>