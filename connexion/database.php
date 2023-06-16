<?php
    if(session_status() === PHP_SESSION_NONE) session_start();

    class Database{

        const serveur='localhost';
        const login='root';
        const pass='';

        public function connexion(){
            $connexion=new PDO("mysql:host=".self::serveur.";dbname=client",self::login,self::pass);
            $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            return $connexion;	
        }

        public function create($a,$b,$c){
            $hash=password_hash($c,PASSWORD_BCRYPT,['cost'=>12]);

            try {
                $sql="INSERT INTO utilisateur(nomUser,mailUser,passUser) 
                VALUES(:nomUser,:mailUser,:passUser)";
                $requete=$this->connexion()->prepare($sql);
                $requete->bindParam(':nomUser',$a);
                $requete->bindParam(':mailUser',$b);
                $requete->bindParam(':passUser',$hash);
                $requete->execute();

                header('Location:/');
                exit;
        
            } catch (PDOException $e) {
                echo 'Echec de la connexion : '.$e->getMessage();
            }
        }

        public function login($a,$b){
            try {
                $sql="SELECT * FROM utilisateur WHERE mailUser=:mailUser";
                $requete=$this->connexion()->prepare($sql);
                $requete->bindParam(':mailUser',$a);
                $requete->execute();
                $user=$requete->fetch();
        
                if ($user) {
                    $testPass=password_verify($b,$user['passUser']);
                    if ($testPass) {
                        $_SESSION['idUser']=$user['idUser'];
                        header('Location:/pages/home.php');
                        exit;
                    } else {
                        return false;
                    }
                    
                } else {
                   return false;
                }
                
        
            } catch (PDOException $e) {
                echo 'Echec de la connexion : '.$e->getMessage();
            }
        }

        public function getUser($a){
            try {
                $sql="SELECT * FROM utilisateur WHERE idUser=:idUser";
                $requete=$this->connexion()->prepare($sql);
                $requete->bindParam(':idUser',$a);
                $requete->execute();

                return $requete->fetch();
        
            } catch (PDOException $e) {
                echo 'Echec de la connexion : '.$e->getMessage();
            }
        }
    }