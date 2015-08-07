<?php
session_start();
include_once '../db/db.php';
if(isset($_POST['btn-save']))
{
    global $db;

    // echo "<pre>";
    // print_r($_POST);
    // die;
 // variables for input data
 $student_id = $_POST['student_number'];
 // variables for input data

 //check if student id exist
$var = $db->get_var("SELECT count(*) FROM users  WHERE `student_id`='" . $db->escape($student_id) . "' ");

if($var > 1){
    $_SESSION['message'] = '*Student ID already exists please try again.';
    header ("location: /admin/add_user.php");
    // die;
} else {
    $db->query("INSERT INTO users(student_id) VALUES($student_id)");
    $_SESSION['message'] = '*Student ID has been successfully added.';
    header ("location: /admin/add_user.php");
}

// if(!empty($student_id)){
//     $_SESSION['message'] = '*Student ID already exists please try again.';
//     header ("location: /admin/add_user.php");
//     // die;
// }

// $student_id = $db->get_row("SELECT * FROM `user` WHERE `student_id`='" . $db->escape($student_id) . "'");
// die;
 // sql query for inserting data into database

// sql query for inserting data into database
 
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
        <title>Add User - SNC Courseware</title>
    </head>
    <body class="level0">
    <style>
        @media (min-width: 1200px) {
            article {
                max-width: 562px;
                margin-left: 30%;
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
        <h1 style="text-align:center">Enter new User Credential</h1>
    </header>

    <section id="main_content" >
        <form method="post">
                <fieldset>
                    <h3 style="color:red;text-align:center;">
                        <?php 
                            if (isset($_SESSION['message']))
                            {
                                echo $_SESSION['message'];
                                //unset($_SESSION['message']);
                            }
                        ?>
                    </h3>
                    <p>
                        <label for="username" >Student Number: </label>
                        <input required type="text" name="student_number" id="student_number" value="" />
                    </p>
                    <!-- <p>
                        <label for="username" >Username: </label>
                        <input required type="text" name="username" id="username" value="" />
                    </p>
                    <p>
                        <label for="password">Password: </label>
                        <input required type="password" name="password" id="password" value="" />
                    </p> -->
                    <!-- <p>
                        <label for="username" >First name: </label>
                        <input required type="text" name="firstname" id="firstname" value="" />
                    </p>
                    <p>
                        <label for="username" >Last name: </label>
                        <input required type="text" name="lastname" id="lastname" value="" />
                    </p> -->
                    <p>
                        <label for="username" >Role: </label>
                        <select class="select-style"name="role">
                          <option value="student">Student</option>
                          <option value="teacher">Teacher</option>
                        </select>
                    </p>
                </fieldset>
                <div>
                    <button type="submit" class='btn' style="margin-left: 0;" name="btn-save"><strong>SAVE</strong></button>
                    <button type="reset" class='btn' value="Reset"><strong>RESET</strong></button>
                    <!-- <input type="submit" value="Submit" class="btn" style="margin-left: 0;"/> -->
                </div>
            </form>
    </section>

    <!--<section class="feature">
        <div class="feat2">

            <h2>All New Content</h2>

            <p><img src="./home_files/html5_2.gif"><a href="http://www.htmldog.com/about/10/">Coinciding with HTML Dog’s
                tenth year</a>, the site has been overhauled with its existing content updated and new guides added to
                incorporate <a href="http://www.htmldog.com/guides/html/">HTML5</a>, <a
                        href="http://www.htmldog.com/guides/css/">CSS3</a>, and <a
                        href="http://www.htmldog.com/guides/javascript/">JavaScript</a>.</p>

        </div>
    </section>-->


    <footer id="related">


    </footer>


</article>

<footer id="site_footer">
    <p>© St. Nicolas College - 2015.</p>

    <p><a href="#">E-Learning</a>.</p>
</footer>

<!--javascripts-->
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/main.js"></script>
    </body>
</html>
