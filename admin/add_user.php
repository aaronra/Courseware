<?php
session_start();
include_once '../db/db.php';
if (isset($_POST['btn-save'])) {
    global $db;

    // echo "<pre>";
    // print_r($_POST);
    // die;
    // variables for input data
    $student_id = $_POST['student_number'];
    // variables for input data

    //check if student id exist
    $var = $db->get_var("SELECT count(*) FROM users  WHERE `student_id`='" . $db->escape($student_id) . "' ");

    if ($var > 1) {
        $_SESSION['message'] = '*Student ID already exists please try again.';
        header("location: /courseware/admin/add_user.php");
        // die;
    } else {
        $db->query("INSERT INTO users(student_id) VALUES($student_id)");
        $_SESSION['message'] = '*Student ID has been successfully added.';
        header("location: /courseware/admin/add_user.php");
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
                <img src="/img/logo.jpg" id="front-page-logo">
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

                <h2 class="header orange-text">Add New User</h2>

                <form action="login-action.php" method="post">
                    <h3 style="color:red;text-align:center;">
                        <?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            //unset($_SESSION['message']);
                        }
                        ?>
                    </h3>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="student_number" name="student_number" type="text" class="validate">
                            <label for="student_number">Student Number</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <select>
                                <option value="" disabled selected>Choose a Role</option>
                                <option value="student">Student</option>
                                <option value="teacher">Teacher</option>
                            </select>
                            <label>Role Select</label>
                        </div>
                    </div>


                    <button type="submit" value="Submit" class="waves-effect waves-light orange btn"><i
                            class="fa fa-floppy-o"></i> Save
                    </button>
                    <button type="reset" value="Reset" class="waves-effect waves-light btn"><i
                            class="fa fa-refresh"></i> Reset
                    </button>
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
</body>
</html>
