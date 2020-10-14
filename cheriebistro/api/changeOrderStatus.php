<?php

require_once '../includes/dboperation.php';

$response = array();

$orderID = $_POST['orderID'];
$status = $_POST['status'];

$db = new DbOperation();
$result = $db->changeOrderStatus((int)$orderID, $status);

if ($result == ORDER_STATUS_CHANGED) {
    $response['error'] = "false";
    $response['message'] = "Order status changed.";
} elseif ($result == ORDER_STATUS_NOT_CHANGED) {
    $response['error'] = "true";
    $response['message'] = "Order status change failed.";
}

echo json_encode($response);

mysqli_close($db);

?>