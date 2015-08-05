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
        <title>Login to SNC Courseware</title>
    </head>
    <body class="level0">
        <div id="dog_tag">

    <p><a href="index.html"><img src="http://www.araldito.com/wp-content/uploads/2014/06/e2.jpg"
                                             alt="SNC Logo" width="60" height="58">
        <span></span></a></p></div>
<p id="access_nav"><a href="#main_nav">Skip to navigation</a></p>
<article>

    <header>
        <h1>HTML, CSS and JavaScript Tutorials.</h1>

        <p>Welcome to St. Nicolas College E-Learning Site, the web designer’s resource for everything HTML, CSS, and
            JavaScript, the most common
            technologies used in making web pages.</p>
    </header>


    <section id="main_content" style="width:500px;margin: 0 auto;">
        <?php
            include_once 'login/admin-class.php';
            $admin = new itg_admin();
            $admin->_authenticate();
        ?>
        <form action="login/login-action.php" method="post">
                <fieldset>
                    <h1 style="text-align:center">Enter Credential</h1>
                        <h3 style="color:red;text-align:center;">
                            <?php 
                                if (isset($_SESSION['message']))
                                {
                                    echo $_SESSION['message'];
                                    unset($_SESSION['message']);
                                }
                            ?>
                        </h3>
                        <p>
                            <label for="username">Username: </label>
                            <input type="text" name="username" id="username" value="" />
                        </p>
                        <p>
                            <label for="password">Password: </label>
                            <input type="password" name="password" id="password" value="" />
                        </p>
                </fieldset>
                <p>
                    <input type="submit" value="Submit" /> <input type="reset" value="Reset" />
                </p>
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

        <h2>Popular pages</h2>
        <ul>
            <li><a href="view/html/index.html">HTML Tutorial</a>: No idea where to
                start? Try here!
            </li>
            <li><a href="view/css/index.html">CSS Tutorial</a>: So, you can dabble in
                HTML but how do you make it look good?
            </li>
            <li><a href="view/js/index.html">JavaScript Tutorials</a>: Programming?! Orayt! Rock and Roll to the World!</li>
        </ul>

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
