<?php

class bDConn extends PDO
{
private $hostBd = 'sql9.freemysqlhosting.net';
private $nameBd = 'sql9599848';
private $userBd = 'sql9599848';
private $pwsBd = 'bEKiPhSLYt';

public function __construct()
{
    try{
parent::__construct('mysql:host=' . $this->hostBd . ';dbname=' . $this->nameBd .';charset=utf8', $this->userBd, $this->pwsBd, array(PDO::
ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(PDOException $e){
        echo $e->getMessage();
        exit;
    }
}

}

?>