<?php 

    class TvShow{
        public $id;
        public $title;
        public $desc;
        public $pilotReleasedDate;
        public $num_of_seasons;
        public $img_src;
        public $season;
        
        private $con;
        private $table_name = "tvshow";
        
        public function __construct($db){
            $this->con = $db;
        }
        
        
        function create(){
   
            $query = "INSERT INTO ".$this->table_name." SET 
                title=:1, description=:2, pilot_released_date=:3, num_of_seasons=:4, img_src=:5";
            
            $stmt = $this->con->prepare($query);
            
            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->desc=htmlspecialchars(strip_tags($this->desc));
            $this->imgSrc=htmlspecialchars(strip_tags($this->img_src)); //
            $this->pilotReleasedDate = $this->pilotReleasedDate;
            
            $stmt->bindParam(":1",$this->title);
            $stmt->bindParam(":2",$this->desc);
            $stmt->bindParam(":3",$this->pilotReleasedDate);
            $stmt->bindParam(":4",$this->num_of_seasons);  
            $stmt->bindParam(":5",$this->img_src);      
            
            
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }

        }
        
        function readAll($from_record_num, $records_per_page){//reads tvshows with pagination limits
            
            $query = "SELECT id, title, description, pilot_released_date, img_src FROM ".$this->table_name."
             ORDER BY id DESC LIMIT {$from_record_num},{$records_per_page}"; //sorted from newest to oldest, but by id
        
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }
        
        function readAllTvShows(){//fetches id and title from database with no LIMIT or pagination
            
            $query = "SELECT id, title,num_of_seasons FROM ".$this->table_name." ORDER BY title ASC";
            
            $stmt = $this->con->prepare($query);
            $stmt->execute();

            return $stmt;
        }
        
        public function countAll(){
            $query = "SELECT id FROM ".$this->table_name."";
            
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            
            $num = $stmt->rowCount();
            
            return $num;
        }
        
        function readOne(){
            $query = "SELECT title, description, pilot_released_date, num_of_seasons, img_src FROM ".$this->table_name." WHERE id = ? LIMIT 0,1";
            
            $stmt = $this->con->prepare ($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->title=$row['title'];
            $this->desc=$row['description'];
            $this->pilotReleasedDate=$row['pilot_released_date'];
            $this->num_of_seasons=$row['num_of_seasons'];
            $this->img_src=$row['img_src'];
        }
        
        function countEpisodes($tvshow_id, $seasonNum){
            
            $this->id = $tvshow_id;
            $this->season = $seasonNum;
            
            $query = "SELECT pk_id FROM tv_episodes WHERE tvshow_id = ? AND season = ?";
            
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->bindParam(2, $this->season);
            $stmt->execute();
            
            $num = $stmt->rowCount();
            
            return $num;
        }
        
        function update(){
            $query = "UPDATE ".$this->table_name." SET title=?, description=?, pilot_released_date=?, num_of_seasons=?, img_src=? WHERE id=?";
            
            $stmt = $this->con->prepare($query);
            
            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->desc=htmlspecialchars(strip_tags($this->desc));
            
            $stmt->bindParam(1,$this->title);
            $stmt->bindParam(2,$this->desc);
            $stmt->bindParam(3,$this->pilotReleasedDate);
            $stmt->bindParam(4,$this->num_of_seasons);
            $stmt->bindParam(5,$this->img_src);
            $stmt->bindParam(6,$this->id);
            
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }
        
    }
?>