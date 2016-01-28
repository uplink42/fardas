<!DOCTYPE HTML>
<html>

<head>
  <title>Fardamentos</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php">Fardamentos<span class="logo_colour"></span></a></h1>
          <h2>Gestão de utilização de fardas Royal Savoy e Savoy Gardens</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
           <li class="selected"><a href="index.php">Quadro de listagem</a></li>
           <li ><a href="registar.php">Registar movimento</a></li>
          <li><a href="historico.php">Histórico</a></li>
          <li><a href="estatisticas.php">Estatísticas</a></li>
		  <li ><a href="trabalhadores.php">Funcionários</a></li>
          
        </ul>
      </div>
    </div>
    <div id="site_content">
     
      <div id="content">
        <!-- insert the page content here -->
        <h1>Quadro de listagem</h1>
        <p>Aqui pode consultar as fardas em utilização actual. Note que apenas são visíveis os departamentos que actualmente têm fardas em utilização.
        <?php
        include('list.php');
        ?>
        
      </div>
    </div>
    <div id="footer">
      Copyright &copy; | Desenvolvido por Diamantino Ferreira
    </div>
  </div>
</body>
</html>
