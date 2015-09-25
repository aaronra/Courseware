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
        <li class="logo"><a id="logo-container" href="/courseware/admin/login.php" class="brand-logo">
                <img src="../img/logo.jpg" id="front-page-logo">
            </a></li>
    </ul>
</header>


<main>
    <div class="container">
        <!--  Outer row  -->
        <div class="row">

            <div class="col s12">

                <!-- Modal Trigger --><br><br>

                <h2 class="header orange-text">Admin Credential</h2>
                <?php
                include_once 'admin-class.php';
                $admin = new itg_admin();
                $admin->_authenticate();
                ?>
                <form action="login-action.php" method="post">

                    <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    ?>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="username" name="username" type="text" class="validate">
                            <label for="username">Username</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" name="password" type="password" class="validate">
                            <label for="password">Password</label>
                        </div>
                    </div>

                    <button type="submit" value="Submit" class="waves-effect waves-light orange btn"><i
                            class="fa fa-sign-in"></i> Log-in
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
<br>
<footer class="page-footer" style="background-color:transparent">
    <div class="footer-copyright orange">
        <div class="container">
            © <a class="orange-text text-lighten-3" href="">St. Nicolas College</a>, All rights reserved.
        </div>
    </div>
</footer>


<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/init.js"></script>

</body>
</html>

