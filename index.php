<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>SNC E-Learning</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
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
        <li class="logo"><a id="logo-container" href="" class="brand-logo">
                <img src="img/logo.jpg" id="front-page-logo">
            </a></li>
        <?php
        include_once 'login/admin-class.php';
        $admin = new itg_admin();
        $admin->_authenticate();
        ?>
        <?php if (isset($_SESSION['school'])){ ?>
            <ul>
                <?php foreach ($_SESSION['category'] as $key => $object): ?>
                    <li class="bold"><a href=/courseware<?php echo $object->url.'?subject='.$object->url_key; ?>><?php echo $object->name;?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php } else {?>
            <style>
    #hide-icon-mobile {
        display: none;
    }

    main, footer {
        padding-left: 0;
    }

    .side-nav {
        height: auto !important;
        padding-bottom: 0;
    }

    ul.side-nav.fixed li.logo {
        margin-bottom: 0;
        overflow: hidden;
    }

    .side-nav.fixed {
        position: absolute;
    }
</style>
        <?php } ?>
    </ul>
</header>


<main>
    <div class="container">
        <!--  Outer row  -->
        <div class="row">

            <div class="col s12">
                <!-- Modal Trigger --><br><br>
                <?php if (!isset($_SESSION['school'])): ?>
                <div class="row center">
                    <a class="btn-large waves-effect waves-light orange login" href="login.php">
                        <i class="fa fa-user"></i> Log in</a>
                </div>
               <?php endif;?>

                <!-- Modal Structure -->
                <div id="modal1" class="modal">
                    <div class="modal-content light-blue lighten-1" style="color: white">

                        <h4><i class="fa fa-user"></i> Login</h4>

                    </div>
                    <form action="login/login-action.php" method="post">
                        <div class="modal-content">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="student_id" name="student_id" type="text" class="validate">
                                    <label for="uid">User ID</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" value="Submit" class="waves-effect waves-light orange btn">Log in
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Logout -->
                <?php if (isset($_SESSION['school'])): ?>
                    <div class="row center">
                        <a class="modal-trigger btn-large waves-effect waves-light orange login" href="login/logout-action.php">
                            <i class="fa fa-user"></i> Logout</a>
                    </div>
                <?php endif;?>
                <!-- end of Logout block-->

                <h2 class="header orange-text">HTML, CSS and JavaScript Tutorials.</h2>

                <p class="caption">Welcome to St. Nicolas College E-Learning Site, the web designer’s resource for
                    everything HTML, CSS, and
                    JavaScript, the most common
                    technologies used in making web pages.</p>


                <div class="row section">
                    <h2 class="header orange-text">Tutorials</h2>

                    <p class="caption">Quick and easy-to-follow practical guides to get you up and
                        running with HTML, CSS, and JavaScript, following best-practices every step
                        of the way.</p>

                    <div class="col s12 l4">
                        <img class="promo" src="img/html-icon.png">
                        <h4 class="center">HTML</h4>

                        <p>
                            With HTML you can create your own Web site.
                            This tutorial teaches you everything about HTML.
                            HTML is easy to learn - You will enjoy it.
                        </p>
                        <br>
                    </div>

                    <div class="col s12 l4">
                        <img class="promo" src="img/css-icon.png">
                        <h4 class="center">CSS</h4>

                        <p>
                            Save a lot of work with CSS!<br/>
                            In our CSS tutorial you will learn how to use CSS to control the style and layout of
                            multiple Web pages all at once.
                        </p>
                        <br>
                    </div>

                    <div class="col s12 l4">
                        <img class="promo" src="img/js-icon.png">
                        <h4 class="center">Javascript</h4>

                        <p>
                            JavaScript is the programming language of HTML and the Web.

                            Programming makes computers do what you want them to do.

                            JavaScript is easy to learn.

                            This tutorial will teach you JavaScript from basic to advanced.
                        </p>
                    </div>
                </div>

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
                    <li><a href="view/html/index.html" class="white-text">HTML Tutorial</a>: No idea where to
                        start? Try here!
                    </li>
                    <li><a href="view/css/index.html" class="white-text">CSS Tutorial</a>: So, you can dabble in
                        HTML but how do you make it look good?
                    </li>
                    <li><a href="view/js/index.html" class="white-text">JavaScript Tutorials</a>: Programming?! Orayt!
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
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.min.js"></script>
<script src="js/init.js"></script>
</body>
</html>