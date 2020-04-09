<?php

require_once '../includes/dboperation.php';

$response = array();

$employeeID = $_POST['employeeID'];
$employeeName = $_POST['employeeName'];

$db = new DbOperation();


if(empty($employeeID))
{
    $response["status"] = "error1";
    $response["message"] = "Missing required field";
    echo json_encode($response);
    return;
}

$userDetails = $db->getUserDetailsWithPassword($employeeID);

if(!empty($userDetails))
{
    $response["status"] = "Success";
    $response["message"] = "User is registered";

    $response['employeeID'] = $userDetails['employeeID'];
    $response['employeeName'] = $userDetails['employeeName'];

} else {

    $response["status"] = "error2";
    $response["message"] = "User is not found";
}

echo json_encode($response);

mysqli_close($db);

?>