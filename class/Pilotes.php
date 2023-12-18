<?php
    class Pilotes{
        // Connection
        private $conn;
        // Table
        private $db_table = "pilotes";
        // Columns
        public $num_pilote;
        public $nom;
        public $adresse;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getPilotes(){
            $sqlQuery = "SELECT num_pilote, nom, adresse FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createPilotes(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        num_pilote = :num_pilote, 
                        nom = :nom, 
                        adresse = :adresse";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->num_pilote=htmlspecialchars(strip_tags($this->num_pilote));
            $this->adresse=htmlspecialchars(strip_tags($this->adresse));
        
            // bind data
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":num_pilote", $this->num_pilote);
            $stmt->bindParam(":adresse", $this->adresse);

            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSinglePilotes(){
            $sqlQuery = "SELECT
                        num_pilote, 
                        nom, 
                        adresse
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       num_pilote = ?
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->num_pilote);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->nom = $dataRow['nom'];
            $this->num_pilote = $dataRow['num_pilote'];
            $this->adresse = $dataRow['adresse'];
        }        
        // UPDATE
        public function updatePilotes(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        nom = :nom, 
                        num_pilote = :num_pilote, 
                        adresse = :adresse
                    WHERE 
                        num_pilote = :num_pilote";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->num_pilote=htmlspecialchars(strip_tags($this->num_pilote));
            $this->adresse=htmlspecialchars(strip_tags($this->adresse));
        
            // bind data
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":num_pilote", $this->num_pilote);
            $stmt->bindParam(":adresse", $this->adresse);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deletePilotes(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE num_pilote = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->num_pilote=htmlspecialchars(strip_tags($this->num_pilote));
        
            $stmt->bindParam(1, $this->num_pilote);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>