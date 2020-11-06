<?php

require_once '../includes/dboperation.php';

$response = array();
$response['tables'] = array();

$db = new DbOperation();

$result = $db->getAvailableTables();

if ($result == false) {
    $response['error'] = true;
} else {
    foreach ($result as $table) {
        $temp = array();

        $temp['tableID'] = $table['tableID'];

        array_push($response['tables'], $temp);
    }
}

echo json_encode($response);

mysqli_close($db);

?>