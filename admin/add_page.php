<?php
session_start();
include_once '../db/db.php';
global $db;

//$var = $db->get_row("SELECT * FROM content  WHERE `id`='" . $db->escape($_GET['id']) . "' ");

if (isset($_POST['btn-save'])) {
    // echo "<pre>";
    // print_r($_POST);
    // die;
    $title = $_POST['title'];
    $description = $_POST['description'];
    $url_key = $_POST['url_content_key'];
    $content = $_POST['content'];
    $activity = $_POST['activity'];
    $output = $_POST['output'];
    $type = $_POST['type'];

    //print_r($previous_page->id);die;

    $var = $db->get_var("SELECT count(*) FROM content  WHERE url_content_key ='" . $db->escape($url_key) . "' ");

    if ($var > 1) {
        $_SESSION['message'] = '*URL KEY already exists please try again.';
        header("location: /courseware/admin/add_page.php");
        die;
    } else {
        $previous_page = $db->get_row("SELECT * FROM content ORDER BY id DESC LIMIT 1");
        // echo "<pre>";
        // print_r($previous_page);die;
        $db->query("UPDATE content SET next_url_key = '$url_key' , previous_url_key = '$previous_page->url_content_key' WHERE id = $previous_page->id");

        //add the link
        $db->query("INSERT INTO links(`category_id`,`name`) VALUES('$type','$title')");
        echo $db->insert_id;
        //insert content after link has been made
        $db->query("INSERT INTO content(`link_id`,`url_content_key`,`description`,`content`,`previous_url_key`,`activity`,`output`) VALUES('$db->insert_id','$url_key','$description','$content','$previous_page->url_key','$activity','$output')");
        $_SESSION['message'] = '*Content has been successfully added.';
        header("location: /courseware/admin/index.php");
        die;
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
    <link rel="stylesheet" type="text/css" href="../css/dataTables.css">
    <link href="../css/redactor.css" rel="stylesheet">
    <link href="../css/redactor-font.eot" rel="stylesheet">
</head>
<body>


<header>
    <nav class="top-nav light-blue lighten-1">
        <div class="container">
            <div class="nav-wrapper"><a class="page-title" style="font-family: serif;">SNC E-Learning</a></div>
        </div>
    </nav>
    <div class="container"><a href="#" data-activates="nav-mobile" id="hide-icon-mobile"
                              class="button-collapse top-nav full hide-on-large-only"><i
                class="mdi-navigation-menu"></i></a></div>
    <ul id="nav-mobile" class="side-nav fixed" style="left: 0px;">
        <li class="logo"><a id="logo-container" href="/courseware/admin" class="brand-logo">
                <img src="../img/logo.jpg" id="front-page-logo">
            </a></li>
        <form action="#" id="search">

            <?php if (!isset($_SESSION['admin_login'])) { ?>
                <li><a href="add_user.php"><i class="fa fa-user-plus fa-2x"></i>

                        <span class="nav-text">Add New User</span>
                    </a></li>
                <li><a href="add_page.php"><i class="fa fa-plus-circle fa-2x"></i>

                        <span class="nav-text">Add New Page</span>
                    </a></li>
                <li><a href="logout.php"><i class="fa fa-sign-out fa-2x"></i>

                        <span class="nav-text">Log-out</span>
                    </a></li>
            <?php } else { ?>
                <li><a href="/admin/add_user.php"><i class="fa fa-user-plus fa-2x"></i> Add New User</a></li>
                <li><a href="/admin/add_page.php"><i class="fa fa-plus-circle fa-2x"></i> Add New Page</a></li>
                <li><a href="logout.php"><i class="fa fa-sign-out fa-2x"></i> Log-out</a></li>
            <?php } ?>
        </form>
    </ul>
</header>


<main>
    <div class="container">
        <!--  Outer row  -->
        <div class="row">

            <div class="col s12">

                <!-- Modal Trigger --><br><br>

                <h2 class="header orange-text">Add New Page</h2>

                <form method="post" class="col s12" target="_self">

                    <?php
                    // echo "<pre>";
                    // print_r($var->title);
                    // die;
                    ?>
                        <h3 style="color:red;text-align:center;">
                            <?php
                            if (isset($_SESSION['message'])) {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            }
                            ?>
                        </h3>

                    <div class="row">
                        <div class="input-field col s12">
                            <input name="title" id="title" type="text" class="validate">
                            <label for="title">Title</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input name="description" id="description" type="text" class="validate">
                            <label for="description">Description</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input name="url_content_key" id="url_content_key" type="text" class="validate">
                            <label for="url_content_key">URL KEY</label>
                        </div>
                    </div>

                        <label for="username">Type: </label>
                        <select name="type" id="type">
                            <option value="1">HTML</option>
                            <option value="2">CSS</option>
                            <option value="3">Javascript</option>
                            <option value="4">VB.net</option>
                            <option value="5">C++</option>
                        </select>

                        <p>
                            <label for="username">Content: </label>
                        <textarea name="content" id="content" rows="14">

                        </textarea>
                        </p>



                    <div class="row">
                        <div class="input-field col s12" id="activity_output">
                            <textarea name="activity" id="activity" class="materialize-textarea"></textarea>
                            <label for="activity">Activity</label>
                        </div>
                    </div>

                    <div class="row" id="output">
                        <div class="input-field col s12" id="activity_output">
                            <textarea name="output" id="output" class="materialize-textarea"></textarea>
                            <label for="output">Output</label>
                        </div>
                    </div>


                        <p>

                    <div>
                        <button type="submit" class='btn orange' style="margin-left: 0;" name="btn-save"><strong>SAVE</strong>
                        </button>
                        <button type="reset" class='btn' value="Reset"><strong>RESET</strong></button>
                        <!-- <input type="submit" value="Submit" class="btn" style="margin-left: 0;"/> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Container -->
</main>

<footer class="page-footer" style="background-color:transparent">
    <div class="footer-copyright orange">
        <div class="container">
            © <a class="orange-text text-lighten-3" href="">St. Nicolas College</a>, All rights reserved.
        </div>
    </div>
</footer>


<!--  Scripts-->
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/init.js"></script>
<script src="../js/redactor.min.js"></script>
<script type="text/javascript">
    //<![CDATA[
    $(window).load(function () {
        //$('#activity').redactor({minHeight: 300});
        $('#content').redactor({minHeight: 300});

        if($('#type').val() == 1){
            $('#output').hide();
        }

        $( "#type" ).change(function() {
            console.log($( "#type" ).val());
            if($( "#type" ).val() < 3){
                $('#output').hide();
            }

            if($( "#type" ).val() > 3){
                $('#output').show();
            }
        });
    });
    //]]>
</script>
</body>
</html>
