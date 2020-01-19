var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://rawg-video-games-database.p.rapidapi.com/games",
    "method": "GET",
    "headers": {
        "x-rapidapi-host": "rawg-video-games-database.p.rapidapi.com",
        "x-rapidapi-key": "d99de5c23fmsh1a0d077965932e1p1a25a4jsna3c7a281d1eb"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
    for (let i = 7; i < 17; i++)
    {
        if(response.results[i].metacritic == null) {
            var metacritic = "Note inconnue";
        }
        else {
            var metacritic = response.results[i].metacritic + "%";
        }

        var genres = [];
        var x = 0;
        response.results[i].genres.forEach(genre => {
            genres.push(response.results[i].genres[x].name);
            x++;
        });

        var platforms = [];
        var x = 0;
        response.results[i].platforms.forEach(platform => {
            platforms.push(response.results[i].platforms[x].platform.name);
            x++;
        });

        document.getElementById("listGames").innerHTML += 
        '<div class="darkPanel mb-3 row"><img src="'
        + response.results[i].background_image + 
        '" alt="'
        + response.results[i].slug +
        '" class="col-11 col-md-6 ml-md-3 centerElement mb-2 box-shadow imageListArticle" /><div class="col-12 col-md-5"><p class="yellow">'
        + response.results[i].name+
        '</p><hr /><p class="mt-1 white">Score MetaCritic : '
        + metacritic +
        '</p><p class="mt-1 white">Genre : '
        +  genres.join() +
        '</p><p class="mt-1">Plateformes : '
        + platforms.join() +
        '</p></div></div>'
    }
});