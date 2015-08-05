<!DOCTYPE html>
<html dir="ltr" lang="en">
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
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
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


    <section id="main_content">
        <?php
            include_once 'admin-class.php';
            $admin = new itg_admin();
            $admin->courses();

            // foreach ($_SESSION['courses'] as $key => $object) {
            //     echo $object->content;
            // }
            // // echo "<pre>";
            // // print_r($courses);
            // die;
        ?>

        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['courses'] as $key => $object): ?>
                <tr>
                    
                        <td> <?php echo $object->title; ?></td>
                        <td> <?php echo $object->content; ?></td>
                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

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

<?php
include_once 'admin-class.php';
$admin = new itg_admin();
$admin->_authenticate();
?>

<nav id="main_nav">
    <?php if(isset($_SESSION['admin_login'])): ?>
    <ul>
        <li id="li_tut"><a href="#">Tutorials</a>
            <ul>
                <li><a href="view/html/index.html">Learn HTML</a></li>
                <li><a href="view/css/index.html">Learn CSS</a></li>
                <li><a href="view/js/index.html">Learn JavaScript</a></li>
            </ul>
        </li>

        <li id="access_top"><a href="#">↑ Top</a></li>
    </ul>
<?php endif;?>
</nav>

<form action="#" id="search">
    <fieldset><!-- <label for="morombe">Search: </label><input name="q" id="morombe"><input type="submit" value="Search"> -->
    <?php if(!isset($_SESSION['admin_login'])){ ?>
        <a class="btn" href="login.php">LOGIN</a>
    <?php } else { ?>
        <a class="btn" href="logout.php">LOGOUT</a>
    <?php } ?>
    </fieldset>
</form>
<footer id="site_footer">
    <p>© St. Nicolas College - 2015.</p>

    <p><a href="#">E-Learning</a>.</p>
</footer>

<!--javascripts-->
<!-- <script src="js/jquery-1.11.3.min.js"></script> -->
<script src="js/main.js"></script>
<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
  
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>

<script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>
</body>
</html>