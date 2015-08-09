<?php

return array(
	array(
		"REMOTE_ADDR" => "127.0.0.10",
		"SCRIPT_NAME" => "/index.php",
		"DOCUMENT_ROOT" => getcwd(),
		"REQUEST_SCHEME" => "http",
		"REQUEST_URI" => "/",
		"HTTP_HOST" => "my.host.name"
	),
	array(
		"mysql:host=localhost;dbname=ecom_test", //db
		"root", //username
		"", //password
		"testdb_", // db prefix
		array("mysql:host=localhost", "ecom_test") //TEST ONLY! database create access
	)
);

