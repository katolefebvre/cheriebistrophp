<?php

require_once '../includes/dboperation.php';

$db = new DbOperation();

$response = array();
$response['orders'] = array();

$result = $db->getOrders();

if ($result == false) {
    $response['error'] = true;
} else {
    foreach ($result as $order) {
        $temp = array();

        $temp['order_id'] = $order['order_id'];
        $temp['price_total'] = $order['price_total'];
        $temp['status'] = $order['status'];
        $temp['table_id'] = $order['table_id'];

        array_push($response['orders'], $temp);
    }
}

echo json_encode($response);

mysqli_close($db);

?>