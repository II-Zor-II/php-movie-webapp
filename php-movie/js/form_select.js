

function addFileSelected() {
    var choice = document.getElementById("select").value;

    if(choice=="Movie"){
        document.getElementById("addFile_form").action="add_movie.php";
        document.getElementById("image_selector_input").disabled=false;
        document.getElementById("video_selector_input").disabled=false;
        document.getElementById("movie_form").style.display="table";
        document.getElementById("tvshow_form").style.display="none";  
        document.getElementById("tvshowEpisode_form").style.display="none";      
    }else if(choice=="TvShow"){
        document.getElementById("addFile_form").action="add_tvshow.php";
        document.getElementById("image_selector_input").disabled=false;
        document.getElementById("video_selector_input").disabled=true;
         document.getElementById("movie_form").style.display="none";
        document.getElementById("tvshow_form").style.display="table";       document.getElementById("tvshowEpisode_form").style.display="none";
    }else if(choice=="TvShowEpisode"){  
        document.getElementById("addFile_form").action="add_tvshow_episode.php";
        document.getElementById("image_selector_input").disabled=true;
        document.getElementById("video_selector_input").disabled=false;
        document.getElementById("tvshowEpisode_form").style.display="table";
        document.getElementById("movie_form").style.display="none";
        document.getElementById("tvshow_form").style.display="none"; 
        
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var tvshowArray = JSON.parse(this.responseText);
                parseTvshowSelection(tvshowArray);
            }
        };
        xmlhttp.open("GET", "JSON/tvshow.json", true);
        xmlhttp.send();	
    }	
}

function parseTvshowSelection(tvshowArray){
		
        var tvshowSelect =  document.getElementById("select_tvshow");
        var i;
        for(i=0; i<tvshowArray.length; i++){   
            var option = document.createElement("option");
            option.text = tvshowArray[i].title;
            option.value = tvshowArray[i].id;
            tvshowSelect.add(option);
        }
	
		tvshowSelect.addEventListener('change', function(){
			var xmlhttp2 = new XMLHttpRequest();
			var choice = this.value; // that will be the tvshow_id
			
			xmlhttp2.onreadystatechange = function(){
				if(this.readyState==4&&this.status==200){
					var tvshowEpisodesArr = JSON.parse(this.responseText);
					parseEpisodeList(tvshowEpisodesArr);
				}
			};
			xmlhttp2.open("GET", "JSON/tvshow_episodes.json", true);
			xmlhttp2.send();
		});
}

function parseEpisodeList(tvshowsEpisodesArr){
		genericArray
		
		tvshowEpisodesArr[choice].season[ctr1].episode[ctr2]
		
	}


