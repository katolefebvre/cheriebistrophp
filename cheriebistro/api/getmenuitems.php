<?php

require_once '../includes/dboperation.php';

$db = new DbOperation();

$response = array();
$response['menu_items'] = array();

$result = $db->getMenuItems();

if ($result == false) {
    $response['error'] = true;
} else {
    foreach ($result as $menuitem) {
        $temp = array();

        $temp['id'] = $menuitem['id'];
        $temp['name'] = $menuitem['name'];
        $temp['description'] = $menuitem['description'];
        $temp['price'] = $menuitem['price'];
        $temp['time_slot_id'] = $menuitem['time_slot_id'];

        array_push($response['menu_items'], $temp);
    }
}

echo json_encode($response);

mysqli_close($db);

?>