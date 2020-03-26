<?php

require_once '../includes/dboperation.php';

$db = new DbOperation();

$response = array();
$response['categories'] = array();

$result = $db->getCategories();

if ($result == false) {
    $response['error'] = true;
} else {
    foreach ($result as $category) {
        $temp = array();

        $temp['id'] = $category['id'];
        $temp['name'] = $category['name'];

        array_push($response['categories'], $temp);
    }
}

echo json_encode($response);

mysqli_close($db);

?>