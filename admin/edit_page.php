<?php
session_start();
include_once '../db/db.php';
global $db;

//$var = $db->get_row("SELECT * FROM `content` LEFT JOIN `links` ON content.link_id = links.id WHERE content.id ='" . $db->escape($_GET['id']) . "' ");
$var = $db->get_row("SELECT * FROM content LEFT JOIN links ON content.link_id = links.id WHERE `link_id`='" . $db->escape($_GET['id']) . "' ");
// echo "<pre>";
// print_r($var);
// die;
if (isset($_POST['btn-save'])) {
//     echo "<pre>";
// print_r($_POST);
// die;
    $id = $_GET['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $activity = $_POST['activity'];
    $url_content_key = $_POST['url_content_key'];
    $content = $_POST['content'];
    $activity = $_POST['activity'];
    

    if(!empty($_POST['output'])){
        $output = $_POST['output'];

        $db->query("UPDATE links SET name = '$title' WHERE id = $id");
        $db->query("UPDATE content SET content = '$content' , description = '$description' , url_content_key = '$url_content_key' , activity = '$activity' , output = '$output' WHERE link_id = $id");
        $_SESSION['message'] = 'Content has been successfully updated!';
        header("location: edit_page.php?id=$id");
        die;
    } else {
        $db->query("UPDATE links SET name = '$title' WHERE id = $id");
        $db->query("UPDATE content SET content = '$content' , description = '$description' , url_content_key = '$url_content_key' , activity = '$activity' WHERE link_id = $id");
        $_SESSION['message'] = 'Content has been successfully updated!';
        header("location: edit_page.php?id=$id");
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
    <link rel="stylesheet" type="text/css" href="../css/dataTable.css">
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
                <li><a href="add_user.php"><i class="fa fa-user-plus fa-2x"></i>

                        <span class="nav-text">Add New User</span>
                    </a></li>
                <li><a href="add_page.php"><i class="fa fa-plus-circle fa-2x"></i>

                        <span class="nav-text">Add New Page</span>
                    </a></li>
                <li><a href="logout.php"><i class="fa fa-sign-out fa-2x"></i>

                        <span class="nav-text">Log-out</span>
                    </a></li>
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

                <h2 class="header orange-text">Edit Page</h2>

                <form method="post" class="col s12" target="_self">

                    <?php
                    // echo "<pre>";
                    // print_r($var->title);
                    // die;
                    ?>



                    <?php
                    if (isset($_SESSION['message'])) {
                        ?>
                        <div class="alert-success" style="margin-top:18px;">
                            <strong>
                                <?php echo $_SESSION['message']; ?>
                            </strong>
                        </div>
                        <?php
                        unset($_SESSION['message']);
                    }
                    ?>


                    <div class="row">
                        <div class="input-field col s12">
                            <input name="title" id="title" type="text" value="<?php echo $var->name; ?>"
                                   class="validate">
                            <label for="title">Title</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input name="description" value="<?php echo $var->description; ?>" id="description"
                                   type="text" class="validate">
                            <label for="description">Description</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input name="url_content_key" value="<?php echo $var->url_content_key; ?>"
                                   id="url_content_key" type="text" class="validate">
                            <label for="url_content_key">URL KEY</label>
                        </div>
                    </div>


                    <p>
                        <label for="username">Content: </label>
                        <textarea name="content" id="content" rows="14">
                            <?php echo $var->content?>
                        </textarea>
                    </p>

                    <div class="row">
                        <div class="input-field col s12" id="activity_output">
                            <a style="display:none" href="https://dotnetfiddle.net/" id="link" target="_blank">Click here to edit the activity</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12" id="activity_output">
                            <a href="http://www.tutorialspoint.com/compile_cpp11_online.php" id="cLink" target="_blank">Click here to edit the C++ activity</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12" id="activity">
                            <textarea name="activity" id="activity" class="materialize-textarea"><?php echo $var->activity ?></textarea>
                            <label for="activity">Activity</label>
                        </div>
                    </div>

                    <p>
                    <input type="hidden" id="type" value="<?php echo $var->category_id; ?>">
                    <div>
                        <button type="submit" class='btn orange' style="margin-left: 0;" name="btn-save">
                            <strong>SAVE</strong>
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

        if($( "#type" ).val() < 3){
                $('#link').hide();
            }

        if($( "#type" ).val() < 5){
                $('#cLink').hide();
            }

        if($( "#type" ).val() == 4){
                $('#link').show();
            }

        if($( "#type" ).val() == 5){
                $('#cLink').show();
            }

            

            if($( "#type" ).val() > 3){
                $('#output').hide();
            }

    });
    //]]>
</script>
</body>
</html>
