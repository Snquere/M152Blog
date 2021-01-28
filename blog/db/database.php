<?php

/**
 * @remark Mettre le bon chemin d'accès à votre fichier contenant les constantes
 */
require_once '../condef/conparam.php';

/**
 * Crée et conserve une instance de connection à la base de données
 * @return PDO la connection
 */
function myDatabase() {
	static $dbc = null;
  
	if ($dbc == null) {
	  try {
		$dbc = @new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_DBNAME, 
		DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
				PDO::ATTR_PERSISTENT => true));
	  }
	  catch (Exception $e) { 
		die();
	  }
	}

	return $dbc;
  }