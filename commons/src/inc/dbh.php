<?php
define("DB_HOST", "localhost");
define("DB_NAME", "muzon");
define("DB_CHARSET", "UTF8");
define("DB_USER", "theresa_de_ocampo");
define("DB_PASSWORD", "mtdo_bsit");

try {
	$dsn = "mysql:host=".DB_HOST.";charset=".DB_CHARSET.";dbname=".DB_NAME;
	$pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_NATURAL);
}
catch (Exception $e) {
	require "../commons/src/inc/terminate-template.php";
}
