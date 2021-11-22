<?php
    global $dbh;
    $parameters=parse_ini_file('config/parameters.ini');
    $dsn='mysql:host=' . $parameters['host'] . ';dbname=' . $parameters['name'];
    try{
        $dbh = new PDO($dsn, $parameters['login'], $parameters['password']);

    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>