<?php

require_once '../includes/dboperation.php';

$response = array();

$name = $_POST['name'];
$description = $_POST['description'];
$time_slot_id = $_POST['time_slot_id'];
$price = $_POST['price'];
$category_ids = $_POST['category_ids'];

$db = new DbOperation();
$result = $db->createMenuItem($name, $description, $time_slot_id, $price);

if ($result != MENU_ITEM_NOT_CREATED) {
    $addedId = $result;
    $individual_category_ids = explode(",", $category_ids);
    foreach ($individual_category_ids as $category_id) {
        $connectionResult = $db->createMenuItemCategoryConnection((int)$addedId, (int)$category_id);
        if ($connectionResult == MENU_ITEM_CATEGORY_NOT_CONNECTED) {
            // TODO: How to account for error in linking?
        }
    }

    $response['error'] = "false";
    $response['message'] = 'Menu item created successfully.';
} elseif ($result == MENU_ITEM_NOT_CREATED) {
    $response['error'] = "true";
    $response['message'] = 'An error occurred.';
}

echo json_encode($response);

mysqli_close($db);

?>