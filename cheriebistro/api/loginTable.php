<?php

require_once '../includes/dboperation.php';

$response = array();

$tableID = $_POST['tableID'];
$employeeID = $_POST['employeeID'];

$db = new DbOperation();


if(empty($tableID) || empty($employeeID))
{
    $response["status"] = "error1";
    $response["message"] = "Missing required field";
    echo json_encode($response);
    return;
}

$tableDetails = $db->getTableDetails($tableID, $employeeID);

if($tableDetails == TABLE_ASSIGNED)
{
    $response["status"] = "Success";
    $response["message"] = "Table is registered.";

} elseif ($tableDetails == EMPLOYEE_INVALID) {
    $response["status"] = "error2";
    $response["message"] = "Employee ID is invalid.";
} else {
    $response["status"] = "error3";
    $response["message"] = "Table is not available.";
}

echo json_encode($response);

mysqli_close($db);

?>