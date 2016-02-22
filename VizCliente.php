<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="image/x-icon" href="favicon.png">
<title>Agenda de Contatos</title>
<link rel="stylesheet" type="text/css" href="extjs-4.1.0/resources/css/ext-all-gray.css" />
<script type="text/javascript" src="extjs-4.1.0/ext-all.js"></script>
<script type="text/javascript" src="layout.js"></script>
<script type="text/javascript" src="DataTables-1.9.1/media/js/jquery.js"></script>
<script type="text/javascript" src="jquery-validation-1.9.0/jquery.validate.js" ></script>
<script type="text/javascript" src="maskedinput-1.1.2.pack.js"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$("#carregando").hide();
});
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
	#titulo{position:absolute; color:#68838B; font-family:Arial; font-size:24px; text-align:center; width:800px; top:30px; left:50%; margin-left:-400px}
	#form{color:#68838B; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:15px; position:absolute; background-color:#FFFFFF; width:600px; height:160px; left:50%; margin-left:-300px; top:80px;}
	#result{position:absolute; color:#68838B; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:20px; text-align:center; width:340px; height:130px; left:50%; margin-left:-170px; top:150px;}
	#carregando{position:absolute; color:#68838B; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:24px; text-align:center; width:800px; top:300px; left:50%; margin-left:-400px}
    label.error { float: none; color: red; padding-left: 0.5em; vertical-align: top; }
</style>
</head>

<div id="carregando">
Carregando...
</div>

<body>
<div id="tudo" style="display: none;">
<?php
include 'topo.html';
include 'menu.html';
?>
<div id="corpo">
<div id="titulo">
<b>Vizualizar cliente</b>
</div>
<?php

include 'conecta.php';
$cliente = $_GET['id'];

$select = "SELECT * FROM endereco e JOIN cliente c ON e.codEndereco=c.codEndereco JOIN usuario u ON c.codUsuario=u.codUsuario WHERE c.codCliente=".$cliente.";";
$result = mysql_query($select, $conexao);
$linha = mysql_fetch_row($result);

$nasc = explode('-',$linha[10]);
$nasc = $nasc[2].'/'.$nasc[1].'/'.$nasc[0];

$cep = substr($linha[7],0,5).'-'.substr($linha[7],5,3);

$telefone = "(".substr($linha[12],0,2).")".substr($linha[12],2,4)."-".substr($linha[12],4,4);
$celular = "(".substr($linha[13],0,2).")".substr($linha[13],2,5)."-".substr($linha[13],5,4);

?>
<div id="form">
<br><center>
<form action="#" method="post" id="cadCliente" name="cadCliente">
<table border="0">
    <tr>
		<td align="right"><br>Nome:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtNome" name="txtNome" size="35" readonly="readonly" value="<?php echo $linha[9];?>"/><br><br></td>
 		<input type="hidden" id="hdnCod" name="hdnCod" value="<?php echo $linha[8];?>">
	</tr>
	<tr>
		<td align="right"><br>Data de nascimento:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtNasc" name="txtNasc" size="35" readonly="readonly" value="<?php echo $nasc;?>"/><br><br></td>
	</tr>
	<tr>
		<td align="right"><br>CEP:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtCEP" name="txtCEP" size="35" readonly="readonly" value="<?php echo $cep;?>"/><br><br></td>
	</tr>
	<tr>
		<td align="right"><br>Logradouro:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtLogradouro" name="txtLogradouro" size="35" readonly="readonly" value="<?php echo $linha[1];?>"/><br><br></td>
	</tr>
	<tr>
		<td align="right"><br>N&uacute;m. / Complemento:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtNum" name="txtNum" size="15" readonly="readonly" value="<?php echo $linha[2];?>"/>&nbsp;<input type="text" id="txtComp" name="txtComp" size="15" readonly="readonly" value="<?php echo $linha[3];?>"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>Bairro:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtBairro" name="txtBairro" size="35" readonly="readonly" value="<?php echo $linha[4];?>"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>Cidade / UF:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtCidade" name="txtCidade" size="23" readonly="readonly" value="<?php echo $linha[5];?>"/>&nbsp;<input type="text" id="txtUF" name="txtUF" size="8" readonly="readonly" value="<?php echo $linha[6];?>"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>E-mail:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtEmail" name="txtEmail" size="35" readonly="readonly" value="<?php echo $linha[11];?>"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>T. Fixo:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtTelefone" name="txtTelefone" size="35" readonly="readonly" value="<?php echo $telefone;?>"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>T. Celular:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtCelular" name="txtCelular" size="35" readonly="readonly" value="<?php echo $celular;?>"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>Matr&iacute;cula:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtMatricula" name="txtMatricula" size="35" readonly="readonly" value="<?php echo $linha[14];?>"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>Login:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtLogin" name="txtLogin" size="35" readonly="readonly" value="<?php echo $linha[18];?>"/><br><br></td>
	</tr>
</table>
<br><br>
</form>
</div>
</div>
</div>
</body>
</html>
