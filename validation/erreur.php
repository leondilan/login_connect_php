<?php

    class Erreur{

        public $name;
        public $mail;
        public $pass;

        public function __construct($name, $mail, $pass){
            $this->name = $name;
            $this->mail = $mail;
            $this->pass = $pass;
        }

        public function getErrors(){
            $errors=[];

            if (isset($this->name)) {
                if (strlen($this->name)===0) {
                    $errors['name']="Ce Champ est requis";
                }

                $testEmail=filter_var($this->mail,FILTER_VALIDATE_EMAIL);
                if ($testEmail===false) {
                    $errors['email']="Entrer un email valide";
                }

                if (strlen($this->pass)<8) {
                    $errors['pass']="Ce Champ necessite au moins 8 caracteres";
                }
            } else {
                $testEmail=filter_var($this->mail,FILTER_VALIDATE_EMAIL);
                if ($testEmail===false) {
                    $errors['email']="Entrer un email valide";
                }

                if (strlen($this->pass)<8) {
                    $errors['pass']="Ce Champ necessite au moins 8 caracteres";
                }
            }
            return $errors;
        }

        public function Invalid(){
            return !empty($this->getErrors());
        }
    }