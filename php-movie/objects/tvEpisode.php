<?php

    class TvEpisode{
        public $id;
        public $tvshow_id;
        public $title;
        public $vid_src;
        public $ep_date;
        public $episode;
        public $season;
        public $synopsis;

        private $con;
        private $table_name = "tv_episodes";
        
        public function __construct($db){
            $this->con = $db;
        }
        
        public function setEpisodeSrc($tvshowId, $seasonNum, $episodeNum){
            
            $this->tvshow_id = $tvshowId;
            $this->season = $seasonNum;
            $this->episode = $episodeNum;
            
            
            $query = "SELECT vid_src FROM ".$this->table_name." WHERE 
            tvshow_id = ? AND season = ? AND episode = ? ";
            
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(1, $this->tvshow_id);
            $stmt->bindParam(2, $this->season);
            $stmt->bindParam(3, $this->episode);
            $stmt->execute();
            
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->vid_src=$data['vid_src'];
        }

        function create(){
            $query = "INSERT INTO ".$this->table_name." SET 
                tvshow_id = ?, season = ?, episode = ?, synopsis = ?, date = ?";
            
            $stmt = $this->con->prepare($query);
            
            $this->synopsis=htmlspecialchars(strip_tags($this->synopsis));       
            
            $stmt->bindParam(1,$this->tvshow_id);
            $stmt->bindParam(2,$this->season);
            $stmt->bindParam(3,$this->episode);
            $stmt->bindParam(4,$this->synopsis);  
            $stmt->bindParam(5,$this->ep_date);     

            if($stmt->execute()){
                $this->id=$this->con->lastInsertId("pk_id");            
                $query = "UPDATE ".$this->table_name." SET
                vid_src=? WHERE pk_id = ?";
                
                $stmt = $this->con->prepare($query);
                $stmt->bindParam(2,$this->id);
                $pattern = '/\s+/';
                $tvshowTitle = $this->title;
                $partialFormat1 =  preg_replace($pattern, '_', ucwords(strtolower($tvshowTitle)));
                $partialFormat2 = "";
                    if($this->season<10){
                        $partialFormat2 = "_s0".$this->season;
                    }else{
                        $partialFormat2 = "_s".$this->season;
                    }
                $partialFormat3 = "";
                    if($this->episode<10){
                        $partialFormat3 = "e0".$this->episode;
                    }else{
                        $partialFormat3 = "e".$this->episode;
                    }
                $formattedVidSrc = $partialFormat1.$partialFormat2.$partialFormat3;
                $this->vid_src = $formattedVidSrc;
                $stmt->bindParam(1,$this->vid_src);
                $stmt->execute();
                return true;
            }else{
                $arr = $stmt->errorInfo();
                print_r($arr);
                return false;
            }
        }
		
		function readEpisodes(){
			
			$query = "SELECT tvshow_id,season, episode FROM ".$this->table_name;
			
			$stmt = $this->con->prepare($query);
			$stmt->execute();
			
			return $stmt;
		}
    }
?>