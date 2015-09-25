<?php
include_once '../../db/db.php';
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
    <link href="../../css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>


    <link rel=stylesheet href=../../css/codemirror.css>
    <script src=../../js/codemirror.js></script>
    <style type=text/css>
        .CodeMirror {

            border: 1px solid black;
        }

        iframe {
            width: 100%;
            height: 300px;
            border: 1px solid black;

        }
    </style>
</head>
<body>
<header>
    <nav class="top-nav light-blue lighten-1">
        <div class="container">
            <img src="../../img/bookmark.png" class="bookmark"/>
            <div class="nav-wrapper"><a class="page-title" style="font-family: serif;">SNC E-Learning</a></div>
        </div>
    </nav>
    <div class="container"><a href="#" data-activates="nav-mobile" id="hide-icon-mobile"
                              class="button-collapse top-nav full hide-on-large-only"><i
                class="mdi-navigation-menu"></i></a></div>
    <ul id="nav-mobile" class="side-nav fixed" style="left: 0px;">
        <li class="logo"><a id="logo-container" href="/courseware" class="brand-logo">
                <img src="../../img/logo.jpg" id="front-page-logo">
            </a></li>

        <?php foreach($links as $key => $object): ?>
                    <li><a href="?subject=<?php echo $object->url_key; ?>&url_key=<?php echo $object->url_content_key; ?>"><?php echo $object->name;?></a></li>
                <?php endforeach;?>

    </ul>
</header>


<main>
    <div class="container">
        <!--  Outer row  -->
        <div class="row">

            <div class="col s12">
                
                <section id="main_content">
                    <div class="chapter" style="padding:20px 0px;">
                        <?php if(!empty($var->previous_url_key)): ?>
                            <span class="prev" style="float:left;"><a class="chapter" href="?subject=<?php echo $links[0]->url_key ?>&url_key=<?php echo $var->previous_url_key ?>">« Back to Home</a></span>
                        <?php endif; ?>

                        <?php if(!empty($var->next_url_key)): ?>
                            <span class="next" style="float:right;"><a class="chapter" href="?subject=<?php echo $links[0]->url_key ?>&url_key=<?php echo $var->next_url_key ?>">Next Chapter »</a></span>
                        <?php endif; ?>
                    </div>
<h2 class="header orange-text"><?php echo $var->name; ?></h2>


                    <?php echo $var->content; ?>

                    <!-- activity section -->
                    <?php if(!empty($links[0]->category_id) && $links[0]->category_id < 3): ?>
                    <h2 class="header orange-text">Example</h2>
                    <div class="col s12 l6 textareacontainer">
                    <div class="textarea">
                        <div style="overflow:auto;">
                            <div class="headerText">Edit This Code:</div>
                        </div>
                        <div class="textareawrapper">
                    <textarea id="code" name=code>  
                        <?php echo (!empty($var->activity) ? $var->activity : '' ); ?>
                    </textarea>
                </div>
                </div>
            </div>

                    <div class="col s12 l6 iframecontainer">
                        <div class="iframe">
                            <div style="overflow:auto;">
                                <div class="headerText">Result:</div>
                            </div>
                            <div class="iframewrapper">

                                <iframe id="preview"><?php echo (!empty($var->output) ? $var->output : '' ); ?></iframe>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- activity section -->
                    <?php if(!empty($links[0]->category_id) && $links[0]->category_id > 3): ?>
                        <label for="username">Activity: </label>
                        <textarea name="activity" id="activity" rows="14" disabled style="width:300px;resize:none;">
                            <?php echo $var->activity ?>
                        </textarea>

                        <label for="username">Output: </label>
                        <textarea name="output" id="output" rows="14" disabled style="width:300px;resize:none;">
                            <?php echo $var->output ?>
                        </textarea>
                    <?php endif; ?>

                    <div class="chapter" style="padding:20px 0px;">
                        <?php if(!empty($var->previous_url_key)): ?>
                            <span class="prev" style="float:left;"><a class="chapter" href="?subject=<?php echo $links[0]->url_key ?>&url_key=<?php echo $var->previous_url_key ?>">« Back to Home</a></span>
                        <?php endif; ?>

                        <?php if(!empty($var->next_url_key)): ?>
                            <span class="next" style="float:right;"><a class="chapter" href="?subject=<?php echo $links[0]->url_key ?>&url_key=<?php echo $var->next_url_key ?>">Next Chapter »</a></span>
                        <?php endif; ?>
                    </div>
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
<script src="../../js/jquery-1.11.3.min.js"></script>
<script src="../../js/codemirror.js"></script>
<script src="../../js/init.js"></script>
<script src="../../js/materialize.min.js"></script>
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