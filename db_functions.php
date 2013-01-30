
<?php

class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        require_once 'db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {

    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($gcm_regid) {
        // insert user into database
        $result = mysql_query("INSERT INTO alex_app_push_android (gcm_regid, created_at) VALUES('$gcm_regid', NOW())");
        // check for successful store
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Getting all users
     */
    public function getAllUsers() {
        $result = mysql_query("select * FROM alex_app_push_android");
        return $result;
    }

}

?>