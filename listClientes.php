<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="image/x-icon" href="favicon.png">
<title>Sistema de controle</title>
<link rel="stylesheet" type="text/css" media="screen" href="DataTables-1.9.1/media/css/demo_page.css">
<link rel="stylesheet" type="text/css" media="screen" href="DataTables-1.9.1/media/css/demo_table_jui.css">
<link rel="stylesheet" type="text/css" media="screen" href="DataTables-1.9.1/examples/examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css">
<link rel="stylesheet" type="text/css" href="extjs-4.1.0/resources/css/ext-all-gray.css" />
<script type="text/javascript" src="extjs-4.1.0/ext-all.js"></script>
<script type="text/javascript" src="layout.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" charset="utf-8">


$(document).ready(function() {
$("#carregando").hide();

$("#listPag").submit(function() {
  var busca = $("#txtNome").val();
  window.location="listClientes.php?pag=1&busca="+busca;
  return false;
});

});

     
    function confirmCliente(cod){
    var ask=confirm("Deseja deletar o registro?");
    if(ask){
      window.location="delCliente.php?id="+cod;
     }
     }
</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
	#titulo{position:absolute; color:#68838B; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:24px; text-align:center; width:800px; top:30px; left:50%; margin-left:-400px}
	#form{color:#68838B; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:15px; position:absolute; background-color:#FFFFFF; width:600px; height:160px; left:50%; margin-left:-300px; top:80px;}
    #lista{color:#68838B; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:15px; position:absolute; background-color:#FFFFFF; width:86%; left:7%; height:360px; top:150px;}
    #carregando{position:absolute; color:#68838B; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:24px; text-align:center; width:800px; top:300px; left:50%; margin-left:-400px}
    a:active{color:#68838B;}
    a:link{color:#68838B;}
    a:visited{color:#68838B;}
    .display{color:#68838B; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:15px;}
    .display tr:nth-child(even) {background: #EEE9E9}
    .display tr{border:1px #68838B solid;}
    .display td{border:1px #68838B solid;}
    .display th{background:#68838B; color:#EEE9E9;}
    </style>
</head>

<div id="carregando">
Carregando...
</div>

<body>
<div id="tudo" style="display: none;">
<?php
header('Content-type: text/html; charset=utf-8');


include 'topo.html';
include 'menu.html';

?>
<div id="corpo">

<div id="titulo">
<b>Administrar Clientes</b>
</div>
<div id="form">
<center>
<form action="#" method="post" id="listPag" name="listPag">
<table border="0">
<tr>
    <td align="right"><br>Nome:&nbsp;<br><br></td>
 	<td><br><input type="text" id="txtNome" name="txtNome" size="35" value=""/>
    <input type="submit" value="       Buscar       "><br><br></td>
</tr>
</table>
</form>
</div>

<div id="lista">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="tbl1" width="100%">
<thead>
	<tr>
	<th>Nome</th>
    <th><center>Matr&iacute;cula</center></th>
    <th>Login</th>
    <th><center>Vizualizar</center></th>
    <th><center>Alt. Usu&aacute;rio</center></th>
    <th><center>Alterar</center></th>
    <th><center>&nbsp;Excluir&nbsp;</center></th>
</thead>
<tbody>
<?php
include 'conecta.php';

$limite=10;
$pagina=$_GET['pag'];
if(!isset($pagina) || $pagina == ''){
    $pagina = 1;
}
$inicio=($pagina*$limite)-$limite;


if(isset($_GET['busca'])){

$busca = $_GET['busca'];

$select="SELECT c.codCliente as codCliente, c.nome as nome, c.matricula as matricula, u.login as login FROM cliente c JOIN usuario u ON c.codUsuario=u.codUsuario WHERE c.nome LIKE _utf8 '%".$busca."%' COLLATE utf8_unicode_ci ORDER BY nome";

$result = mysql_query($select) or die(mysql_error());

while($array = mysql_fetch_array($result))
{

	echo '<tr class="gradeB" height="35">';
	echo '<td>'.$array['nome'].'</td>';
	echo '<td>'.$array['matricula'].'</td>';
	echo '<td>'.$array['login'].'</td>';
    echo '<td align="center"><a href="vizCliente.php?id='.$array['codCliente'].'"><img height="18" width="18" src="Icones/lupa.png"></a></td>';
	echo '<td align="center"><a href="altUsuario.php?id='.$array['codCliente'].'"><img height="23" width="23" src="Icones/chave.png"></a></td>';
	echo '<td align="center"><a href="altCliente.php?id='.$array['codCliente'].'"><img height="18" width="18" src="Icones/editar.png"></a></td>';
	echo '<td align="center"><a href="#" onclick="confirmCliente('.$array['codCliente'].')"><img height="18" width="18" src="Icones/x.png"></a></td>';
	echo '</tr>';
}
?>
</tbody>
</table>

<?php
}
else{
$select="SELECT c.codCliente as codCliente, c.nome as nome, c.matricula as matricula, u.login as login FROM cliente c JOIN usuario u ON c.codUsuario=u.codUsuario ORDER BY nome LIMIT ".$inicio.",".$limite;


$result = mysql_query($select) or die(mysql_error());

while($array = mysql_fetch_array($result))
{

	echo '<tr class="gradeB" height="35">';
	echo '<td>'.$array['nome'].'</td>';
	echo '<td>'.$array['matricula'].'</td>';
	echo '<td>'.$array['login'].'</td>';
    echo '<td align="center"><a href="vizCliente.php?id='.$array['codCliente'].'"><img height="18" width="18" src="Icones/lupa.png"></a></td>';
    echo '<td align="center"><a href="altUsuario.php?id='.$array['codCliente'].'"><img height="23" width="23" src="Icones/chave.png"></a></td>';
	echo '<td align="center"><a href="altCliente.php?id='.$array['codCliente'].'"><img height="18" width="18" src="Icones/editar.png"></a></td>';
	echo '<td align="center"><a href="#" onclick="confirmCliente('.$array['codCliente'].')"><img height="18" width="18" src="Icones/x.png"></a></td>';
	echo '</tr>';
	
$selectQuant = "SELECT  COUNT(*) AS total FROM cliente;";
$resultQuant = mysql_query($selectQuant) or die(mysql_error());
$total_registros=mysql_fetch_row($resultQuant);
$total_paginas=ceil($total_registros[0]/$limite);

}
?>
</tbody>
</table>
<br>
<center>
<?php
if($pagina!=1){
$setasEsq = "<< ";
$setaEsq = "< ";
echo "<a href='http://localhost/Agenda%20contatos/listClientes.php?pag=1' style='color: #68838B'>".$setasEsq."</a>";
echo "<a href='http://localhost/Agenda%20contatos/listClientes.php?pag=".($pagina-1)."' style='color: #68838B'>".$setaEsq."</a>";
}
for($i=0; $i<$total_paginas; $i++){
$num = $i+1;
if($num==$pagina){
echo "<b><u>".$num."</u></b>";
}
else{
echo "<a href='http://localhost/Agenda%20contatos/listClientes.php?pag=".$num."' style='color: #68838B'>".$num."</a>";
}
echo ' ';
}
if($pagina!=$total_paginas){
$setasDir = ">> ";
$setaDir = "> ";
echo "<a href='http://localhost/Agenda%20contatos/listClientes.php?pag=".($pagina+1)."' style='color: #68838B'>".$setaDir."</a>";
echo "<a href='http://localhost/Agenda%20contatos/listClientes.php?pag=".$total_paginas."' style='color: #68838B'>".$setasDir."</a>";
}
}
?>
</center>
<br>
<br>
</div>


</div>
</div>
</body>
</html>
