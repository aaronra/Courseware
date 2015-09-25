<?php
session_start();
include_once '../db/db.php';
global $db;

//$var = $db->get_row("SELECT * FROM `content` LEFT JOIN `links` ON content.link_id = links.id WHERE content.id ='" . $db->escape($_GET['id']) . "' ");
$var = $db->get_row("SELECT * FROM content LEFT JOIN links ON content.link_id = links.id WHERE `link_id`='" . $db->escape($_GET['id']) . "' ");

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
    $output = $_POST['output'];

    //print_r($_POST);die;
    $db->query("UPDATE links SET name = '$title' WHERE id = $id");
    $db->query("UPDATE content SET content = '$content' , description = '$description' , url_content_key = '$url_content_key' , activity = '$activity' , output = '$output' WHERE link_id = $id");
    $_SESSION['message'] = '*Content has been successfully updated.';
    header("location: edit_page.php?id=$id");
    die;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,300,400,600,700"
          rel="stylesheet">
    <link href="../css/redactor.css" rel="stylesheet">
    <link href="../css/redactor-font.eot" rel="stylesheet">
    <title>Edit Page - SNC Courseware</title>
</head>
<body class="level0">
<style>
    @media (min-width: 1200px) {
        article {
            max-width: 962px;
            margin-left: 20%;
        }
    }

    article form {
        background: transparent;
    }
</style>
<div id="dog_tag">

    <p><a href="index.html"><img src="http://www.araldito.com/wp-content/uploads/2014/06/e2.jpg"
                                 alt="SNC Logo" width="60" height="58">
            <span></span></a></p></div>
<p id="access_nav"><a href="#main_nav">Skip to navigation</a></p>
<article>

    <header>
        <h1 style="text-align:center">Edit Page</h1>
    </header>

    <section id="main_content">
        <form method="post">

            <?php
            // echo "<pre>";
            // print_r($var->title);
            // die;
            ?>
            <fieldset>
                <h3 style="color:red;text-align:center;">
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    ?>
                </h3>

                <p>
                    <label for="username">Title: </label>
                    <input required type="text" name="title" id="title" value="<?php echo $var->name; ?>"/>
                </p>

                <p>
                    <label for="username">Description: </label>
                    <input required type="text" name="description" id="description"
                           value="<?php echo $var->description; ?>"/>
                </p>

                <p>
                    <label for="username">URL Key: </label>
                    <input required type="text" name="url_content_key" id="url_content_key"
                           value="<?php echo $var->url_content_key; ?>"/>
                </p>

                <p>
                    <label for="username">Content: </label>
                        <textarea name="content" id="content" rows="14">
                            <?php echo $var->content?>
                        </textarea>
                </p>

                <p>
                    <label for="username">Activity: </label>
                        <textarea name="activity" id="activity" rows="14">
                            <?php echo $var->activity?>
                        </textarea>
                </p>

                <p>
                    <label for="username">Output: </label>
                        <textarea name="output" id="output" rows="14">
                            <?php echo $var->output?>
                        </textarea>
                </p>

                <p>
            </fieldset>
            <div>
                <button type="submit" class='btn' style="margin-left: 0;" name="btn-save"><strong>SAVE</strong></button>
                <button type="reset" class='btn' value="Reset"><strong>RESET</strong></button>
                <!-- <input type="submit" value="Submit" class="btn" style="margin-left: 0;"/> -->
            </div>
        </form>
    </section>

    <footer id="related">


    </footer>


</article>

<footer id="site_footer">
    <p>© St. Nicolas College - 2015.</p>

    <p><a href="#">E-Learning</a>.</p>
</footer>

<!--javascripts-->
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/main.js"></script>
<script src="../js/redactor.min.js"></script>
<script type="text/javascript">
    //<![CDATA[
    $(window).load(function () {
        $('#content').redactor({minHeight: 300});
    });
    //]]>
</script>
</body>
</html>
