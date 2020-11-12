<?php

require_once '../includes/dboperation.php';

$response = array();

$order_id = $_POST['order_id'];
$menu_item_id = $_POST['menu_item_id'];
$item_modification = $_POST['item_modification'];
$quantity = $_POST['quantity'];
$delete = $_POST['delete'];

$db = new DbOperation();
$result = $db->editOrderItem($order_id, $menu_item_id, $item_modification, $quantity, $delete);

if ($result != ORDER_ITEM_NOT_EDITED && $result != ORDER_ITEM_NOT_DELETED) {
    $updated = $result;

    $response['error'] = "false";
    $response['message'] = 'Order item successfully updated.';
    $response['updated'] = strval($updated);
} else {
    $response['error'] = "true";
    $response['message'] = $result;
}

echo json_encode($response);

mysqli_close($db);

?>