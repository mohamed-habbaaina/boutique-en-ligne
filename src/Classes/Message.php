<?php

namespace src\Classes;

class Message
{
    // Le constructeur prend en paramètres les différentes propriétés de la classe
    public function __construct(
        private string $content,
        private string $firstname,
        private string $lastname,
        private string $email,
        private string $phone,
        private ?int $id = null,
        private ?string $date = null
    ) {
    }

    // Des méthodes getter pour récupérer les différentes propriétés de la classe
    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getId() {
        return $this->id;
    }

    public function getDate() {
        return $this->date;
    }

    public function getContent() {
        return $this->content;
    }

    // Des méthodes setter pour mettre à jour les propriétés id et date de la classe
    public function setId(int $id) {
        $this->id = $id;
    }

    public function setDate(string $date) {
        $this->date = $date;
    }
}