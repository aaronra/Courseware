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
<html dir="ltr" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>SNC E-learning</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="../../css/font-awesome.min.css" rel="stylesheet">
    <link href="../../css/main.css" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,300,400,600,700"
          rel="stylesheet">
</head>

<body class="level0">
    <?php
        include_once '../login/admin-class.php';
        $admin = new itg_admin();
        $admin->_authenticate();
    ?>

    <?php
        if(!isset($_SESSION['school'])){ //if login in session is not set
            header("Location: /");
        }
    ?>
<div id="dog_tag">

    <p><a href="./home_files/home.html"><img src="http://www.araldito.com/wp-content/uploads/2014/06/e2.jpg"
                                             alt="SNC Logo" width="60" height="58">
        <span></span></a></p></div>
<p id="access_nav"><a href="#main_nav">Skip to navigation</a></p>
<article>

    <header>
        <h1><?php echo $var->name; ?></h1>
        <img src="../../img/bookmark.png" class="bookmark">
    </header>

    <section id="main_content">
        <div class="chapter">
            <?php if(!empty($var->previous_url_key)): ?>
                <div class="prev"><a class="chapter" href="?subject=<?php echo $links[0]->url_key ?>&url_key=<?php echo $var->previous_url_key ?>">« Back to Home</a></div>
            <?php endif; ?>

            <?php if(!empty($var->next_url_key)): ?>
                <div class="next"><a class="chapter" href="?subject=<?php echo $links[0]->url_key ?>&url_key=<?php echo $var->next_url_key ?>">Next Chapter »</a></div>
            <?php endif; ?>
        </div>

        <?php echo $var->content; ?>

        <!-- activity section -->
        <?php if(!empty($links[0]->category_id) && $links[0]->category_id < 3): ?>

        <textarea id="code" name=code>  
            <?php echo (!empty($var->activity) ? $var->activity : '' ); ?>
        </textarea>

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

        <div class="chapter">
            <?php if(!empty($var->previous_url_key)): ?>
                <div class="prev"><a class="chapter" href="?subject=<?php echo $links[0]->url_key ?>&url_key=<?php echo $var->previous_url_key ?>">« Back to Home</a></div>
            <?php endif; ?>

            <?php if(!empty($var->next_url_key)): ?>
                <div class="next"><a class="chapter" href="?subject=<?php echo $links[0]->url_key ?>&url_key=<?php echo $var->next_url_key ?>">Next Chapter »</a></div>
            <?php endif; ?>
        </div>
        <br/>
    </section>



    <footer id="related">

        <h2>Popular pages</h2>
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

    </footer>


</article>

<?php
include_once '../login/admin-class.php';
$admin = new itg_admin();
$admin->_authenticate();
?>
<nav id="main_nav">

    <ul>
        <li id="li_tut" class="parent"><a href="?subject=<?php echo $links[0]->url_key ?>"><?php echo $links[0]->url_key.' Tutorials' ?></a>
            <ul class="child">
                <?php foreach($links as $key => $object): ?>
                    <li><a href="?subject=<?php echo $object->url_key; ?>&url_key=<?php echo $object->url_content_key; ?>"><?php echo $object->name;?></a></li>
                <?php endforeach;?>
            </ul>
        </li>

        <li id="access_top"><a href="#">↑ Top</a></li>
    </ul>

</nav>
<!--<form action="#" id="search">
    <fieldset><label for="morombe">Search: </label><input name="q" id="morombe"><input type="submit" value="Search">
    </fieldset>
</form>-->
<footer id="site_footer">
    <p>© St. Nicolas College - 2015.</p>

    <p><a href="#">E-Learning</a>.</p>
</footer>

<!--javascripts-->
<script src="../../js/jquery-1.11.3.min.js"></script>
<script src="../../js/main.js"></script>
<script src="../../js/codemirror.js"></script>
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