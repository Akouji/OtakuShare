<?php $subtitle = $_GET['subtitle'];
$font = $_GET['font'];
$link = $_GET['id'];?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="no-referrer" />
    <link rel="shortcut icon" href="./favicon.ico?v=wAOz4X2G7G">
    <title>Jwplayer - Advanced Substation Alpha Library for WebAssembly & asm.js</title>
    <link integrity="" rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="./resources/js/subtitles-octopus.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="./index.php">home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nb" aria-controls="nb" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nb">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="https://github.com/py7hon/gdvjs">Github</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/Dador/JavascriptSubtitlesOctopus">ASS Worker</a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="content" style="padding-top: 25px;">
        <div id="main" class="container container-body">
            <h1>JWPlayer Example</h1>

            <div style="width: 800px; height: 500px;">
                <div id="player">Loading the player...</div>
            </div>

            <script src="https://content.jwplatform.com/libraries/DbXZPMBQ.js"></script>
            <script>
                // Player Setup
                var player = jwplayer('player').setup({
                    file: 'https://www.googleapis.com/drive/v3/files/<?php echo $link?>?alt=media&key=AIzaSyD739-eb6NzS_KbVJq1K8ZAxnrMfkIqPyw',
                    volume: 10,
                    autostart: false,
                    width: 854,
                    height: 480
                });

                player.on('ready', function () {
                    var video = player.getContainer().querySelector('video');
                    window.SubtitlesOctopusOnLoad = function () {
                        var options = {
                            video: video,
                            subUrl: '<?php echo $subtitle?>',
                            fonts: '<?php echo $font?>',
                            //onReady: onReadyFunction,
                            //debug: true,
                            workerUrl: './resources/js/subtitles-octopus-worker.js'
                        };
                        window.octopusInstance = new SubtitlesOctopus(options); // You can experiment in console
                    };
                    if (SubtitlesOctopus) {
                        SubtitlesOctopusOnLoad();
                    }
                });
            </script>
        </div>
    </div>
</body>

</html>
