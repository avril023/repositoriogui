<?php
$conexion = mysql_connect("localhost", "root","mysql01") or die ("PROBLEMAS AL CONECTAR EL SERVIDOR");
$database = mysql_select_db("callcenter") or die ("ERROR AL TRATAR DE CONECTAR CON LA BASE DE DATOS");
?>

<html>
<head>
<body background = "salones.jpg">
<title></title>
</head>

<br><br><br><br>
<br><br><br><br>


<?php
$var="";//se crean las variables
$var1="";
$var2="";
$var3="selected";
$var4="";
$var5="selected";
$var6="";


	if(isset($_POST["btn1"])){// isset pregunta si existe; btn1: este boton se usa con todas las funciones buscar, nuevo, agregar, etc.
		$btn=$_POST["btn1"];//recupera el valor
		$bus=$_POST["txtbus"];//recupere txtbus
		if($btn=="Buscar"){
			
			$sql="select * from solicitudsalones where idsolicitud ='$bus'";
			$cs=mysql_query($sql,$conexion);//variable para guardar la consulta
			while($resul=mysql_fetch_array($cs)){//recorrer la consulta; usamos mysql_fetch arrary para almacenar la consulta en un conjunto de arreglos
				$var=$resul[0];// posicion de la primera fila
				$var1=$resul[1];
				$var2=$resul[2];
				$var3=$resul[3];
				$var4=$resul[4];
				$var5=$resul[5];
				$var6=$resul[6];
				
			}
			if($var3=="Almuerzo"){
				$var3="selected";
			}
			if($var5 == "Confirmado"){
				$var5 == "selected";
			}
				
			}
		if($btn=="Nuevo"){
			$sql="select count(idsolicitud),Max(idsolicitud) from solicitudsalones";
			$cs=mysql_query($sql,$conexion);
			while($resul=mysql_fetch_array($cs)){
				$count=$resul[0];
				$max=$resul[1];
				}
				if($count==0){
					$var="S0001";
					}
					else{
						$var='S'.substr((substr($max,1)+10001),1);//de la maxima variable recuperame desde el valor 1
						}
				
			}
		if($btn=="Agregar"){
			$idsolicitud=$_POST["textidsolicitud"];
			$fechaevento=$_POST["datefechaevento"];
			$cantidadpersonas=$_POST["textcantidadpersonas"];
			$motivo=$_POST["cbomotivo"];
			$observaciones = $_POST["textobservaciones"];
			$estado=$_POST["cboestado"];
			$idcliente=$_POST["textidcliente"];
			$sql="insert into solicitudsalones values ('$idsolicitud','$fechaevento','$cantidadpersonas','$motivo','$observaciones','$estado','$idcliente')";

			
			$cs=mysql_query($sql,$conexion);
			echo "<script> alert('Se inserto correctamente!!!');</script>";
			}

		if($btn=="Actualizar"){
		$idsolicitud=$_POST["textidsolicitud"];
		$fechaevento=$_POST["datefechaevento"];
		$cantidadpersonas=$_POST["textcantidadpersonas"];
		$motivo=$_POST["cbomotivo"];
		$observaciones = $_POST["textobservaciones"];
		$estado=$_POST["cboestado"];
		$idcliente=$_POST["textidcliente"];
			
		$sql="update solicitudsalones set idcliente='$idcliente',fechaevento='$fechaevento',cantidadpersonas='$cantidadpersonas',motivo='$motivo',observaciones='$observaciones',estado='$estado' where idsolicitud ='$idsolicitud'";
			
			$cs=mysql_query($sql,$conexion);
			echo "<script> alert('Se actualizo correctamente');</script>";
			}
			
		if($btn=="Eliminar"){
			$idsolicitud=$_POST["idsolicitud"];
				
			$sql="delete from solicitudsalones where idsolicitud='$idsolicitud'";
			
			$cs=mysql_query($sql,$conexion);
			echo "<script> alert('Se elimnino correctamente');</script>";
			}
		}

	?>
	<form name="mot" action="" method="post">
	<center>
	<table border="2">
	<tr>
	<td>Buscar</td>
	<td><input type="text" name="txtbus"/></td>
	<td><input type="submit" name="btn1"  value="Buscar"  /></td>
	</tr></table>

	<table border="2">
	<tr>
	<td>Codigo solicitud:</td>
	<td><input type="text" name="txtidsolicitud" value="<?php echo $var?>" /></td>
	</tr>
	      
	<tr>
	<td>Fecha Evento:</td>
	<td><input type="date" name="datefechaevento"  value="<?php echo $var1?>"/></td>
	</tr>
	<tr>
	<td>Cantidad de Personas:</td>
	<td><input type="text" name="textcantidadpersonas"  value="<?php echo $var2?>"/></td>
	</tr>
	<tr>
	<td>Motivo:</td>
	<td><select name="cbomotivo">
	<option>Evento Empresarial</option>
	<option>Despedida de la Empresa</option>
	<option>Desayuno Comercial</option>
	<option <?php echo $var3?> >Almuerzo</option>
	</select></td></tr>
	<tr>
	<td>Observaciones: </td>
	<td><input type="text" name="textobservaciones"  value="<?php echo $var4?>"/></td>
	</tr>
	<tr>
	<td>Estado: </td>
	<td><select name="cboestado">
	<option>Confirmado</option>
	<option <?php echo $var5?> >SinConfirmar</option>
	</select></td>
	</tr>
	<tr>
	<td>Idcliente: </td>
	<td><input type="text" name="textidcliente"  value="<?php echo $var6?>"/></td>
	</tr>

	<tr align="center">
	<td colspan="2"><input type="submit" name="btn1" value="Nuevo"/>
	<input type="submit" name="btn1" value="Listar"/>
	</td>
	</tr>
	<tr align="center"><td colspan="2"><input type="submit" name="btn1" value="Actualizar"/><input type="submit" name="btn1"value="Eliminar"/>
	<input type="submit" name="btn1"value="Agregar"/></td></tr>

	</table>

	</center>
	<br/>
	<hr>
	</form>
	<br/>



	<?php
	if(isset($_POST["btn1"])){
		$btn=$_POST["btn1"];

		if($btn=="Listar"){
			//en la parte de abajo se puede ver como se crea la tabla para mostrar
			$sql="SELECT * from solicitudsalones";
			$cs=mysql_query($sql,$conexion);
			echo"<center>
			<table border='3'>
			<tr>
			<td>Codigo de Solicitud</td>
			<td>Fecha del Evento</td>
			<td>Cantidad de Personas</td>
			<td>Motivo</td>
			<td>Observaciones</td>
			<td>Estado</td>
			<td>Identificacion del cliente</td>
			</tr>";

			while($resul=mysql_fetch_array($cs)){
				$var=$resul[0];
				$var1=$resul[1];
				$var2=$resul[2];
				$var3=$resul[3];
				$var4=$resul[4];
				$var5=$resul[5];
				$var6=$resul[6];//en la parte siguiente se asinan los valores a los campos de la trabla a mostrar
				echo "<tr>
	<td>$var</td>
	<td>$var1</td>
	<td>$var2</td>
	<td>$var3</td>
	<td>$var4</td>
	<td>$var5</td>
	<td>$var6</td>
	</tr>";
				}
				
			echo "</table>
	</center>";
		}
		}
	?>