<?php

$host = 'mysql:host=localhost;charset=utf8mb4;port:3306';
$db_user = 'root';
$db_pass = '';
$database = 'nobasic';
$archivo = 'usuarios.json';
$tabla = 'usuarios';
$opt = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
$agregar = 0;	

$tiposDatosExcepciones = [
	"integer"	=>	"int(15)"
];
$tiposNombreExcepciones = [
	"descripcion" => "text",
	"password"	=>	"char(60)"
];
$tiposDefault = "varchar(100)";


$array = explode(PHP_EOL, file_get_contents($archivo));
foreach ($array as $key => $value) {
	$arrayTerminado[] = json_decode($value, true);
}

// CONEXION

try {
	$db = new PDO($host, $db_user, $db_pass,$opt);
}
catch( PDOException $Exception ) {
	echo $Exception->getMessage();
}

// BASE DE DATOS

$query = $db->query("SHOW DATABASES LIKE '$database'");
$array = $query->fetchAll(PDO::FETCH_ASSOC);

if (empty($array)) {
	$db->query("CREATE DATABASE IF NOT EXISTS $database;
		GRANT ALL ON $database.* TO $db_user@localhost;
		FLUSH PRIVILEGES;")
		or die(print_r($db->errorInfo(), true));
		echo "Base de datos \"$database\" creada.\n"."<br>";
}else {
	echo "Base de datos \"$tabla\" ya existe."."<br>";
}

// COLUMNAS Y ATRIBUTOS

$detected = 0;	
if (!empty($arrayTerminado)) {
	foreach ($arrayTerminado as $index0 => $dato) {
		$actual0 = $arrayTerminado[$index0];
				
		foreach ($actual0 as $index1 => $dato1) {	
		$actual1 = $actual0[$index1];				
		}
		foreach ($actual1 as $index2 => $dato2) {	
		$actual = $actual1[$index2];	
		$tipos = [];
		$columnas = [];		
		echo '<br>'.'arrayTerminado listo para trabajar';
		echo '<br>';
		var_dump($actual);	
		}
		foreach ($actual as $key => $value) {	
			if ($key !== "id") {
				$tipos[$key] = gettype($value);
			}
		}
		
		foreach ($tipos as $key => $value) {	
			foreach ($tiposDatosExcepciones as $tipoNombre => $tipoValor) {
				if ($value == $tipoNombre) {
					$value = $tipoValor;
					$detected = 1;
					break;
				}
			}
			foreach ($tiposNombreExcepciones as $tipoNombre => $tipoValor) { 
				if ($key == $tipoNombre) {
					$value = $tipoValor;
					$detected = 1;
					break;
				}
			}
			if ($detected === 0) {	
				$value = $tiposDefault;
			}
			$detected = 0;	
			$columnas[] = $key . " ". $value . " NOT NULL";
		}
	}
	$columnas = implode(", ", $columnas);
} else {
	echo "Archivo vacio.";exit;
}

// CREACION DE LA TABLA EN LA BASE DE DATOS

$db->query("use $database");
$query = $db->query("SHOW TABLES");
$array = $query->fetchAll(PDO::FETCH_ASSOC);
$encontrado = 0;
foreach ($array as $key => $value) {
	foreach ($array[$key] as $index => $valor) {
		if ($valor === $tabla) {
			$encontrado = 1;
			break;
		}
	}
}
if ($encontrado === 0) {
	$db->query('CREATE TABLE IF NOT EXISTS '.$tabla.' (
		id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, '.$columnas . ')')
		or die(print_r($db->errorInfo(), true));
		echo "Tabla \"$tabla\" creada.\n";
} else {
	echo "Tabla \"$tabla\" ya existe";
}

// BORRAR LA TABLA 

if ($agregar === 0) {
	$db->query('DELETE FROM '.$tabla.';')
	or die(print_r($db->errorInfo(), true));
	$db->query('ALTER TABLE '.$tabla.' AUTO_INCREMENT = 1;');
	echo "Borrando la tabla...\n";
} else {
	echo "Tabla no vaciada";
}

// TRANSACTION CON QUERY

$db->beginTransaction();

foreach ($arrayTerminado as $index0 => $dato) {
	$actual0 = $arrayTerminado[$index0];
		
	foreach ($actual0 as $index1 => $dato1) {	
	$actual1 = $actual0[$index1];	
			
	}
	foreach ($actual1 as $index2 => $dato2) {	
	$actual = $actual1[$index2];	
	$index = [];
	$valor = [];
	
	echo '<br>'.'Array preparado para sacar datos';
	echo '<br>';
	var_dump($actual);	
	echo '<br>';
	
	foreach ($actual as $key => $value) {	
		if ($key !== "id") {
			$index[] = $key;
			$valor[] = '"'.$value.'"';	
		}	
	}

	$index = implode(", ", $index);
	$valor = implode(", ", $valor);

	$db->exec('INSERT INTO '.$tabla.' ('.$index.') VALUE ('.$valor.');')
	or die(print_r($db->errorInfo(), true));
	echo "Subiendo datos en \"$tabla\" a : $valor\n";
}
}

$db->commit();
echo '<br>'.'<br>'.'<br>';
echo "APLAUSOS!!!";
echo '<br>';
?>



