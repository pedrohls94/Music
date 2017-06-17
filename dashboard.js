$.get("/reader.php?action=scan", function(data, status){
    var songs = JSON.parse(data);
    console.log(songs);
});
