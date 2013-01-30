
<?php

// response json
$json = array();

/**
 * Registering a user device
 * Store reg id in users table
 */
if (isset($_POST["regId"])) {
    $gcm_regid = $_POST["regId"]; // GCM Registration ID
    // Store user details in db
    require_once 'db_functions.php';
    require_once 'GCM.php';

    $db = new DB_Functions();
    $gcm = new GCM();

    $res = $db->storeUser($gcm_regid);

    $registration_ids = array($gcm_regid);
    //$message = array("product" => "shirt");
    $message = array("thanks" => "You will receive notifications like this when there is an update to the Alex App.");
    $collapse_key = "Thank you";

    $result = $gcm->send_notification($registration_ids, $message, $collapse_key);

    echo $result;
} else {
    // user details missing
}
?>