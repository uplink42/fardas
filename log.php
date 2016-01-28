<?php
    include ("connect.php");
    $q = mysql_set_charset('utf8');
    
    if(isset($_GET['todos']))
    {
        echo "sim";
    $list_log = mysqli_query($con, "SELECT * FROM historico3") or die (mysqli_error($con));    
    }
    
    
    if(isset($_POST['submit']))
    {
    $newArray = array_values($_POST);
    $userid = $newArray[0]; //returna o valor da primeira entrada do array (depende do formulário)
    
    $dep = mysqli_query($con, "SELECT * FROM users WHERE idusers = '$userid'") or die (mysqli_error($con));
    $dep2 = mysqli_fetch_array($dep, MYSQLI_ASSOC);
    $depid = $dep2['departamentos_iddepartamentos'];
    $user_nome = $dep2['nome'];
    $list_log = mysqli_query($con, "SELECT * FROM historico3 WHERE idusers = '$userid' AND iddepartamentos = '$depid'") or die (mysqli_error($con));
    
    }
    else
    {
    $list_log = mysqli_query($con, "SELECT * FROM historico3 ORDER BY data DESC") or die (mysqli_error($con));
    }
    
    include ("dropdown.php");
    $target = "historico.php";
    dropdown($target);
    
    ?>
    <form name = 'all' accept-charset = 'utf-8' action = 'historico.php' method = 'GET'>
        <br><input type ='Submit' name='todos' value='Todos os movimentos' >    
    </form>

<?php
    
        if(!empty($_GET['id']))    
        {
            $idlog = $_GET['id'];
            $remove_log = mysqli_query($con, "DELETE FROM `fardas`.`log` WHERE `log`.`idlog` = '$idlog'") or die(mysqli_error($con));
            if($remove_log)
            {
                echo "<br><b>Entrada do histórico removida com sucesso. Note que isto não afecta a contagem das fardas.</b></br>";
                //echo "<a href ='log.php'>Retroceder</a>";
            }
        }
        else {
    ?>
    
    <?php
    
    
    
    if(empty($user_nome)) {$user_nome = "Todos";}
    
    if ($list_log)
        {
            echo "<br>";
            echo "Histórico de movimentos para: " . $user_nome;
        }
    ?>

    <table border = '1'>
        <col width="130">
        <tr><th>Pessoa</th>
        <th>Departamento</th>
        <th>Farda</th>
        <th>Movimento</th>
        <th>Quant</th>
        <th>Data</th>
        <th>Obs</th>
        <th>Remover</th></tr>
        
    
    <?php
    while ($row = mysqli_fetch_array($list_log, MYSQLI_ASSOC))
    {
        $pessoal = $row['pessoal'];
        $departamento = $row['departamento'];
        $farda = $row['farda'];
        $movimento = $row['movimento'];
        $quantidade = $row['quantidade_mov'];
        $data = $row['data'];
        $notas = $row['notas'];
        $idlog = $row['idlog'];
        
        echo 
        "<tr><td>" . $pessoal . 
        "</td><td>" . $departamento. 
        "</td><td align = 'center'>" . $farda . 
        "</td><td align = 'center'>" . $movimento . 
        "</td><td align = 'center'>" . $quantidade . 
        "</td><td align = 'center'>" . $data . 
        "</td><td align = 'center'>" . $notas . 
        "</td><td> <a href ='historico.php?id=$idlog'>Remover</a> </td></tr>";
    }
    ?>
    </table>
<?php
        }
        ?>
    
