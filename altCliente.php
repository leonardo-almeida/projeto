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

$(function(){
	$.mask.addPlaceholder("~","[+-]");
	$("#txtNasc").mask("99/99/9999");
	$("#txtCEP").mask("99999-999");
	$("#txtTelefone").mask("(99)9999-9999");
	$("#txtCelular").mask("(99)99999-9999");
});

$('#txtCEP').blur(function(){
    var cep = this.value.replace(/[^0-9]/, "");

    if(cep.length!=8){
         $("#txtLogradouro").val('');
         $("#txtBairro").val('');
         $("#txtCidade").val('');
         $("#txtUF").val('');
         return false;
    }

    var url = "http://cep.republicavirtual.com.br/web_cep.php?cep="+cep+"&formato=json";

    $.getJSON(url, function(dadosRetorno){

        try{
            $("#txtLogradouro").val(dadosRetorno.tipo_logradouro+' '+dadosRetorno.logradouro);
            $("#txtBairro").val(dadosRetorno.bairro);
            $("#txtCidade").val(dadosRetorno.cidade);
            $("#txtUF").val(dadosRetorno.uf);
        }catch(ex){}
    });
});

$('#cadCliente').validate({
rules:{
	txtNome:{ required: true, minlength: 4, maxlength: 100 },
	txtNasc:{ required: true },
	txtCEP:{ required: true },
	txtLogradouro:{ required: true },
	txtNum:{ required: true },
	txtBairro:{ required: true },
	txtCidade:{ required: true },
	txtUF:{ required: true },
	txtEmail:{ required: true, email: true },
	txtTelefone:{ required: true },
	txtCelular:{ required: true },
	txtMatricula:{ required: true, minlength: 4, maxlength: 15 }
	},
messages:{
    txtNome:{ required: "Campo obrigat&oacute;rio", minlength: "M&iacute;nimo de 4 d&iacute;gitos", maxlength: "M&aacute;ximo de 100 d&iacute;gitos" },
	txtNasc:{ required: "Campo obrigat&oacute;rio" },
	txtCEP:{ required: "Campo obrigat&oacute;rio" },
	txtLogradouro:{ required: "Campo obrigat&oacute;rio" },
	txtNum:{ required: "Campo obrigat&oacute;rio" },
	txtBairro:{ required: "Campo obrigat&oacute;rio" },
	txtCidade:{ required: "Campo obrigat&oacute;rio" },
	txtUF:{ required: "Campo obrigat&oacute;rio" },
	txtEmail:{ required: "Campo obrigat&oacute;rio", email: "E-mail inv&aacute;lido" },
	txtTelefone:{ required: "Campo obrigat&oacute;rio" },
	txtCelular:{ required: "Campo obrigat&oacute;rio" },
	txtMatricula:{ required: "Campo obrigat&oacute;rio", minlength: "M&iacute;nimo de 4 d&iacute;gitos", maxlength: "M&aacute;ximo de 15 d&iacute;gitos" }
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
<b>Alterar cliente</b>
</div>
<?php

include 'conecta.php';
$cliente = $_GET['id'];

if(isset($_POST['txtNome'])){

include 'conecta.php';

$select = "SELECT e.codEndereco as endereco, u.codUsuario as usuario FROM endereco e JOIN cliente c ON e.codEndereco=c.codEndereco JOIN usuario u ON c.codUsuario=u.codUsuario WHERE c.codCliente=".$cliente.";";
$result = mysql_query($select) or die(mysql_error());
$linha = mysql_fetch_row($result);

$endereco = $linha[0];

$nome = $_POST['txtNome'];
$nasc = $_POST['txtNasc'];
$nasc = explode('/', $nasc);
$nasc = $nasc[2].'-'.$nasc[1].'-'.$nasc[0];
$cep = $_POST['txtCEP'];
$cep = str_replace('-','',$cep);
$logradouro = $_POST['txtLogradouro'];
$numero = $_POST['txtNum'];
$complemento = $_POST['txtComp'];
$bairro = $_POST['txtBairro'];
$cidade = $_POST['txtCidade'];
$uf = $_POST['txtUF'];
$email = $_POST['txtEmail'];
$telefone = $_POST['txtTelefone'];
$telefone = str_replace('(','',$telefone);
$telefone = str_replace(')','',$telefone);
$telefone = str_replace('-','',$telefone);
$celular = $_POST['txtCelular'];
$celular = str_replace('(','',$celular);
$celular = str_replace(')','',$celular);
$celular = str_replace('-','',$celular);
$matricula = $_POST['txtMatricula'];

$confereAlteracoes=0;


$updateEndereco = "UPDATE endereco SET logradouro='".$logradouro."', numero='".$numero."', complemento='".$complemento."', bairro='".$bairro."', cidade='".$cidade."', estado='".$uf."', cep='".$cep."' WHERE codEndereco=".$endereco.";";

if(mysql_query($updateEndereco, $conexao))
{
    $confereAlteracoes=1;
}
else {$confereAlteracoes=0;}

$updateCliente = "UPDATE cliente SET nome='".$nome."', dtNascimento='".$nasc."', email='".$email."', telefone='".$telefone."', celular='".$celular."', matricula='".$matricula."' WHERE codCliente=".$cliente.";";

if(mysql_query($updateCliente, $conexao))
{
    $confereAlteracoes=1;
}
else {$confereAlteracoes=0;}

if($confereAlteracoes==1)
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
 		<td><br><input type="text" id="txtNome" name="txtNome" size="35" value="<?php echo $linha[9];?>"/><br><br></td>
 		<input type="hidden" id="hdnCod" name="hdnCod" value="<?php echo $linha[8];?>">
	</tr>
	<tr>
		<td align="right"><br>Data de nascimento:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtNasc" name="txtNasc" size="35" value="<?php echo $nasc;?>"/><br><br></td>
	</tr>
	<tr>
		<td align="right"><br>CEP:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtCEP" name="txtCEP" size="35" value="<?php echo $cep;?>"/><br><br></td>
	</tr>
	<tr>
		<td align="right"><br>Logradouro:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtLogradouro" name="txtLogradouro" size="35" readonly="readonly" value="<?php echo $linha[1];?>"/><br><br></td>
	</tr>
	<tr>
		<td align="right"><br>N&uacute;m. / Complemento:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtNum" name="txtNum" size="15" value="<?php echo $linha[2];?>"/>&nbsp;<input type="text" id="txtComp" name="txtComp" size="15" value="<?php echo $linha[3];?>"/><br><br></td>
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
 		<td><br><input type="text" id="txtEmail" name="txtEmail" size="35" value="<?php echo $linha[11];?>"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>T. Fixo:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtTelefone" name="txtTelefone" size="35" value="<?php echo $telefone;?>"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>T. Celular:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtCelular" name="txtCelular" size="35" value="<?php echo $celular;?>"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>Matr&iacute;cula:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtMatricula" name="txtMatricula" size="35" value="<?php echo $linha[14];?>"/><br><br></td>
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
