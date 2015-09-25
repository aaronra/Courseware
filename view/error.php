<?php
include_once '../db/db.php';
global $db;

if(isset($_GET['subject'])){
    $links = $db->get_results("SELECT * FROM category LEFT JOIN links INNER JOIN content ON content.link_id = links.id ON category.id = links.category_id WHERE `url_key`='" . $db->escape($_GET['subject']) . "' ");
    // echo "<pre>";
    // print_r($links);
    // die;
    if(isset($_GET['url_key'])){
        $var = $db->get_row("SELECT * FROM content LEFT JOIN links ON content.link_id = links.id WHERE `url_content_key`='" . $db->escape($_GET['url_key']) . "' ");
    } else {
        $var = $db->get_row("SELECT * FROM content LEFT JOIN links ON content.link_id = links.id WHERE `link_id`='" . $links[0]->link_id . "' ");

        if(empty($var)){
            header("Location: /courseware/view/error.php");
        }
    }
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>SNC E-Learning</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="../css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>


    
</head>
<body>
<header>
    <nav class="top-nav light-blue lighten-1">
        <div class="container">
            <img src="../img/bookmark.png" class="bookmark"/>
            <div class="nav-wrapper"><a class="page-title" style="font-family: serif;">SNC E-Learning</a></div>
        </div>
    </nav>
    <div class="container"><a href="#" data-activates="nav-mobile" id="hide-icon-mobile"
                              class="button-collapse top-nav full hide-on-large-only"><i
                class="mdi-navigation-menu"></i></a></div>
    <ul id="nav-mobile" class="side-nav fixed" style="left: 0px;">
        <li class="logo"><a id="logo-container" href="/courseware" class="brand-logo">
                <img src="../img/logo.jpg" id="front-page-logo">
            </a></li>

     
    </ul>
</header>


<main>
    <div class="container">
        <!--  Outer row  -->
        <div class="row">

            <div class="col s12">
                
                <section id="main_content">
                    <h1>Content will be available soon... </h1>
                    <h4><a href="/courseware">Go Back Home</a></h4>
                    <br/>
                </section>

            </div>
        </div>
    </div>
    <!-- End Container -->
</main>

<footer class="page-footer orange">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h2 class="header white-text">Popular pages</h2>
                <ul>
                    <li><a href="/courseware/view/pages/index.php?subject=html" class="white-text">HTML Tutorial</a>: No idea where to
                        start? Try here!
                    </li>
                    <li><a href="/courseware/view/pages/index.php?subject=css" class="white-text">CSS Tutorial</a>: So, you can dabble in
                        HTML but how do you make it look good?
                    </li>
                    <li><a href="/courseware/view/pages/index.php?subject=js" class="white-text">JavaScript Tutorials</a>: Programming?! Orayt!
                        Rock
                        and Roll to the World!
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © <a class="orange-text text-lighten-3" href="">St. Nicolas College</a>, All rights reserved.
        </div>
    </div>
</footer>


<!--  Scripts-->
<!--javascripts-->
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/codemirror.js"></script>
<script src="../js/init.js"></script>
<script src="../js/materialize.min.js"></script>
<script>
    var delay;
    // Initialize CodeMirror editor with a nice html5 canvas demo.
    var editor = CodeMirror.fromTextArea(document.getElementById('code'), {
        mode: 'text/html'
    });
    editor.on("change", function () {
        clearTimeout(delay);
        delay = setTimeout(updatePreview, 300);
    });

    function updatePreview() {
        var previewFrame = document.getElementById('preview');
        var preview = previewFrame.contentDocument || previewFrame.contentWindow.document;
        preview.open();
        preview.write(editor.getValue());
        preview.close();
    }
    setTimeout(updatePreview, 300);
</script>
</body>
</html>