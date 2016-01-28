<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<?php
include("connect.php");
$q = mysql_set_charset('utf8');

    echo "<b>Adicionar funcionário:</b>";
    
        if(isset($_POST['Submeter']))
        {
            $nome = $_POST['nome'];
            $iddep = $_POST['dep'];
            
            $insert_query = mysqli_query($con, "INSERT INTO  `fardas`.`users` (`idusers` , `nome` , `departamentos_iddepartamentos`)
            VALUES (NULL ,'$nome', '$iddep')") or die(mysqli_error($con));
                if($insert_query)
                {
                    echo "Funcionário " . $nome. " inserido com sucesso";
                }
        }
        else
        {

        $query_deps = mysqli_query($con, "SELECT * FROM departamentos");
        //$deps = mysqli_fetch_array($query_deps, MYSQLI_ASSOC);
    ?>
    <br>
    <form name="adicionar" method="POST" action="trabalhadores.php">
        Nome: <input type="text" required = "required" size="50" name="nome">
        Departamento: <select name="dep">
        <?php
        while ($row = mysqli_fetch_array($query_deps))
        {
            $iddep = $row['iddepartamentos'];
            $nome = $row['nome'];
           echo "<option value='$iddep'>$nome</option>"; 
        }
        ?>
        </select>
        <input type ="Submit" name="Submeter" value="Adicionar">
    </form>
<?php
        }
        
        echo "<br>";
        echo "<b>Remover funcionário:</b>";
        
        if(isset($_POST['Submeter2']))
        {
            //are you sure?
            
            $id = $_POST['emp'];
            mysqli_query($con, "START TRANSACTION") or die(mysqli_error($con));
            
                if($id == 0)
                {
                    echo " Seleccione um trabalhador da lista e tente novamente";
                  echo "<meta http-equiv='refresh'
   content='1; url=http://marte/fardas/trabalhadores.php'>";
                  die();
                }
            
            $remove_log = mysqli_query($con, "DELETE FROM log WHERE users_idusers = '$id'") or die(mysqli_error($con));
            $remove_fardas = mysqli_query($con, "DELETE FROM users_has_roupas WHERE users_idusers = '$id'") or die(mysqli_error($con));
            $remove_emp = mysqli_query($con, "DELETE FROM users WHERE idusers = '$id'") or die(mysqli_error($con));
            
            
            if($remove_emp && $remove_fardas &&$remove_log)
            {
                echo "<br>"; echo "Funcionário removido com sucesso";
                mysqli_query($con, "COMMIT") or die(mysqli_error($con));
            }
            else
            {
                echo "erro";
                mysqli_query("ROLLBACK") or die(mysqli_error($con));
            }
        }
        
        else
        {
    
     $query_emp = mysqli_query($con, "SELECT * FROM users ORDER BY nome");
        //$deps = mysqli_fetch_array($query_deps, MYSQLI_ASSOC);
    ?>
    <br>
    <form name="remover" method="POST" action="trabalhadores.php">
        Funcionário a remover: <select name="emp">
            <option value='0'>Seleccione um funcionário</option>
        <?php
        while ($row = mysqli_fetch_array($query_emp))
        {
            $idemp = $row['idusers'];
            $nome = $row['nome'];
           echo "<option value='$idemp'>$nome</option>"; 
        }
        ?>
         </select>
        <br>
        <br>
        <br><input type ="Submit" name="Submeter2" value="Remover">
       <?php
        }
        ?>
        
