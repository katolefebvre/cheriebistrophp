<?php

require_once '../includes/dboperation.php';

$db = new DbOperation();

$response = array();
$response['roles'] = array();

$result = $db->getRoles();

if ($result == false) {
    $response['error'] = true;
} else {
    foreach ($result as $role) {
        $temp = array();

        $temp['roleID'] = $role['id'];
        $temp['roleName'] = $role['name'];

        array_push($response['roles'], $temp);
    }
}

echo json_encode($response);

mysqli_close($db);

?>