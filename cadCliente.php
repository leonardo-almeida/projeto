                                                                     <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="image/x-icon" href="favicon.png">
<title>Agenda de Contatos</title>
<link rel="stylesheet" type="text/css" href="extjs-4.1.0/resources/css/ext-all-gray.css" />
<script type="text/javascript" src="extjs-4.1.0/ext-all.js"></script>
<script type="text/javascript" src="layout.js"></script>
<script type="text/javascript" src="jquery.js"></script>
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
	txtMatricula:{ required: true, minlength: 4, maxlength: 15 },
	txtLogin:{ required: true, minlength: 4, maxlength: 15 },
	txtSenha:{ required: true, minlength: 4, maxlength: 10 },
	txtCSenha:{ required: true, equalTo: "#txtSenha", minlength: 4, maxlength: 10 }
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
	txtMatricula:{ required: "Campo obrigat&oacute;rio", minlength: "M&iacute;nimo de 4 d&iacute;gitos", maxlength: "M&aacute;ximo de 15 d&iacute;gitos" },
	txtLogin:{ required: "Campo obrigat&oacute;rio", minlength: "M&iacute;nimo de 4 d&iacute;gitos", maxlength: "M&aacute;ximo de 15 d&iacute;gitos" },
	txtSenha:{ required: "Campo obrigat&oacute;rio", minlength: "M&iacute;nimo de 4 d&iacute;gitos", maxlength: "M&aacute;ximo de 10 d&iacute;gitos"  },
	txtCSenha:{ required: "Campo obrigat&oacute;rio", equalTo: "Confirma&ccedil;&atilde;o incorreta", minlength: "M&iacute;nimo de 4 d&iacute;gitos", maxlength: "M&aacute;ximo de 10 d&iacute;gitos"  }
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
<b>Cadastrar cliente</b>
</div>
<?php
if(isset($_POST['txtNome'])){

include 'conecta.php';

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
$login = $_POST['txtLogin'];
$senha = $_POST['txtSenha'];

$confereCadastros=0;

$insertUsuario = "INSERT INTO usuario(login, senha) values('".$login."', '".$senha."');";

if(mysql_query($insertUsuario, $conexao))
{
    $codUsuario= mysql_insert_id();
    $confereCadastros=1;
}
else {$confereCadastros=0;}

$insertEndereco = "INSERT INTO endereco(logradouro, numero, complemento, bairro, cidade, estado, cep) values('".$logradouro."', '".$numero."', '".$complemento."', '".$bairro."', '".$cidade."', '".$uf."', '".$cep."');";

if(mysql_query($insertEndereco, $conexao))
{
    $codEndereco= mysql_insert_id();
    $confereCadastros=1;
}
else {$confereCadastros=0;}

$insertCliente = "INSERT INTO cliente(nome, dtNascimento, email, telefone, celular, matricula, codEndereco, codUsuario) values('".$nome."','".$nasc."','".$email."','".$telefone."','".$celular."','".$matricula."',".$codEndereco.",".$codUsuario.")";

if(mysql_query($insertCliente, $conexao))
{
    $confereCadastros=1;
}
else {$confereCadastros=0;}

if($confereCadastros==1)
{
  ?>
  <div id="result">
  O cadastro foi realizado com sucesso.
  <?php
  ?>
  </div>
  </div>
  <?php
 }
 else
{
?>
<div id="result">
O cadastro do registro falhou.
</div>
</div>
<?php
}

}
else
{
?>
<div id="form">
<br><center>
<form action="#" method="post" id="cadCliente" name="cadCliente">
<table border="0">
    <tr>
		<td align="right"><br>Nome:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtNome" name="txtNome" size="35"/><br><br></td>
	</tr>
	<tr>
		<td align="right"><br>Data de nascimento:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtNasc" name="txtNasc" size="35"/><br><br></td>
	</tr>
	<tr>
		<td align="right"><br>CEP:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtCEP" name="txtCEP" size="35"/><br><br></td>
	</tr>
	<tr>
		<td align="right"><br>Logradouro:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtLogradouro" name="txtLogradouro" size="35" readonly="readonly"/><br><br></td>
	</tr>
	<tr>
		<td align="right"><br>N&uacute;m. / Complemento:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtNum" name="txtNum" size="15"/>&nbsp;<input type="text" id="txtComp" name="txtComp" size="15"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>Bairro:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtBairro" name="txtBairro" size="35" readonly="readonly"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>Cidade / UF:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtCidade" name="txtCidade" size="23" readonly="readonly"/>&nbsp;<input type="text" id="txtUF" name="txtUF" size="8" readonly="readonly"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>E-mail:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtEmail" name="txtEmail" size="35"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>T. Fixo:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtTelefone" name="txtTelefone" size="35"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>T. Celular:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtCelular" name="txtCelular" size="35"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>Matr&iacute;cula:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtMatricula" name="txtMatricula" size="35"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>Login:&nbsp;<br><br></td>
 		<td><br><input type="text" id="txtLogin" name="txtLogin" size="35"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>Senha:&nbsp;<br><br></td>
 		<td><br><input type="password" id="txtSenha" name="txtSenha" size="35"/><br><br></td>
	</tr>
    <tr>
		<td align="right"><br>Confirmar senha:&nbsp;<br><br></td>
 		<td><br><input type="password" id="txtCSenha" name="txtCSenha" size="35"/><br><br></td>
	</tr>

	<tr>
    	<td colspan="2" align="center">
        	<br>
            <input type="submit" value="       Cadastrar       "><br><br>
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
