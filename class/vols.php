<?php
    class vols{
        // Connection
        private $conn;
        // Table
        private $db_table = "vols";
        // Columns
        public $num_vol;
        public $villedep;
        public $villearr;
        public $heuredep;
        public $heurearr;
        public $pilote_id;
        public $avion_id;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getvols(){
            $sqlQuery = "SELECT num_vol, villedep, villearr, heuredep, heurearr, pilote_id, avion_id FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createvols(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    num_vol
                        num_vol = :num_vol, 
                        villedep = :villedep, 
                        villearr = :villearr,
                        heuredep = :heuredep,
                        heurearr = :heurearr,
                        pilote_id = :pilote_id,
                        avion_id = :avion_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->num_vol=htmlspecialchars(strip_tags($this->num_vol));
            $this->villedep=htmlspecialchars(strip_tags($this->villedep));
            $this->villearr=htmlspecialchars(strip_tags($this->villearr));
            $this->heuredep=htmlspecialchars(strip_tags($this->heuredep));
            $this->heurearr=htmlspecialchars(strip_tags($this->heurearr));
            $this->pilote_id=htmlspecialchars(strip_tags($this->pilote_id));
            $this->avion_id=htmlspecialchars(strip_tags($this->avion_id));
        
            // bind data
            $stmt->bindParam(":num_vol", $this->num_vol);
            $stmt->bindParam(":villedep", $this->villedep);
            $stmt->bindParam(":villearr", $this->villearr);
            $stmt->bindParam(":heuredep", $this->heuredep);
            $stmt->bindParam(":heurearr", $this->heurearr);
            $stmt->bindParam(":pilote_id", $this->pilote_id);
            $stmt->bindParam(":avion_id", $this->avion_id);

            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSinglevols(){
            $sqlQuery = "SELECT
                        num_vol,
                        villedep,
                        villearr,
                        heuredep,
                        heurearr,
                        pilote_id,
                        avion_id
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       num_vol = ?
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->num_vol);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->num_vol = $dataRow['num_vol'];
            $this->villedep = $dataRow['villedep'];
            $this->villearr = $dataRow['villearr'];
            $this->heuredep = $dataRow['heuredep'];
            $this->heurearr = $dataRow['heurearr'];
            $this->pilote_id = $dataRow['pilote_id'];
            $this->avion_id = $dataRow['avion_id'];
        }        
        // UPDATE
        public function updatevols(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        num_vol = :num_vol, 
                        villedep = :villedep, 
                        villearr = :villearr,
                        heuredep = :heuredep,
                        heurearr = :heurearr,
                        pilote_id = :pilote_id,
                        avion_id = :avion_id
                        
                    WHERE 
                        num_vol = :num_vol";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->num_vol=htmlspecialchars(strip_tags($this->num_vol));
            $this->villedep=htmlspecialchars(strip_tags($this->villedep));
            $this->villearr=htmlspecialchars(strip_tags($this->villearr));
            $this->heuredep=htmlspecialchars(strip_tags($this->heuredep));
            $this->heurearr=htmlspecialchars(strip_tags($this->heurearr));
            $this->pilote_id=htmlspecialchars(strip_tags($this->pilote_id));
            $this->avion_id=htmlspecialchars(strip_tags($this->avion_id));
        
            // bind data
            $stmt->bindParam(":num_vol", $this->num_vol);
            $stmt->bindParam(":villedep", $this->villedep);
            $stmt->bindParam(":villearr", $this->villearr);
            $stmt->bindParam(":heuredep", $this->heuredep);
            $stmt->bindParam(":heurearr", $this->heurearr);
            $stmt->bindParam(":pilote_id", $this->pilote_id);
            $stmt->bindParam(":avion_id", $this->avion_id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deletevols(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE num_vol = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->num_vol=htmlspecialchars(strip_tags($this->num_vol));
        
            $stmt->bindParam(1, $this->num_vol);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>