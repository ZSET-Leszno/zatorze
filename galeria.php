<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stowarzyszenie Zatorze</title>
    <link rel = "stylesheet" href = "style.css">
</head>
<body>
    <header>

        <h1 class="nazwa">Stowarzyszenie Zatorze</h1>
        <img src="Zdjęcia/1.jpg" alt="budynek" class="zdj" id="1">
        <img src="Zdjęcia/2.jpg" alt="galeria" class="zdj" id="2">
        <img src="Zdjęcia/3.jpg" alt="sp9" class="zdj" id="3">
        <img src="Zdjęcia/4.jpg" alt="rondo" class="zdj" id="4">
        
    </header>
    <div id="DZ" style="z-index: 4; position: fixed; width: 100%; height: 100%; top: 0; left: 0; visibility: hidden;">
        <div style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; background: rgba(0, 0, 0, .7); cursor: pointer;" onclick="closeImage()"></div>
        <img src="<?php echo $row['image']; ?>" alt="DZ" id="DZChild" style="position: absolute; top: 5%; left: 5%; z-index: 6; width: 90%; height: 90%; object-fit: contain;">
        <span onclick="closeImage()" style="position: absolute; right: 20px; top: 20px; font-weight: 900; color: white; cursor: pointer;">X</span>
    </div>

    <script>
        function closeImage() {
        document.getElementById("DZ").style.visibility = 'hidden';
    }

    images = document.getElementsByTagName("img");
    for (var i = 0; i < images.length; i++){
        // on image click
        images[i].onclick = function(e){
            // set image src
            document.getElementById("DZChild").src = e.target.src;
            // show image
            document.getElementById("DZ").style.visibility = 'visible';
        }
    }
</script>

    <div class="panel"></div>
    <div class="content"></div>
    <div class="nav"></div>
    <footer></footer>
</body>
</html>