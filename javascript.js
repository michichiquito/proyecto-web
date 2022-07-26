alert("INTEGRANTES: CRUZ BUSTAMANTE ANGIE CONSUELO GOMEZ MARIÑO GWINETH WHITE Y MONTALBAN GARCIA DEYVI PAUL");


/*
resgistro
*/

var nombrecompleto, númerodeteléfono, dirección, correo;

function Registrarse() {
  nombrecompleto = window.prompt("Ingrese su nombre completo:");
  númerodeteléfono = window.prompt("Ingrese su número de teléfono:");
  if (isNaN(númerodeteléfono)) {
    window.alert("Debe de ingresar números.");
    númerodeteléfono = undefined;
    númerodeteléfono = window.prompt(
      "Ingrese su número de teléfono, porfavor."
    );
  } else {
    window.alert("Prosiga con la compra.");
  }

  dirección = window.prompt("Ingrese su dirección:");
  correo = window.prompt("Ingrese su correo electrónico");

  window.alert(
    "Tu registro ha sido completado, " +
      nombrecompleto +
      ". Ya esta todo listo para que procedas a comprarle lo mejor a tu mascota"
  );
}
document.getElementById("inicio").addEventListener("click", Registrarse);

var productos = [
  ["GranPlus Perro Adulto Sabor Carne & Arroz", 43],
  ["GranPlus Perro Cachorro Sabor Carne & Arroz", 43],
  ["GranPlus Perro Adulto Sabor Pollo & Arroz", 50],
  ["GranPlus Perro Mini Cachorro Sabor Pollo & Arroz", 43],
  ["GranPlus Gourmet Adulto Mini Sabor Cordero & Arroz", 47],
  ["GranPlus  Perro Adulto Light Sabor Pollo/Arroz", 166],
  ["\n Comida para Gato:\n"],
  ["GranPlus Gato Adulto", 51],
  ["GranPlus Gato Adulto Castrado", 54],
  ["GranPlus Sabor Pollo/Arroz", 54],
  ["ProGato Super Premium", 42],
  ["ProGato Arena BioBom", 31],
  ["ProGato Clásica Granos", 20],
  ["\n Cuidados:\n"],
  ["Equilibrium® Piel y Pelo", 63],
  ["Equilibrium® Artroflex", 82],
  ["Collar Antipulgas Perros/Gatos", 192],
  ["\n Accesorios:\n"],
  ["Arenero Cerrado Grande FreshKitty", 79],
  ["Kit de Limpieza de Caja de Arena ", 35]
];

var productosparacarrito = [];
var emptycarrito = true;
var btnagregar = document.querySelector("#btnagregar");
var btnmostrar = document.querySelector("#btnmostrar");

btnagregar.addEventListener("click", Agregar);
btnmostrar.addEventListener("click", Carrito);

function Agregar() {
  var addproductos = window.alert(
    "Te mostraremos nuestra lista de productos para que los puedas acumular en tu carrito de compras."
  );
  var textoproductos = "";
  for (var i = 0; i < productos.length; i++) {
    textoproductos += i + 1 + ": " + productos[i][0] + "\n";
  }
  var productoseleccionado = window.prompt(
    "Escriba el número que le corresponde al producto." + " \n" + textoproductos
  );

  productosparacarrito.push(productos[productoseleccionado - 1]);
  emptycarrito = false;
}

function Carrito() {
  if (emptycarrito == true) {
    window.alert("Debes de añadir productos a tu carrito");
  } else {
    var textoproductos = "Tus productos para llevar son: \n";
    for (var i = 0; i < productosparacarrito.length; i++) {
      textoproductos +=
        productosparacarrito[i][0] +
        ": S/." +
        productosparacarrito[i][1] +
        "\n";
    }

    var suma = 0;
    textoproductos += "\n El total es: S/.";

    for (var j = 0; j < productosparacarrito.length; j++) {
      suma += productosparacarrito[j][1];
    }
    textoproductos += suma;
    window.alert(textoproductos);
  } //fin del else
}

var end, tarjeta;

function FINALIZAR() {
  end = window.confirm("El medio de pago se realizará mediante tarjeta.");

  tarjeta = window.prompt(
    "Esta bien, " + nombrecompleto + ". Ingrese el código de su tarjeta"
  );
  if (isNaN(tarjeta)) {
    window.alert("Debe de ingresar números.");
    tarjeta = undefined;
    tarjeta = window.prompt("Ingrese su código nuevamente, porfavor.");
  } else {
    window.alert("Prosiga con la compra.");
  }

  window.alert(
    "Muy bien " +
      nombrecompleto +
      ", su compra ha concluido.\n" +
      "\nEn poco tiempo le estaremos brindando toda la información al y todo acerca de los nuevos productos que estaremos sacando." +
      "\nMuchas gracias por confiar en nosotros " +
      nombrecompleto +
      "."
  );
}

document.getElementById("btnfinalizar").addEventListener("click", FINALIZAR);
