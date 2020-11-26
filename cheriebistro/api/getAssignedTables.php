<?php

require_once '../includes/dboperation.php';

$response = array();
$response['tables'] = array();

$db = new DbOperation();

$result = $db->getAssignedTables();

if ($result == false) {
    $response['error'] = true;
} else {
    foreach ($result as $table) {
        $temp = array();

        $temp['tableID'] = $table['tableID'];
        $temp['employeeID'] = $table['employeeID'];

        array_push($response['tables'], $temp);
    }
}

echo json_encode($response);

mysqli_close($db);

?>