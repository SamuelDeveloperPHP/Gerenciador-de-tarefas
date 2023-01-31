<?php

//Credenciais de acesso ao BD
define('HOST', 'localhost');
define('USER', 'mkwebd86_sistgra');
define('PASS', 'Enigma123');
define('DBNAME', 'mkwebd86_sistemagrafica');

$conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);