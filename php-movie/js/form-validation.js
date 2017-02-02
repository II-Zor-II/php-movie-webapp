$(document).ready(function(){
    var tvshow_id = "";
    var season = "";
    $("#select_tvshow").on('change', function() {
           tvshow_id =  $('#select_tvshow :selected').val(); 
           document.getElementById("season_input").value =
    });
    
    $("#season_input").on("keyup", function(){
        
        if($('#season_input').val().isInteger()){
            season = $('#season_input').val();
                if(season>0&&season<//actual seasons )
            } else {
                $('#season_input').value() = "please enter a valid season number";
            }    
        }
    });
    
});

function validate_input(episode_num){
    
        if (episode_num.isInteger()) { 
        $("#tvEp_input").value = episode_num;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tvEp_input").value = this.responseText;
            }
        };
        xmlhttp.open("GET", "gethint.php?tvshow_id=" + str, true);
        xmlhttp.send();
            
            
        } else if(episode_num == ""){
        $("#tvEp_input").value = "please enter episode number";            
        }
    
    

    
}