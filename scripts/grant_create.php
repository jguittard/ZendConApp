<?php
require_once "deployment_params.inc";
$filestrMySQL = file_get_contents(dirname ( __FILE__ ) . "/create-grant-db.sql");
$filestrMySQL = str_replace('DB_USERNAME_PLACEHOLDER', $dbUsername, $filestrMySQL);
$filestrMySQL = str_replace('DB_PASSWORD_PLACEHOLDER', $dbPassword, $filestrMySQL);
$filestrMySQL = str_replace('DB_NAME_PLACEHOLDER', $dbName, $filestrMySQL);
file_put_contents(dirname ( __FILE__ ) . "/create-grant-db.sql", $filestrMySQL);

$mysqli = new mysqli($dbHost, $dbRootUsername, $dbRootPassword, $dbName);

$queries = explode ( ";\n", file_get_contents ( dirname ( __FILE__ ) . "/create-grant-db.sql" ) );

foreach ( $queries as $id => $query ) {
    if ($query != '') {
        $result = $mysqli->query($query);
        if (! $result) {
            echo sprintf("Invalid query [%s] : %s", $query, $mysqli->error);
            exit (1);
        }
    }
}