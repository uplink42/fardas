<?php
include ("connect.php");
include("dropdown.php");

$target = "registar.php";
$q = mysql_set_charset('utf8');
$dt = new DateTime();
$tz = new DateTimeZone('Europe/Lisbon');
$dt->setTimezone($tz);
$datetime = $dt->format('Y-m-d H:i:s');
    
    
    if(isset($_GET['mov'])) // transacção inicia
    {
    $mov = $_GET['mov'];
    $quant = $_GET['quant'];
    $quant_abs = $_GET['quant'];
    $id_roupa_f = $_GET['id_roupa'];
    $id_user_f = $_GET['id_user'];
    $notas = $_GET['notas'];
    
    if($mov == '+')
    {
        $mov_string = 'Entrada';
    }
    else
        if($mov == '-')
        {
        $mov_string = 'Saida';
        $quant = -$quant;
        }
    //transacção do log e do balanço
    mysqli_query($con, "START transaction") or die (mysqli_error($con));
    
    $current_balance = mysqli_query($con, "SELECT quantidade FROM users_has_roupas WHERE roupas_idroupa = '$id_roupa_f' AND users_idusers = '$id_user_f' ") or die (mysqli_error($con));
        $current_balance2 = mysqli_fetch_array($current_balance, MYSQLI_ASSOC);
        //echo $current_balance2['quantidade'];
        //echo $quant;
    
    //INSERT INTO monthlystats (id, server, time, uptime, players, rank) 
//VALUES (09126, 6, 0912, 302, 0, 1) 
//ON DUPLICATE KEY UPDATE uptime = if(VALUES(uptime) > uptime, VALUES(uptime), uptime)
        
   //balance
        $balance = mysqli_query($con, "INSERT INTO `fardas`.`users_has_roupas` (`users_idusers`, `roupas_idroupa`, `quantidade`) VALUES ('$id_user_f', '$id_roupa_f', '$quant') ON DUPLICATE KEY UPDATE quantidade = quantidade + '$quant'") or die (mysqli_error($con));
        
    //log
    $create_log = mysqli_query($con, "INSERT INTO `fardas`.`log` (`idlog`, `users_idusers`, `roupas_idroupa`, `movimento`, `quantidade_mov`, `data`, `notas`) VALUES (NULL, '$id_user_f', '$id_roupa_f', '$mov_string', '$quant', '$datetime', '$notas');") or die (mysqli_error($con));
        
        
        
        if ($quant < 0 && $current_balance2['quantidade'] + $quant < 0)
        {
            $bal_check = FALSE;
        }
        else {
            $bal_check = TRUE;
        }
        
    
    if ($balance AND $create_log AND $bal_check)
    {
        mysqli_query($con, "COMMIT");
        echo "Registado com sucesso <br>";
        echo mysqli_insert_id($con);
        $roupa_final = mysqli_query($con, "SELECT nome FROM roupas WHERE idroupa = '$id_roupa_f'");
        $nome_roupa_final = mysqli_fetch_array($roupa_final, MYSQLI_ASSOC);
       // echo "$quant" . " " . "'$nome_roupa_final'";
        //echo "<a href ='script.php'>Retroceder</a>";
        
           //fetch user ID and dep ID from DB and send back POST to return to previous state
        
            $user_dep_query = mysqli_query($con, "SELECT * FROM historico3 ORDER BY idlog DESC LIMIT 1 ") or die(mysqli_error($con));
            $get_user_dep = mysqli_fetch_array($user_dep_query, MYSQLI_ASSOC);
            
            $lastuserID = $get_user_dep['idusers'];
            $lastuserdep = $get_user_dep['departamento'];
            
            echo "<form name='hidden' action='registar.php' method='POST'>";
            echo "<input type ='hidden' name='$lastuserdep' value='$lastuserID'>";
            echo "<input type ='Submit' name='submit' value='Registar mais movimentos para este funcionário'> ";
    }
    else
    {
        mysqli_query($con, "ROLLBACK");
        echo "<br><b>Erro na transacção. Verifique as quantidades, um empregado não pode devolver fardas que não tenha em sua posse</b>";
    }
    
    
    //print_r($_GET);
    }
    else
    {


if(isset($_POST['submit']))
{
    //print_r($_POST);
    
    $newArray = array_values($_POST);
    $userid = $newArray[0]; //returna o valor da primeira entrada do array (depende do formulário)
    $nome_user_dep = mysqli_query($con, "SELECT users.nome, departamentos.nome FROM users, departamentos WHERE users.idusers = '$userid' AND users.departamentos_iddepartamentos = departamentos.iddepartamentos") or die (mysqli_error($con));
    $nome_user_dep2 = mysqli_fetch_array($nome_user_dep, MYSQLI_NUM);
    echo $nome_user = $nome_user_dep2['0'] ; echo "<br>";
    echo $nome_dep = $nome_user_dep2['1'];
    
    //Mostra todas as roupas do departamento
    $roupas = mysqli_query($con, "SELECT * FROM roupas WHERE departamentos_iddepartamentos = (SELECT departamentos_iddepartamentos FROM users WHERE idusers = '$userid')") or die (mysqli_error($con));

    echo "<table border = '1'><tr><th>". "Roupa" . "</td><th>" . "Em uso" . "</th><th>" ."Quant" . "</th><th>" . "Entregar" . "</th><th>" . "Devolver" . "</th><th>" . "Notas" . "</th></tr>" ;  
   // echo "<tr><td style='width:75px;'><b>Requerente</b></td>";
    while ($row = mysqli_fetch_array($roupas, MYSQLI_ASSOC))
    {
        $roupas_nome = $row['nome'];
        $roupas_id = $row['idroupa'];
        $quantidade = mysqli_query($con, "SELECT quantidade FROM users_has_roupas WHERE users_idusers = '$userid' AND roupas_idroupa = '$roupas_id'") or die (mysqli_error($con));
        $quantidade_arr = mysqli_fetch_array($quantidade, MYSQLI_ASSOC);
        $quantidade_str = $quantidade_arr['quantidade'];
           if (empty($quantidade_str)) {$quantidade_str = 0;}
        echo "<tr><td>" . $roupas_nome . "</td><td align = 'center'>" . $quantidade_str . "</td>";
        echo "<form name = 'mov' accept-charset = 'utf-8' action = 'registar.php' method = 'GET'>";
        echo "<td> <input type='text' name = 'quant' required = 'required' pattern='[1-9]*' size='1' maxlength ='1'/></td>";
        echo "<input type = 'hidden' name = 'id_roupa' value = '$roupas_id'>";
        echo "<input type = 'hidden' name = 'id_user' value = '$userid'>";
        echo "<td align = 'center'> <input type ='Submit' name = 'mov' value = '+'></td>";
        echo "<td align = 'center'> <input type ='Submit' name = 'mov' value = '-'> </td>";
        echo "<td> <input type='text' name = 'notas' size='20' maxlength ='20'/></td></tr>";
        echo "</form>";
    }
    echo "</table><br>";
    var_dump($_POST);
}
    
else
{
dropdown($target);
}
    }
?>
