<?php

require_once '../includes/dboperation.php';

$db = new DbOperation();

$response = array();
$response['time_slots'] = array();

$result = $db->getTimeSlots();

if ($result == false) {
    $response['error'] = true;
} else {
    foreach ($result as $timeslot) {
        $temp = array();

        $temp['id'] = $timeslot['id'];
        $temp['name'] = $timeslot['name'];

        array_push($response['time_slots'], $temp);
    }
}

echo json_encode($response);

mysqli_close($db);

?>