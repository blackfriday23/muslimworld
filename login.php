<?php
// response json
$json = array();
$response = array();
/**
 * Registering a user device
 * Store reg id in users table
 */
if (isset($_GET["uniqueid"]) && isset($_GET["password"])) {
    $uniqueid = $_GET["uniqueid"];
    $password = $_GET["password"];


    include_once './db_functions.php';


    $db = new DB_Functions();


    $res = $db->Login($uniqueid, $password);
    $responses = array();
    if ($res == false) {
        $responses["success"] = 0;
    } else {
        $users = mysql_query("SELECT * FROM user WHERE email='$uniqueid' and password='$password'");
        $users_2 = mysql_query("SELECT * FROM user WHERE username='$uniqueid' and password='$password'");
        if ($users != false || $users_2 != false) {
            if ($row = mysql_fetch_array($users)) {
                $user_id = $row["id"];
                $username_to_send = $row["username"];
                $responses = array();
                $responses["success"] = 1;
                $responses["user_id"] = "$user_id";
                $responses["username"] = "$username_to_send";
            }

            if ($row = mysql_fetch_array($users_2)) {
                $user_id = $row["id"];
                $username_to_send = $row["username"];
                $responses = array();
                $responses["success"] = 1;
                $responses["user_id"] = "$user_id";
                $responses["username"] = "$username_to_send";
            }
        } else {

        }
    }
    echo json_encode($responses);
} else {
    // required user details are not received
}
?>