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
$tables = $db->getTablesForUser($employeeID);

if(!empty($userDetails))
{
    $response["status"] = "Success";
    $response["message"] = "User is registered";

    $response['employeeID'] = $userDetails['employeeID'];
    $response['employeeName'] = $userDetails['employeeName'];
    $response['roleID'] = $userDetails['roleID'];
    $response['roleName'] = $userDetails['name'];

    $response['tables'] = array();

    if ($tables != false) {
        foreach ($tables as $table) {
            $temp = array();
            $temp['tableID'] = $table['tableID'];
            array_push($response['tables'], $temp);
        }
    } else {
        array_push($response['tables'], '0');
    }
} else {
    $response["status"] = "error2";
    $response["message"] = "User is not found";
}

echo json_encode($response);

mysqli_close($db);

?>