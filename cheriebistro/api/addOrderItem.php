<?php

require_once '../includes/dboperation.php';

$response = array();

$menu_item_id = $_POST['menu_item_id'];
$item_modification = $_POST['item_modification'];
$quantity = $_POST['quantity'];
$order_id = $_POST['order_id'];


$db = new DbOperation();
$result = $db->createOrderItem($menu_item_id, $item_modification, $quantity, $order_id);

if ($result != ORDER_ITEM_NOT_CREATED) {
    $addedId = $result;
    

    $response['error'] = "false";
    $response['message'] = 'Item added successfully.';
} elseif ($result == ORDER_ITEM_NOT_CREATED) {
    $response['error'] = "true";
    $response['message'] = 'An error occurred.';
}

echo json_encode($response);

mysqli_close($db);

?>