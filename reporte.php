<?php
//aqui llamo a la libreria fpdf y que sea un requerimiento obligatorio
require('fpdf/fpdf.php');
$nombre= $_POST['Nombre'];

//aqui coloco el icono de la tienda y los titulos le doy tamaño la importo desde la carpeta img
//le doy tamaño y ubicacion en el pdf
class PDF extends FPDF{
 function Header(){
$this-> Image('img/khunpalogo.png',10,6,30);
$this-> SetFont('Arial','b',12);
$this-> Cell(30);
$this-> Cell(70,30,'KHUNPA SHOP');
$this-> Cell(60,30,'Av.Tupac Amaru #445  Tel 987654321');
$this->Ln(30);
 }
 //Coloco el pie de pagina le doy un tipo de letra tamaño, y lugar de ubucacion
function Footer(){
$this-> SetY(-10);
$this-> SetFont('Arial','I',10);
$this-> Cell(0,10,'Pagina'.$this->PageNo());

}
}//estos son los tipos de titulos que iran en nuestra tabla por ejm codig, etc
//le coloco color de fondo tamaño y lugar de ubicacion
$pdf=new PDF();
$pdf ->AddPage();
$pdf ->SetFillColor(232,232,120);
$pdf ->Cell(20);
$pdf ->Cell(40,5,'CODIGO',2,0,'C',1);
$pdf ->Cell(80,5,'PRODUCTO',2,0,'C',1);
$pdf ->Cell(40,5,'PRECIO',2,1,'C',1);

$pdf ->SetFont('Times','',14);

//llamo y me conecto a la base de datos en este caso la base de datos se llama tienda
//localhost y el usuario es root sin contraseña
$con=mysqli_connect('localhost', 'root' , '', 'tienda');
$consulta = "";
if($consulta==False){

}
//Al si le doy click al boton mostras me llamar la tabla productos y 
//me mostrara sus campos llamados
if(isset($_POST["mostrar"])) {
    $consulta=mysqli_query($con,"SELECT * FROM productos");
}
//al colocarle un codigo me mostrara solo el producto del codigo escrito
else{
    $consulta=mysqli_query($con,"SELECT * FROM productos WHERE cod LIKE '%$nombre%'");
    while ($resultado=mysqli_fetch_array($consulta))
    {
        $pdf ->Cell(20);
        $pdf ->Cell(40,5,$resultado['cod'],1,0,'C');
        $pdf ->Cell(80,5,$resultado['nom'],1,0,'C');
        $pdf ->Cell(40,5,$resultado['pre'],1,1,'C');
    }
}
//El elemento output nos mostrara los  resultados de cálculos dentro de un formulario
$pdf->Output();


?>