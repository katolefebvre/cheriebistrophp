<?php

require_once '../includes/dboperation.php';

$db = new DbOperation();

$response = array();
$response['orderDetails'] = array();

$orderID = $_POST['order_id'];

if(empty($orderID))
{
    $response["status"] = "error1";
    $response["message"] = "Missing required field";
    echo json_encode($response);
    return;
}

$result = $db->getOrderDetails($orderID);

if ($result == false) {
    $response['error'] = true;
} else {
    foreach ($result as $orderItem) {
        $temp = array();
        $temp['order_id'] = $orderItem['order_id'];
        $temp['menu_item_id'] = $orderItem['menu_item_id'];
        $temp['quantity'] = $orderItem['quantity'];
        $temp['item_modification'] = $orderItem['item_modification'];
        $temp['menu_item'] = $db->getMenuItem($orderItem['menu_item_id']);
        array_push($response['orderDetails'], $temp);
    }
}

echo json_encode($response);

mysqli_close($db);

?>