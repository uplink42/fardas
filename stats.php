<title>Estatísticas</title>

<?php
    include ("connect.php");
    $q = mysql_set_charset('utf8');
    
    $fardas = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(quantidade) AS quant FROM users_has_roupas"), MYSQLI_ASSOC) or die (mysqli_error($con));
    $fardas_total = $fardas['quant'];
    
    //echo "Fardas em uso actualmente: " . $fardas_total . "<br>";
    echo "Fardas em uso por departamento: ";
    ?>
    <table border = '1'><tr><th> Departamento </th><th> Fardas em uso </th></tr>
    <?php
    $deps = mysqli_query($con, "SELECT * FROM departamentos");
    
    while($row = mysqli_fetch_array($deps, MYSQLI_ASSOC))
    {
        $iddep = $row['iddepartamentos'];
        $fardas_dep = mysqli_query($con, "SELECT SUM(users_has_roupas.quantidade) AS quant_dep, departamentos.nome "
                . "FROM users_has_roupas "
                . "LEFT JOIN users "
                . "ON users_has_roupas.users_idusers = users.idusers "
                . "RIGHT JOIN departamentos ON users.departamentos_iddepartamentos = departamentos.iddepartamentos "
                . "WHERE users.departamentos_iddepartamentos = '$iddep'") or die(mysqli_error($con));
        $fardas_dep_count = mysqli_fetch_array($fardas_dep);
        $fardas_dep_str = $fardas_dep_count['quant_dep']; if ($fardas_dep_str == "") {$fardas_dep_str = 0;}
        $dep_str = $fardas_dep_count['nome'];
        
        echo "<tr><td>" . $dep_str . "</td><td align = 'center'>" . $fardas_dep_str . "</td></tr>";
    }
    echo "<tr><td>" . "<b>Total</b>" . "</td><td align = 'center'>" . $fardas_total . "</td></tr>";
  ?>
    </table>
    
        <?php
        //estes queries usam parâmetros específicos para a instituição em questão.
        $fardas_rs = mysqli_query($con, "SELECT SUM(users_has_roupas.quantidade) AS quant_hotel, departamentos.nome "
                . "FROM users_has_roupas "
                . "LEFT JOIN users "
                . "ON users_has_roupas.users_idusers = users.idusers "
                . "RIGHT JOIN departamentos ON users.departamentos_iddepartamentos = departamentos.iddepartamentos "
                . "WHERE users.departamentos_iddepartamentos IN (2,4,6,8,10,12,13,14)") or die(mysqli_error($con));
        $fardas_rs_count = mysqli_fetch_array($fardas_rs);  
        $fardas_rs_str = $fardas_rs_count['quant_hotel']; if ($fardas_rs_str == "") { $fardas_rs_str = 0;}
        
         $fardas_sg = mysqli_query($con, "SELECT SUM(users_has_roupas.quantidade) AS quant_hotel, departamentos.nome "
                . "FROM users_has_roupas "
                . "LEFT JOIN users "
                . "ON users_has_roupas.users_idusers = users.idusers "
                . "RIGHT JOIN departamentos ON users.departamentos_iddepartamentos = departamentos.iddepartamentos "
                . "WHERE users.departamentos_iddepartamentos IN (1,3,5,7,9,11,15,16)") or die(mysqli_error($con));
        $fardas_sg_count = mysqli_fetch_array($fardas_sg);
        $fardas_sg_str = $fardas_sg_count['quant_hotel']; if ($fardas_sg_str == "") { $fardas_sg_str = 0;} 
        
        ?>
        
