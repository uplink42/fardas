<?php
function dropdown($target)
{
    include ("connect.php");
?>


Departamento:
<select id="departamento" onchange="showForm()">
    <option value="0">Seleccione opção</option>
    <?php
    $departamentos = mysqli_query($con, "SELECT * FROM departamentos ORDER BY iddepartamentos") or die (mysqli_error($con));
    while ($row = mysqli_fetch_array($departamentos, MYSQLI_ASSOC))
    {
        echo "<option value =" . $row['iddepartamentos'] . ">" . $row['nome'] . "</option>";
    }
    ?>
    </select>
<br><br>

<div id="administracao" style="display:none">
    <?php
    echo"<form name='administracao' accept-charset='utf-8' action = '$target' method = 'POST'>";
    ?>
        Funcionário:
        <select name="administracao" onchange="showForm()">
            <option value="0">Seleccione opção</option>
            <?php 
            $administracao = mysqli_query($con, "SELECT * FROM users WHERE departamentos_iddepartamentos = '1' ORDER BY nome ASC") or die (mysqli_error($con));
             while ($row = mysqli_fetch_array($administracao, MYSQLI_ASSOC))
             {
             echo "<option value =" . $row['idusers'] . ">" . $row['nome'] . "</option>";
             }
            ?>    
        </select>
        <br><br><input type=submit value=Procurar name="submit">
    </form>
</div>

<div id="andares_rs" style="display:none">
    <?php
    echo"<form name='andares_rs' accept-charset='utf-8' action = '$target' method = 'POST'>";
    ?>
        Funcionário:
        <select name="andares_rs" onchange="showForm()">
            <option value="0">Seleccione opção</option>
            <?php 
            $andares_rs = mysqli_query($con, "SELECT * FROM users WHERE departamentos_iddepartamentos = '2' ORDER BY nome ASC") or die (mysqli_error($con));
             while ($row = mysqli_fetch_array($andares_rs, MYSQLI_ASSOC))
             {
             echo "<option value =" . $row['idusers'] . ">" . $row['nome'] . "</option>";
             }
            ?>  
            
        </select>
        <br><br><input type=submit value=Procurar name="submit">
    </form>
</div>

<div id="andares_sg" style="display:none">
    <?php
    echo"<form name='andares_sg' accept-charset='utf-8' action = '$target' method = 'POST'>";
    ?>
        Funcionário:
        <select name="andares_sg" onchange="showForm()">
            <option value="0">Seleccione opção</option>
            <?php 
            $andares_sg = mysqli_query($con, "SELECT * FROM users WHERE departamentos_iddepartamentos = '3' ORDER BY nome ASC") or die (mysqli_error($con));
             while ($row = mysqli_fetch_array($andares_sg, MYSQLI_ASSOC))
             {
             echo "<option value =" . $row['idusers'] . ">" . $row['nome'] . "</option>";
             }
            ?>  
            
        </select>
        <br><br><input type=submit value=Procurar name="submit">
    </form>
</div>

<div id="bares_rs" style="display:none">
    <?php
    echo"<form name='bares_rs' accept-charset='utf-8' action = '$target' method = 'POST'>";
    ?>
        Funcionário:
        <select name="bares_rs" onchange="showForm()">
            <option value="0">Seleccione opção</option>
            <?php 
            $bares_rs = mysqli_query($con, "SELECT * FROM users WHERE departamentos_iddepartamentos = '4' ORDER BY nome ASC") or die (mysqli_error($con));
             while ($row = mysqli_fetch_array($bares_rs, MYSQLI_ASSOC))
             {
             echo "<option value =" . $row['idusers'] . ">" . $row['nome'] . "</option>";
             }
            ?>  
            
        </select>
        <br><br><input type=submit value=Procurar name="submit">
    </form>
</div>

<div id="bares_sg" style="display:none">
   <?php
    echo"<form name='bares_sg' accept-charset='utf-8' action = '$target' method = 'POST'>";
    ?>
        Funcionário:
        <select name="bares_sg" onchange="showForm()">
            <option value="0">Seleccione opção</option>
            <?php 
            $bares_sg = mysqli_query($con, "SELECT * FROM users WHERE departamentos_iddepartamentos = '5' ORDER BY nome ASC") or die (mysqli_error($con));
             while ($row = mysqli_fetch_array($bares_sg, MYSQLI_ASSOC))
             {
             echo "<option value =" . $row['idusers'] . ">" . $row['nome'] . "</option>";
             }
            ?>  
            
        </select>
        <br><br><input type=submit value=Procurar name="submit">
    </form>
</div>

<div id="copalimpeza_rs" style="display:none">
    <?php
    echo"<form name='copalimpeza_rs' accept-charset='utf-8' action = '$target' method = 'POST'>";
    ?>
        Funcionário:
        <select name="copalimpeza_rs" onchange="showForm()">
            <option value="0">Seleccione opção</option>
            <?php 
            $copalimpeza_rs = mysqli_query($con, "SELECT * FROM users WHERE departamentos_iddepartamentos = '6' ORDER BY nome ASC") or die (mysqli_error($con));
             while ($row = mysqli_fetch_array($copalimpeza_rs, MYSQLI_ASSOC))
             {
             echo "<option value =" . $row['idusers'] . ">" . $row['nome'] . "</option>";
             }
            ?>  
            
        </select>
        <br><br><input type=submit value=Procurar name="submit">
    </form>
</div>

<div id="copalimpeza_sg" style="display:none">
    <?php
    echo"<form name='copalimpeza_sg' accept-charset='utf-8' action = '$target' method = 'POST'>";
    ?>
        Funcionário:
        <select name="copalimpeza_sg" onchange="showForm()">
            <option value="0">Seleccione opção</option>
            <?php 
            $copalimpeza_sg = mysqli_query($con, "SELECT * FROM users WHERE departamentos_iddepartamentos = '7' ORDER BY nome ASC") or die (mysqli_error($con));
             while ($row = mysqli_fetch_array($copalimpeza_sg, MYSQLI_ASSOC))
             {
             echo "<option value =" . $row['idusers'] . ">" . $row['nome'] . "</option>";
             }
            ?>  
            
        </select>
        <br><br><input type=submit value=Procurar name="submit">
    </form>
</div>

<div id="cozinha_rs" style="display:none">
    <?php
    echo"<form name='cozinha_rs' accept-charset='utf-8' action = '$target' method = 'POST'>";
    ?>
        Funcionário:
        <select name="cozinha_rs" onchange="showForm()">
            <option value="0">Seleccione opção</option>
            <?php 
            $cozinha_rs = mysqli_query($con, "SELECT * FROM users WHERE departamentos_iddepartamentos = '8' ORDER BY nome ASC") or die (mysqli_error($con));
             while ($row = mysqli_fetch_array($cozinha_rs, MYSQLI_ASSOC))
             {
             echo "<option value =" . $row['idusers'] . ">" . $row['nome'] . "</option>";
             }
            ?>  
            
        </select>
        <br><br><input type=submit value=Procurar name="submit">
    </form>
</div>

<div id="cozinha_sg" style="display:none">
    <?php
    echo"<form name='cozinha_sg' accept-charset='utf-8' action = '$target' method = 'POST'>";
    ?>
        Funcionário:
        <select name="cozinha_sg" onchange="showForm()">
            <option value="0">Seleccione opção</option>
            <?php 
            $cozinha_sg = mysqli_query($con, "SELECT * FROM users WHERE departamentos_iddepartamentos = '9' ORDER BY nome ASC") or die (mysqli_error($con));
             while ($row = mysqli_fetch_array($cozinha_sg, MYSQLI_ASSOC))
             {
             echo "<option value =" . $row['idusers'] . ">" . $row['nome'] . "</option>";
             }
            ?>  
            
        </select>
        <br><br><input type=submit value=Procurar name="submit">
    </form>
</div>

<div id="manutencao_rs" style="display:none">
    <?php
    echo"<form name='manutencao_rs' accept-charset='utf-8' action = '$target' method = 'POST'>";
    ?>
        Funcionário:
        <select name="manutencao_rs" onchange="showForm()">
            <option value="0">Seleccione opção</option>
            <?php 
            $manutencao_rs = mysqli_query($con, "SELECT * FROM users WHERE departamentos_iddepartamentos = '10' ORDER BY nome ASC") or die (mysqli_error($con));
             while ($row = mysqli_fetch_array($manutencao_rs, MYSQLI_ASSOC))
             {
             echo "<option value =" . $row['idusers'] . ">" . $row['nome'] . "</option>";
             }
            ?>  
            
        </select>
        <br><br><input type=submit value=Procurar name="submit">
    </form>
</div>

<div id="manutencao_sg" style="display:none">
    <?php
    echo"<form name='manutencao_sg' accept-charset='utf-8' action = '$target' method = 'POST'>";
    ?>
        Funcionário:
        <select name="manutencao_sg" onchange="showForm()">
            <option value="0">Seleccione opção</option>
            <?php 
            $manutencao_sg = mysqli_query($con, "SELECT * FROM users WHERE departamentos_iddepartamentos = '11' ORDER BY nome ASC") or die (mysqli_error($con));
             while ($row = mysqli_fetch_array($manutencao_sg, MYSQLI_ASSOC))
             {
             echo "<option value =" . $row['idusers'] . ">" . $row['nome'] . "</option>";
             }
            ?>  
            
        </select>
        <br><br><input type=submit value=Procurar name="submit">
    </form>
</div>

<div id="piscina_rs" style="display:none">
    <?php
    echo"<form name='piscina_rs' accept-charset='utf-8' action = '$target' method = 'POST'>";
    ?>
        Funcionário:
        <select name="piscina_rs" onchange="showForm()">
            <option value="0">Seleccione opção</option>
            <?php 
            $piscina_rs = mysqli_query($con, "SELECT * FROM users WHERE departamentos_iddepartamentos = '12' ORDER BY nome ASC") or die (mysqli_error($con));
             while ($row = mysqli_fetch_array($piscina_rs, MYSQLI_ASSOC))
             {
             echo "<option value =" . $row['idusers'] . ">" . $row['nome'] . "</option>";
             }
            ?>  
            
        </select>
        <br><br><input type=submit value=Procurar name="submit">
    </form>
</div>

<div id="recepcaoportaria_rs" style="display:none">
    <?php
    echo"<form name='recepcaoportaria_rs' accept-charset='utf-8' action = '$target' method = 'POST'>";
    ?>
        Funcionário:
        <select name="recepcaoportaria_rs" onchange="showForm()">
            <option value="0">Seleccione opção</option>
            <?php 
            $recepcaoportaria_rs = mysqli_query($con, "SELECT * FROM users WHERE departamentos_iddepartamentos = '13' ORDER BY nome ASC") or die (mysqli_error($con));
             while ($row = mysqli_fetch_array($recepcaoportaria_rs, MYSQLI_ASSOC))
             {
             echo "<option value =" . $row['idusers'] . ">" . $row['nome'] . "</option>";
             }
            ?>  
            
        </select>
        <br><br><input type=submit value=Procurar name="submit">
    </form>
</div>

<div id="restrs_rs" style="display:none">
    <?php
    echo"<form name='restrs_rs' accept-charset='utf-8' action = '$target' method = 'POST'>";
    ?>
        Funcionário:
        <select name="resrs_rs" onchange="showForm()">
            <option value="0">Seleccione opção</option>
            <?php 
            $resrs_rs = mysqli_query($con, "SELECT * FROM users WHERE departamentos_iddepartamentos = '14' ORDER BY nome ASC") or die (mysqli_error($con));
             while ($row = mysqli_fetch_array($resrs_rs, MYSQLI_ASSOC))
             {
             echo "<option value =" . $row['idusers'] . ">" . $row['nome'] . "</option>";
             }
            ?>  
            
        </select>
        <br><br><input type=submit value=Procurar name="submit">
    </form>
</div>

<div id="restaurante_sg" style="display:none">
    <?php
    echo"<form name='restaurante_sg' accept-charset='utf-8' action = '$target' method = 'POST'>";
    ?>
        Funcionário:
        <select name="restaurante_sg" onchange="showForm()">
            <option value="0">Seleccione opção</option>
            <?php 
            $restaurante_sg = mysqli_query($con, "SELECT * FROM users WHERE departamentos_iddepartamentos = '15' ORDER BY nome ASC") or die (mysqli_error($con));
             while ($row = mysqli_fetch_array($restaurante_sg, MYSQLI_ASSOC))
             {
             echo "<option value =" . $row['idusers'] . ">" . $row['nome'] . "</option>";
             }
            ?>  
            
        </select>
        <br><br><input type=submit value=Procurar name="submit">
    </form>
</div>

<div id="recepcaoportaria_sg" style="display:none">
    <?php
    echo"<form name='recepcaoportaria_sg' accept-charset='utf-8' action = '$target' method = 'POST'>";
    ?>
        Funcionário:
        <select name="recepcaoportaria_sg" onchange="showForm()">
            <option value="0">Seleccione opção</option>
            <?php 
            $recepcaoportaria_sg = mysqli_query($con, "SELECT * FROM users WHERE departamentos_iddepartamentos = '16' ORDER BY nome ASC") or die (mysqli_error($con));
             while ($row = mysqli_fetch_array($recepcaoportaria_sg, MYSQLI_ASSOC))
             {
             echo "<option value =" . $row['idusers'] . ">" . $row['nome'] . "</option>";
             }
            ?>  
            
        </select>
        <br><br><input type=submit value=Procurar name="submit">
    </form>
</div>

<script type="text/javascript" src ="subform.js"></script>
<?php
}