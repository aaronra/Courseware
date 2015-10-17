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
<body class="bg">
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
        <li class="logo"><a id="logo-container" href="/courseware" class="brand-logo">
                <img src="img/logo.jpg" id="front-page-logo">
            </a></li>

    </ul>
</header>


<main>
    <div class="container">
        <!--  Outer row  -->
        <div class="row">

            <div class="col s12 l6" style=" background-color: black;
    opacity: 0.7;
    padding: 25px;
    margin-top: 50px;">
                
                <h2 class="orange-text">Login</h2>
                <form action="login/login-action.php" method="post">


                    <h3 style="color:red;text-align:center;">
                        <?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                        ?>
                    </h3>

                    <div class="row">
                        <div class="input-field">
                            <input id="student_id" name="student_id" style="color:white" type="text" class="validate">
                            <label class="active" for="username">Student ID</label>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="waves-effect waves-light orange btn" style="margin-left: 0;"><i
                                class="fa fa-sign-in"></i> Log-in
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- End Container -->
</main>
<br>
<br>
<footer class="page-footer orange" style="opacity: .8;">
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
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>

</body>
</html>
