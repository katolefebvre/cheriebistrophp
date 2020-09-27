<?php

require_once '../includes/dboperation.php';

$db = new DbOperation();

$response = array();
$response['employees'] = array();

$result = $db->getEmployees();

if ($result == false) {
    $response['error'] = true;
} else {
    foreach ($result as $employee) {
        $temp = array();

        $temp['employeeID'] = $employee['employeeID'];
        $temp['employeeName'] = $employee['employeeName'];
        $temp['roleID'] = $employee['roleID'];
        $temp['roleName'] = $employee['name'];

        array_push($response['employees'], $temp);
    }
}

echo json_encode($response);

mysqli_close($db);

?>