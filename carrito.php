<?php
//llamamos a la clase php
session_start();
require_once("clase.php");

$usar_db = new DBControl();

if(!empty($_GET["accion"])) 
{
switch($_GET["accion"]) 
{
	//este campos es para agregar el item de venta la ventana del carrito
	//solo aparecera si agregamos un producto
	case "agregar":
		if(!empty($_POST["txtcantidad"])) 
		{
			$codproducto = $usar_db->vaiQuery("SELECT * FROM productos WHERE cod='" . $_GET["cod"] . "'");
			$items_array = array($codproducto[0]["cod"]=>array(
			'vai_nom'		=>$codproducto[0]["nom"], 
			'vai_cod'		=>$codproducto[0]["cod"], 
			'txtcantidad'	=>$_POST["txtcantidad"], 
			'vai_pre'		=>$codproducto[0]["pre"], 
			'vai_img'		=>$codproducto[0]["img"]
			));
			
			if(!empty($_SESSION["items_carrito"])) 
			{
				if(in_array($codproducto[0]["cod"],
				array_keys($_SESSION["items_carrito"]))) 
				{
					foreach($_SESSION["items_carrito"] as $i => $j) 
					{
							if($codproducto[0]["cod"] == $i) 
							{
								if(empty($_SESSION["items_carrito"][$i]["txtcantidad"])) 
								{
									$_SESSION["items_carrito"][$i]["txtcantidad"] = 0;
								}
								$_SESSION["items_carrito"][$i]["txtcantidad"] += $_POST["txtcantidad"];
							}
					}
				} else 
				{
					$_SESSION["items_carrito"] = array_merge($_SESSION["items_carrito"],$items_array);
				}
			} 
			else 
			{
				$_SESSION["items_carrito"] = $items_array;
			}
		}
	break;
	//este campo es para eliminar el producto registrado
	case "eliminar":
		if(!empty($_SESSION["items_carrito"])) 
		{
			foreach($_SESSION["items_carrito"] as $i => $j) 
			{
				if($_GET["eliminarcode"] == $i)
				{
					unset($_SESSION["items_carrito"][$i]);	
				}			
				if(empty($_SESSION["items_carrito"]))
				{
					unset($_SESSION["items_carrito"]);
				}
			}
		}
	break;
	case "vacio":
		unset($_SESSION["items_carrito"]);
	break;	
	//Al darle click en el boton pagar no aparecera una alerta de compra
	case "pagar":

	echo "<script> alert('Gracias por su compra - KhunpaShop');window.location= 'carrito.php' </script>";
		unset($_SESSION["items_carrito"]);
	
	break;	
}
}
?>
<html>
<meta charset="UTF-8">
<head>
<title>"KHUNPA"</title>
<link href="carrito.css" rel="stylesheet" />
<link rel="icon" href="img/pata.png">
</head>
<body>
<!-- creamos un .html para crear el titulo de la ventana -->
<div align="center"><h1>KHUNPA SHOP</h1></div>
<div>
<div><h2>LISTA DE PRODUCTOS A COMPRAR</h2></div>


<?php
//Mostrara y contara la cantidad de productos y precio
if(isset($_SESSION["items_carrito"]))
{
    $totcantidad = 0;
    $totprecio = 0;
?>	
<!-- creamos nuestra tabla con sus nombres de comlumnas y el boton limpiar-->
<table>
<tr>
<th style="width:30%">Descripción</th>
<th style="width:10%">Código</th>
<th style="width:10%">Cantidad</th>
<th style="width:10%">Precio x unidad</th>
<th style="width:10%">Precio</th>
<th style="width:10%"><a href="carrito.php?accion=vacio">Limpiar</a></th>
</tr>	
<?php	

    foreach ($_SESSION["items_carrito"] as $item){
        $item_price = $item["txtcantidad"]*$item["vai_pre"];
		?>
				<tr>
				<td><img src="<?php echo $item["vai_img"]; ?>" class="imagen_peque" /><?php echo $item["vai_nom"]; ?></td>
				<td><?php echo $item["vai_cod"]; ?></td>
				<td><?php echo $item["txtcantidad"]; ?></td>
				<td><?php echo "s/. ".$item["vai_pre"]; ?></td>
				<td><?php echo "s/. ". number_format($item_price,2); ?></td>
				<td><a href="carrito.php?accion=eliminar&eliminarcode=<?php echo $item["vai_cod"]; ?>">Eliminar</a></td>
				</tr>
				<?php
				$totcantidad += $item["txtcantidad"];
				$totprecio += ($item["vai_pre"]*$item["txtcantidad"]);
		}
		?>
<!-- le damos un estilo a la tabla de compras  -->
<tr style="background-color:#f3f3f3">
<td colspan="2"><b>Total de productos:</b></td>
<td><b><?php echo $totcantidad; ?></b></td>
<td colspan="2"><strong><?php echo "s/. ".number_format($totprecio, 2); ?></strong></td>
<td><a href="carrito.php?accion=pagar">Pagar</a></td>
</tr>

</table>		
  <?php
} else {
?>
<!-- Si no agregamos ningun producto al carrito nos aparece este texto centrado -->
<div align="center"><h3>¡Aun no haz hecho tu pedido!</h3></div>

<?php 
}
?>
</div>

<div>
<div><h2>Productos</h2></div>
<!-- Aqui creamos un div llamado conetenedor general el cual entrara a la base de datos y 
ordenara ne este caso la tabla productos en forma ascendente -->
<div class="contenedor_general">
	<?php
	$productos_array = $usar_db->vaiquery("SELECT * FROM productos ORDER BY id ASC");
	if (!empty($productos_array)) 
	{ 
		foreach($productos_array as $i=>$k)
		{
	?>
		<div class="contenedor_productos">
			<form method="POST" action="carrito.php?accion=agregar&cod=
			<?php echo $productos_array[$i]["cod"]; ?>">
			<div><img src="<?php echo $productos_array[$i]["img"]; ?>"></div>
			<div>
			<div style="padding-top:20px;font-size:18px;"><?php echo $productos_array[$i]["nom"]; ?></div>
			<div style="padding-top:10px;font-size:20px;"><?php echo "s/.".$productos_array[$i]["pre"]; ?></div>
			<div><input type="text" name="txtcantidad" value="1" size="2" /><input type="submit" value="Agregar" />
			</div>
			</div>
			</form>
		</div>
	<?php
		}
	}
	?>
</div>
</body>
</html>