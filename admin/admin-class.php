<?php
/** Include the database file */
include_once '../db/db.php';
/**
 * The main class of login
 * All the necesary system functions are prefixed with _
 * examples, _login_action - to be used in the login-action.php file
 * _authenticate - to be used in every file where admin restriction is to be inherited etc...
 * @author Swashata <swashata@intechgrity.com>
 */
class itg_admin {

    /**
     * Holds the script directory absolute path
     * @staticvar
     */
    static $abs_path;

    /**
     * Store the sanitized and slash escaped value of post variables
     * @var array
     */
    var $post = array();

    /**
     * Stores the sanitized and decoded value of get variables
     * @var array
     */
    var $get = array();

    /**
     * The constructor function of admin class
     * We do just the session start
     * It is necessary to start the session before actually storing any value
     * to the super global $_SESSION variable
     */
    public function __construct() {
        //store the absolute script directory
        //note that this is not the admin directory
        self::$abs_path = dirname(dirname(__FILE__));

        //initialize the post variable
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->post = $_POST;
            if(get_magic_quotes_gpc ()) {
                //get rid of magic quotes and slashes if present
                array_walk_recursive($this->post, array($this, 'stripslash_gpc'));
            }
        }

        //initialize the get variable
        $this->get = $_GET;
        //decode the url
        array_walk_recursive($this->get, array($this, 'urldecode'));
    }

    /**
     * Sample function to return the nicename of currently logged in admin
     * @global ezSQL_mysql $db
     * @return string The nice name of the user
     */
    public function get_nicename() {
        $username = $_SESSION['admin_login'];
        global $db;
        $info = $db->get_row("SELECT `nicename` FROM `users` WHERE `username` = '" . $db->escape($username) . "'");
        if(is_object($info))
            return $info->nicename;
        else
            return '';
    }

    /**
     * Sample function to return the email of currently logged in admin user
     * @global ezSQL_mysql $db
     * @return string The email of the user
     */
    public function get_email() {
        $username = $_SESSION['admin_login'];
        global $db;
        $info = $db->get_row("SELECT `email` FROM `users` WHERE `username` = '" . $db->escape($username) . "'");
        if(is_object($info))
            return $info->email;
        else
            return '';
    }

    /**
     * Checks whether the user is authenticated
     * to access the admin page or not.
     *
     * Redirects to the login.php page, if not authenticates
     * otherwise continues to the page
     *
     * @access public
     * @return void
     */
    public function _authenticate() {
        //first check whether session is set or not
        if(!isset($_SESSION['admin_login'])) {
            //check the cookie
            
            if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
                //cookie found, is it really someone from the
                if($this->_check_db($_COOKIE['username'], $_COOKIE['password'])) {
                    //echo '1';die;
                    $_SESSION['admin_login'] = $_COOKIE['username'];
                    // header("location: index.php");
                    // die();
                }
                // else {
                //     header("location: login.php");
                //     die();
                // }
            }
            // else {
            //     header("location: login.php");
            //     die();
            // }
            //$_SESSION['admin_login'] = 'fdas';
        }
    }

    public function courses() {
        global $db;
        $courses = $db->get_results("SELECT * FROM `content` LEFT JOIN `links` ON content.link_id = links.id");
        //$data = json_decode($courses, true);
        $_SESSION['courses'] = $courses;
        // foreach ($courses as $key => $object) {
        //     echo $object->content;
        // }
        // echo "<pre>";
        // print_r($courses);
        // die;
    }   

    /**
     * Check for login in the action file
     */
    // public function _login_action() {

    //     //insufficient data provided
    //     if(!isset($this->post['username']) || $this->post['username'] == '' || !isset($this->post['password']) || $this->post['password'] == '') {
    //         $_SESSION['message'] = '*Please enter Username or Password';
    //         header ("location: login.php");
    //         die;
    //     }

    //     //get the username and password
    //     $username = $this->post['username'];
    //     $password = md5(sha1($this->post['password']));
    //     // print_r($password);
    //     // die;
    //     //check the database for username
    //     if($this->_check_db($username, $password)) {
    //         //ready to login
    //         $_SESSION['admin_login'] = $username;

    //             setcookie("username", $username);
    //             setcookie('password', $password);
    //         // echo $_COOKIE['username'];
    //         // die;

    //         header("location: index.php");
    //     }
    //     else {
    //         $_SESSION['message'] = '*Incorrect Username or Password please try again.';
    //         header ("location: login.php");
    //     }

    //     die();
    // }
    public function _login_action() {

        //insufficient data provided
        if(!isset($this->post['username']) || $this->post['username'] == '' || !isset($this->post['password']) || $this->post['password'] == '') {
            $_SESSION['message'] = '*Please enter Username or Password';
            header ("location: login.php");
            die;
        }

        //get the username and password
        $username = $this->post['username'];
        $password = md5(sha1($this->post['password']));
        // print_r($password);
        // die;
        //check the database for username
        if($this->_check_db($username, $password)) {
            //ready to login
            $_SESSION['admin_login'] = $username;

                setcookie("username", $username);
                setcookie('password', $password);
            // echo $_COOKIE['username'];
            // die;

            header("location: index.php");
        }
        else {
            $_SESSION['message'] = '*Incorrect Username or Password please try again.';
            header ("location: login.php");
        }

        die();
    }



    /**
     * Check the database for login user
     * Get the password for the user
     * compare md5 hash over sha1
     * @param string $username Raw username
     * @param string $password expected to be md5 over sha1
     * @return bool TRUE on success FALSE otherwise
     */
    private function _check_db($username, $password) {
        global $db;
        $user_row = $db->get_row("SELECT * FROM `users` WHERE `username`='" . $db->escape($username) . "'");
        //general return

        if(is_object($user_row) && $user_row->role == "admin"){
            if(is_object($user_row) && $user_row->password == $password){
                return true;
            } else { 
                return false;
            }
        } else {
            $_SESSION['message'] = '*Only Admin my enter.';
            header ("location: login.php");
            die;
        }

        // if(is_object($user_row) && $user_row->password == $password){
        //     return true;
        // } else { 
        //     return false;
        // }
    }

    /**
     * stripslash gpc
     * Strip the slashes from a string added by the magic quote gpc thingy
     * @access protected
     * @param string $value
     */
    private function stripslash_gpc(&$value) {
        $value = stripslashes($value);
    }

    /**
     * htmlspecialcarfy
     * Encodes string's special html characters
     * @access protected
     * @param string $value
     */
    private function htmlspecialcarfy(&$value) {
        $value = htmlspecialchars($value);
    }

    /**
     * URL Decode
     * Decodes a URL Encoded string
     * @access protected
     * @param string $value
     */
    protected function urldecode(&$value) {
        $value = urldecode($value);
    }
}
