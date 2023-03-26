<?php
//include auth_session.php file on all user panel pages
include("../../auth_session.php");
// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" prefix="content: http://purl.org/rss/1.0/modules/content/ dc: http://purl.org/dc/terms/ foaf: http://xmlns.com/foaf/0.1/ og: http://ogp.me/ns# rdfs: http://www.w3.org/2000/01/rdf-schema# sioc: http://rdfs.org/sioc/ns# sioct: http://rdfs.org/sioc/types# skos: http://www.w3.org/2004/02/skos/core# xsd: http://www.w3.org/2001/XMLSchema#">
<head>
  <link rel="profile" href="http://www.w3.org/1999/xhtml/vocab" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Jquery Image Maker Plugin , Jquery Image Generator Plugin , Image Maker Plugin, Image Maker ,  Image Editor, Clothes and T-shirt maker , Birthday Cards maker">
  <meta name="description" content="JQuery Image Maker responsive plugin enable you to add a custom resizable texts to image in addition to merge images and Draw. It based on HTML5 canvas">
  <meta name="robots" content="follow, index">
  <title>Jquery Image Maker Plugin</title>
  <link rel="stylesheet" type="text/css" href="../imageMaker.min.css">
  <link rel="stylesheet" href="../../css/main.css">
 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.2/jquery.ui.touch-punch.min.js"></script>
    <script src="../imageMaker.min.js"></script>
    <script>
     $( document ).ready(function() {
        // $('#memegenerator').imageMaker( {templates:[
        //     {url: './assets/meme_generator/One-Does-Not-Simply.jpg', title:'One Does Not Simply'},
        //     {url: './assets/meme_generator/Roll-Safe-Think-About-It.png', title:'Roll Safe Think About It'},
        //     {url: './assets/meme_generator/The-Rock-Driving.png', title:'The Rock Driving'},
        //     {url: './assets/meme_generator/Third-World-Skeptical-Kid.png', title:'Third World Skeptical Kid'},
        // ],});

        // $('#birthday-cards').imageMaker( {templates:[
        //     {url: './assets/birthday_cards/happy-birthday-greeting-card.jpg', title:'Happy birthday greeting card with blank place for your wishes and message'},
        //     {url: './assets/birthday_cards/blank-white-floral-card-template-illustration.jpg', title:'blank white floral card template illustration'},
        //     {url: './assets/birthday_cards/happy-fathers-day-gift.jpg', title:'Happy fathers day gift'},
        //     {url: './assets/birthday_cards/white-card-sweet-cakes-macaroons.jpg', title:'White card sweet cakes macaroons'},
        // ], text_boxes_count:1});

        $('#image-maker').imageMaker();
       //The following code is for animate scrolling when open the page
       jQuery([document.documentElement, document.body]).animate({
        scrollTop: jQuery("#"+jQuery(":target").attr('id')).offset().top
    }, 1000);
    });
  </script>
</head>
<body>
<header class="navbar flex space-between">
    <div class="logo">
            <img src="../../img/meme-creator-logo.png" alt="Meme Creator Logo" width="100" />
        </div>
        <div class="logo" style="margin-left:30px;">
            <!-- <h1 class="heading" style="white-space: nowrap;">Meme Generator</h1> -->
            <div class="container">
            <div class="text">
                <span>M</span>
                <span>E</span>
                <span>M</span>
                <span>E</span>
            </div>
            <div class="text">
                <span>G</span>
                <span>E</span>
                <span>N</span>
                <span>E</span>
                <span>R</span>
                <span>A</span>
                <span>T</span>
                <span>O</span>
                <span>R</span>
            </div>
            </div>
            <h5 class="sub-heading" style="white-space: nowrap">Your Meme Stock</h5>
        </div>
        <nav class="navbar topnav flex">
            <ul class="main-nav flex clean-list  space-between align-center">
                <li><a href="../../index.php">Gallery</a></li>
                <li><a href="index.php">Create Your Own Memes</a></li>                
            </ul>
            <ul class="main-nav flex clean-list  space-between align-center">
                <?php if(isset($_SESSION)) { ?>
                <li><a href="#">Welcome <?php echo ucfirst($_SESSION["username"]); ?></a></li>   
                <?php } ?>
                <li><a href="logout.php"><img src="../../img/logout-icon.png" width="20" /></a></li>                           
            </ul>
            <button class="btn-menu fa fa-bars" onclick="toggleMenu()"></button>
        </nav>
    </header>
    <a href="../../index.php" class="btn btn-default btn-primary" >Back to Gallery</a>
 
</br>   
<!-- <div id="clothe-tshirt-maker"><h1>Clothes & T-Shirt maker</h1></div>
</br>
    <div id="memegenerator"><h1>Meme Generator</h1></div>
</br>
    <div id="birthday-cards"><h1>Birthday Cards</h1></div>
</br> -->
 <div id="image-maker"><h1>Create Your Meme</h1></div>
</body>
</html>
