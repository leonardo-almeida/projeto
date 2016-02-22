<?php
include 'conecta.php';
$id = $_GET['id'];

$select = "SELECT e.codEndereco as endereco, u.codUsuario as usuario FROM endereco e JOIN cliente c ON e.codEndereco=c.codEndereco JOIN usuario u ON c.codUsuario=u.codUsuario WHERE c.codCliente=".$id.";";
$result = mysql_query($select) or die(mysql_error());
$linha = mysql_fetch_row($result);

$delete = "DELETE FROM endereco WHERE codEndereco=".$linha[0].";";
$delete2 = "DELETE FROM cliente WHERE codCliente=".$id.";";
$delete3 = "DELETE FROM usuario WHERE codUsuario=".$linha[1].";";

if(mysql_query($delete3, $conexao)&&mysql_query($delete, $conexao)&&mysql_query($delete2, $conexao))
{
header("Location: ".$_SERVER['HTTP_REFERER']."");
}
else
{
echo $delete3.$delete.$delete2;
}
?>
