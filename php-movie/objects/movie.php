<?php 

    class Movie{
        public $id;
        public $title;
        public $desc;
        public $date_released;
        public $imgSrc;
        public $vidSrc;
        
        private $con;        
        private $table_name = "movies";
            
        public function __construct($db){
            $this->con = $db;
        }
    
        
        function create(){
            
            // we must first acquire the id of the last row then add it on our vid_src || $this->con->lastInsertId("id");
            
            $query = "INSERT INTO ".$this->table_name." SET 
                title=:title, description=:description, date_released=:date,img_src=:imgSrc";
            
            $stmt = $this->con->prepare($query);
            
            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->title = ucwords(strtolower($this->title));
            $this->desc=htmlspecialchars(strip_tags($this->desc));
            $this->date_released=$this->date_released;
            
            $this->imgSrc=htmlspecialchars(strip_tags($this->imgSrc)); //
            
            $stmt->bindParam(":title",$this->title);
            $stmt->bindParam(":description",$this->desc);
            $stmt->bindParam(":date",$this->date_released);
            $stmt->bindParam(":imgSrc",$this->imgSrc);      
            
            
            if($stmt->execute()){
                $this->id=$this->con->lastInsertId("id");
                
                $query = "UPDATE ".$this->table_name." SET
                vid_src=? WHERE id = ?";
                
                $stmt = $this->con->prepare($query);
                $stmt->bindParam(2,$this->id);
                $pattern = '/[-]+/';
                $formattedVidSrc = preg_replace($pattern, '_', $this->vidSrc)."_".$this->id;
                $this->vidSrc = $formattedVidSrc;
                $stmt->bindParam(1,$this->vidSrc);
                $stmt->execute();
                return true;
            }else{
                return false;
            }

        }
        
        function readAll($from_record_num, $records_per_page){
            
            $query = "SELECT id, title, description, date_released, img_src,vid_src FROM ".$this->table_name." ORDER BY date_released DESC 
            LIMIT {$from_record_num},{$records_per_page}"; //Sorted from newest to oldest
            
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
            $query = "SELECT title, description, date_released, vid_src, img_src FROM ".$this->table_name." WHERE id = ? LIMIT 0,1";
            
            $stmt = $this->con->prepare ($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->title=$row['title'];
            $this->desc=$row['description'];
            $this->date_released=$row['date_released'];
            $this->vidSrc=$row['vid_src'];
            $this->imgSrc=$row['img_src'];
        }
        
        function update(){
            $query = "UPDATE ".$this->table_name." SET title=?, description=?, img_src=?, date_released=?, vid_src=? WHERE id=? ";
            
            $stmt = $this->con->prepare($query);
            
            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->title = ucwords(strtolower($this->title));
            $this->desc=htmlspecialchars(strip_tags($this->desc));
            
            $stmt->bindParam(1,$this->title);
            $stmt->bindParam(2,$this->desc);
            $stmt->bindParam(3,$this->imgSrc);
            $stmt->bindParam(4,$this->date_released);
            $stmt->bindParam(5,$this->vidSrc);
            $stmt->bindParam(6,$this->id);
            
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }
        
    }

?>
