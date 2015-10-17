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
</head>
<body>
<?php
include_once 'admin-class.php';
$admin = new itg_admin();
$admin->_authenticate();
?>

<?php
if (!isset($_SESSION['admin_login'])) { //if login in session is not set
    header("Location: login.php");
}
?>

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
        <li class="logo"><a id="logo-container" href="/admin" class="brand-logo">
                <img src="../img/logo.jpg" id="front-page-logo">
            </a></li>
        <form action="#" id="search">

            <?php if (!isset($_SESSION['admin_login'])) { ?>
                <li><a href="/admin/login.php">LOGIN</a></li>
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
                <h3 style="color:red;text-align:center;">
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    ?>
                </h3>
                <!-- Modal Trigger --><br><br>
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
                            <th>URL Key</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($_SESSION['courses'])): ?>
                            <?php foreach ($_SESSION['courses'] as $key => $object): ?>
                                <tr>

                                    <td> <?php echo $object->name; ?></td>
                                    <td> <?php echo $object->url_content_key; ?></td>
                                    <td> <?php echo $object->description; ?></td>
                                    <td>
                                        <a href="edit_page.php?id=<?php echo $object->id; ?>">Edit</a> &nbsp;
                                        <a href="delete_page.php?id=<?php echo $object->id; ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif;?>
                        </tbody>
                    </table>

                </section>

                <?php
                include_once 'admin-class.php';
                $admin = new itg_admin();
                $admin->_authenticate();
                ?>


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
<script type="text/javascript" charset="utf8" src="../js/dataTable.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#table_id').DataTable();
    });
</script>
</body>
</html>
