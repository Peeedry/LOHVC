<?php
function conectar()
{

    //escolher mysql ou postgresql

    $host = 'localhost';
    $db = 'Luhvc';
    $user = 'postgres';
    $password = '123';
    $pdo = new PDO("pgsql:host=$host;port=5432;dbname=$db;", $user, $password);

    return $pdo;
}
