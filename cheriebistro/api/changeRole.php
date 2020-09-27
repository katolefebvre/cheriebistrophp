<?php

require_once '../includes/dboperation.php';

$response = array();

$employeeID = $_POST['employeeID'];
$roleID = $_POST['roleID'];

$db = new DbOperation();
$result = $db->changeRole((int)$employeeID, (int)$roleID);

if ($result == ROLE_CHANGED) {
    $response['error'] = "false";
    $response['message'] = "Role was changed";
} elseif ($result == ROLE_NOT_CHANGED) {
    $response['error'] = "true";
    $response['message'] = "Role was not changed";
}

echo json_encode($response);

mysqli_close($db);

?>