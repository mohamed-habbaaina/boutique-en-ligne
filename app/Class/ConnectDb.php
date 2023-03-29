<?php

class ConnectionDB {

    public static function connect() {

        // Connection to the database
        try {
            $db = new PDO(
                'mysql:host=localhost;livreor;charset=utf8',
                'root',
                ''
            );
            return $db;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}