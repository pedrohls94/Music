 $.get("/reader.php?action=scan", function(data, status){
     if(JSON.parse(data) == null) {
            alert("That's not your lucky day, try again later.");
        } else {
            var songs = JSON.parse(data);
	    for(key in songs) {
	        document.getElementById('songList').innerHTML += '<element onclick="clicked('+"'"+songs[key]['files']+"'"+')" class="og-sidebar-item og-red-l3">'+songs[key]['author']+' - '+songs[key]['title']+'</a>';
	    }
        }
 });

function clicked(fileString) {
	var files = fileString.split(",");
	document.getElementById('viewFiles').innerHTML = '';
	for(key in files) {
                document.getElementById('viewFiles').innerHTML += '<div class="og-card"><div class="og-card-text"><img src="Files/'+files[key]+'" class="tabPNG"/></div></div>';
        }


}
