<?php

/*
 * DB connection script for Editor
 * Automatically generated by http://editor.datatables.net/generator
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');

/*
 * Edit the following with your database connection options
 */
$sql_details = array(
	"user" => "root",
	"pass" => "root",
	"host" => "localhost",
	"db" => "youTunes"
);

// PDO connection
$db = new PDO(
	"mysql:host={$sql_details['host']};dbname={$sql_details['db']}",
	$sql_details['user'],
	$sql_details['pass'],
	array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	)
);

include( "include/DTEditor.mysql.pdo.class.php" );
