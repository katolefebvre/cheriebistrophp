<?php

require_once '../includes/dboperation.php';

$response = array();

$name = $_POST['name'];

$db = new DbOperation();
$result = $db->createCategory($name);

if ($result[0] == CATEGORY_CREATED) {
    $addedId = $result[1];

    $response['error'] = "false";
    $response['message'] = 'Category created successfully.';
} elseif ($result[0] == CATEGORY_NOT_CREATED) {
    $response['error'] = "true";
    $response['message'] = $result[1];
}

echo json_encode($response);

mysqli_close($db);

?>