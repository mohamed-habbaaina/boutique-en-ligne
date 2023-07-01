<?php

session_start();

require_once('../src/Classes/User.php');

$user = new \src\Classes\User();


$user->deconnect();
header('location: ./index.php');