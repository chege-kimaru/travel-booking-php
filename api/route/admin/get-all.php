<?php
/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 12/01/2019
 * Time: 20:36
 */
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');

require_once '../../model/Admin.php';
require_once '../../config/Database.php';

require_once '../../config/constants.php';

try {
    $database = new Database();
    $db = $database->connect();

    $admin = new Admin($db);

    echo json_encode($admin->fetchAllAdmins());
    http_response_code(200);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array("error" => $e->getMessage()));
    throw $e;
}