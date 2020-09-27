<?php

require_once '../includes/dboperation.php';

$response = array();

$tableID    = $_POST['tableID'];

$db = new DbOperation();


if(empty($tableID))
{
    $response["status"] = "error1";
    $response["message"] = "Missing required field";
    echo json_encode($response);
    return;
}

$tableDetails = $db->getTableDetails($tableID);

if(!empty($userDetails))
{
    $response["status"]     = "Success";
    $response["message"]    = "User is registered";
    $response['tableID']    = $userDetails['tableID'];
    $response['tableName']  = $userDetails['tableName'];

} else {
    $response["status"]     = "error2 " . $userDetails;
    $response["message"]    = "User is not found";
}

echo json_encode($response);

mysqli_close($db);

?>