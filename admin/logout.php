<?php
/**
 * The logout file
 * destroys the session
 * expires the cookie
 * redirects to login.php
 */
session_start();
session_destroy();
setcookie('username', '');
setcookie('password', '');
header("location: login.php");
?>