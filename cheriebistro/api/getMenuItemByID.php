<?php

require_once '../includes/dboperation.php';

$db = new DbOperation();

$response = array();
$response['orderDetails'] = array();

$itemID = $_POST['item_id'];

if(empty($itemID))
{
    $response["status"] = "error1";
    $response["message"] = "Missing required field";
    echo json_encode($response);
    return;
}

$result = $db->getMenuItem($itemID);

if ($result == false) {
    $response['error'] = true;
} else {
    foreach ($result as $orderItem) {
        $temp = array();

        $temp['id'] = $orderItem['id'];
        $temp['name'] = $orderItem['name'];
        $temp['price'] = $orderItem['price'];
        $temp['time_slot_id'] = $orderItem['time_slot_id'];

        array_push($response['orderDetails'], $temp);
    }
}

echo json_encode($response);

mysqli_close($db);

?>