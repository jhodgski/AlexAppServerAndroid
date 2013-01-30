<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require_once 'GCM.php';

	$message = $_POST["message"];

    $regIds = array();
	foreach($_POST['regId'] as $regId) {
		array_push($regIds, $regId);
	}

    $gcm = new GCM();

    $message = array("update" => $message);
    $collapse_key = "Update available";

    $result = $gcm->send_notification($regIds, $message, $collapse_key);

    //echo $result;
}

require_once 'db_functions.php';
$db = new DB_Functions();
$users = $db->getAllUsers();
if ($users != false) {
	$no_of_users = mysql_num_rows($users);
}
else {
	$no_of_users = 0;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Android Push Notification Control Panel</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <script type="text/javascript">

        	var INITIAL_MESSAGE = "Enter message...";

			function validateForm(f) {
				var msg = String.trim(f.message.value);;
				if (msg == INITIAL_MESSAGE || msg == "") {
					alert("Please enter a message");
					return false;
				}
				else {
					return true;
				}
			}
			function clearText(ta) {
				if (ta.value == INITIAL_MESSAGE) {
					ta.value = "";
				}
			}

        </script>
        <style type="text/css">
			input[type="text"] {
				display: block;
				width: 100%;
			}
			input[type="submit"] {
				margin-top: 1em;
				padding: 1em;
				width: 100%;
			}
			table {
				width: 100%;
			}
			table .col1 {

			}
        </style>
    </head>
    <body>
        <div>

<?php
$tableRowsHTML = "";
if ($no_of_users > 0) {
?>

			<h1>Send Message to All <?php echo $no_of_users; ?> Android Devices</h1>
			<form action="index.php" method="post" onsubmit="return validateForm(this);">
<?php
	while ($row = mysql_fetch_array($users)) {
?>
				<input type="hidden" name="regId[]" value="<?php echo $row["gcm_regid"] ?>"/>
<?php
		$tableRowsHTML .= '<tr>';
		$tableRowsHTML .= '    <td class="col1">' . $row["created_at"] . '</td>';
		$tableRowsHTML .= '    <td>' . $row["gcm_regid"] . '</td>';
		$tableRowsHTML .= '</tr>';
	}
?>
				<input type="text" id="message" name="message" value="Enter message..." onclick="clearText(this);" />
				<input type="submit" value="Send to all <?php echo $no_of_users; ?> Android devices" />
			</form>

<?php
}
?>



			<h2>Registered Devices</h2>

<?php
if ($no_of_users > 0) {
?>
			<table>
				<thead>
					<tr>
						<th class="col1">Created At</th>
						<th>GCM Registration ID</th>
					</tr>
				</thead>
				<tbody>

<?php
	echo $tableRowsHTML;
?>
				<tbody>
			</table>
<?php
}
?>
        </div>
    </body>
</html>