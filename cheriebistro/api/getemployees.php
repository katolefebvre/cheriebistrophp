<?php

require_once '../includes/dboperation.php';

$db = new DbOperation();

$response = array();
$response['employees'] = array();

$result = $db->getEmployees();

if ($result == false) {
    $response['error'] = true;
} else {
    foreach ($result as $menuitem) {
        $temp = array();

        $temp['employeeID'] = $menuitem['employeeID'];
        $temp['employeeName'] = $menuitem['employeeName'];
        $temp['roleID'] = $menuitem['roleID'];

        array_push($response['employees'], $temp);
    }
}

echo json_encode($response);

mysqli_close($db);

?>