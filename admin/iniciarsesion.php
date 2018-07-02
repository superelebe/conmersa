
	
<?

error_reporting(0);

session_start();

$sesion_name="CONMERSA";


include("incluir/config.php");
include("incluir/class_mysqli.php");
include("incluir/class_usuario.php");
include("incluir/funciones.php");

$mysql= new Con_mysqli;

$usuario= new Usuario;



// echo "<pre> ";
// var_dump($_SESSION);
// echo "</pre> ";
	
	if($_SESSION[$sesion_name][email] == '' or $_SESSION[$sesion_name][pass_usr] == '')
	{

		$valores_regreso=array(
			'respuesta'=> false,
			'msj'=> "<h1 class='color'>No haz ingresado los datos correctos </h1> <p>Intentalo de nuevo</p>",

			);

	}
	else if($_SESSION[$sesion_name][user_data][tipo]=="admin")
	{

		$valores_regreso=array(
			'respuesta'=> true,
			'msj'=> "<h1 class='color'>INICIANDO SESIÓN</h1><p>Bienvenido</p>",

			);
	}


	$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
	echo $valores_regreso;	

?>

