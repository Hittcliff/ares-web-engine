<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Cache</title>
    <style>
        .container {
            width: 50%;
            margin: 0 auto;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Anime Cache</h2>
        <textarea id="animeIds" placeholder="Enter anime IDs (comma-separated)"></textarea>
        <br><br>
        <button onclick="cacheAnime()">Cache Anime</button>
        <br><br>
        <progress id="progressBar" max="100" value="0"></progress>
        <div id="progressText">0%</div>
    </div>
    
    <script>
        function cacheAnime() {
            var animeIds = document.getElementById("animeIds").value.split(',');
            var progressBar = document.getElementById("progressBar");
            var progressText = document.getElementById("progressText");

            var totalAnime = animeIds.length;
            var completedAnime = 0;

            animeIds.forEach(function(animeId) {
                fetch('template/cache_functions.php?animeId=' + animeId)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(data => {
                        completedAnime++;
                        var percent = Math.round((completedAnime / totalAnime) * 100);
                        progressBar.value = percent;
                        progressText.textContent = percent + "%";
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });
            });
        }
    </script>
</body>
</html>
