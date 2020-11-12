<?php

require_once '../includes/dboperation.php';

$response = array();

$order_id = $_POST['order_id'];
$table_id = $_POST['table_id'];
$price_total = $_POST['price_total'];
$status = $_POST['status'];

$db = new DbOperation();
$result = $db->editOrder($order_id, $table_id, $price_total, $status);

if ($result != ORDER_NOT_EDITED) {
    $updated = $result;

    $response['error'] = "false";
    $response['message'] = 'Order successfully updated.';
    $response['updated'] = strval($updated);
} elseif ($result == ORDER_NOT_EDITED) {
    $response['error'] = "true";
    $response['message'] = $result;
}

echo json_encode($response);

mysqli_close($db);

?>