<?php

require_once '../includes/dboperation.php';

$response = array();
$response['tableUpdate'] = 0;

$tableID = $_POST['tableID'];

$db = new DbOperation();

$result = $db->unassignTable($tableID);

if ($result == 1) {
    $response['tableUpdate'] = 1;
} else {
    $response['tableUpdate'] = 0;
}

echo json_encode($response);

mysqli_close($db);

?>