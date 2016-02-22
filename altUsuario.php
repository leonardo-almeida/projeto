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
<script type="text/javascript">
$(document).ready(function(){
$("#carregando").hide();

$('#cadCliente').validate({
rules:{
	txtLogin:{ required: true, minlength: 4, maxlength: 15 },
	txtSenha:{ required: true, equalTo: "#hdnSenha", minlength: 4, maxlength: 10 },
	txtNSenha:{ maxlength: 10 },
	txtCSenha:{ equalTo: "#txtNSenha", minlength: 4, maxlength: 10 }
	},
messages:{
    txtLogin:{ required: "Campo obrigat&oacute;rio", minlength: "M&iacute;nimo de 4 d&iacute;gitos", maxlength: "M&aacute;ximo de 15 d&iacute;gitos" },
	txtSenha:{ required: "Campo obrigat&oacute;rio", equalTo: "Senha incorreta", minlength: "M&iacute;nimo de 4 d&iacute;gitos", maxlength: "M&aacute;ximo de 10 d&iacute;gitos"  },
	txtNSenha:{ minlength: "M&iacute;nimo de 4 d&iacute;gitos", maxlength: "M&aacute;ximo de 10 d&iacute;gitos"  },
	txtCSenha:{ equalTo: "Confirma&ccedil;&atilde;o incorreta", minlength: "M&iacute;nimo de 4 d&iacute;gitos", maxlength: "M&aacute;ximo de 10 d&iacute;gitos"  }
	}
});
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
<b>Alterar usu&aacute;rio</b>
</div>
<?php

include 'conecta.php';
$cliente = $_GET['id'];

if(isset($_POST['txtLogin'])){

include 'conecta.php';

$select = "SELECT u.codUsuario as usuario FROM cliente c JOIN usuario u ON c.codUsuario=u.codUsuario WHERE c.codCliente=".$cliente.";";
$result = mysql_query($select) or die(mysql_error());
$linha = mysql_fetch_row($result);

$usuario = $linha[0];

$login = $_POST['txtLogin'];

if($_POST['txtNSenha']==''){
    $senha = $_POST['txtSenha'];
}
else{
    $senha = $_POST['txtNSenha'];
}

$confereAlteracoes=0;

$updadeUsuario = "UPDATE usuario SET login='".$login."' , senha='".$senha."' WHERE codUsuario=".$usuario.";";

if(mysql_query($updadeUsuario, $conexao))
{
 ?>
  <div id="result">
  A altera&ccedil;&atilde;o foi realizado com sucesso.
  </div>
  </div>
  <?php
}
else
{
?>
<div id="result">
A altera&ccedil;&atilde;o do registro falhou.
<?php echo $update;?>
</div>
</div>
<?php
}

}
else
{

$select = "SELECT * FROM cliente c JOIN usuario u ON c.codUsuario=u.codUsuario WHERE c.codCliente=".$cliente.";";
$result = mysql_query($select, $conexao);
$linha = mysql_fetch_row($result);

?>
<div id="form">
<br><center>
<form action="#" method="post" id="cadCliente" name="cadCliente">
<table border="0">
    <tr>
		<td align="right"><br>Login:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtLogin" name="txtLogin" size="35" value="<?php echo $linha[10];?>"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>Senha:&nbsp;<br><br></td>
 		<td><br><input type="password" id="txtSenha" name="txtSenha" size="35"/><br><br></td>
 		<input type="hidden" id="hdnSenha" name="hdnSenha" value="<?php echo $linha[11];?>">
	</tr>
	<tr>
		<td align="right"><br>Nova senha:&nbsp;<br><br></td>
 		<td><br><input type="password" id="txtNSenha" name="txtNSenha" size="35"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>C. nova senha:&nbsp;<br><br></td>
 		<td><br><input type="password" id="txtCSenha" name="txtCSenha" size="35"/><br><br></td>
	</tr>

	<tr>
    	<td colspan="2" align="center">
        	<br>
            <input type="submit" value="       Alterar       "><br><br>
        </td>
    </tr>
</table>
</form>
</div>
<?php
}
?>
</div>
</div>
</body>
</html>
