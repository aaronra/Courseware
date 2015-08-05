<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Login to admin</title>
    </head>
    <body>
        <?php
            include_once 'admin-class.php';
            $admin = new itg_admin();
            $admin->_authenticate();
        ?>
        <form action="login-action.php" method="post">
            <fieldset>
                <legend>Enter Credential</legend>
                    
                        <?php 
                            if (isset($_SESSION['message']))
                            {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            }
                        ?>
                    
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
    </body>
</html>
