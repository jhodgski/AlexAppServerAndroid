
<?php
if (isset($_GET["regId"]) && isset($_GET["message"])) {
    $regId = $_GET["regId"];
    $message = $_GET["message"];

    require_once 'GCM.php';

    $gcm = new GCM();

    $registration_ids = array($regId);
    //$message = array("price" => $message);
    $message = array("update" => $message);
    $collapse_key = "Update available";

    $result = $gcm->send_notification($registration_ids, $message, $collapse_key);

    echo $result;
}
?>