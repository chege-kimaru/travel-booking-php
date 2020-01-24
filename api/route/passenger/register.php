<?php
/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 23/11/2018
 * Time: 10:22
 */
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Access-Control-Allow-Origin, Content-Type, X-Requested-With, Authorization');

require_once '../../model/Passenger.php';
require_once '../../config/Database.php';

require_once '../../config/constants.php';

try {

    $database = new Database();
    $db = $database->connect();

    $passenger = new Passenger($db);

    $data = json_decode(file_get_contents("php://input"));

    if($data->password != $data->password_confirm) {
        http_response_code(400);
        echo json_encode(array('error' => 'Passwords do not match'));
        exit;
    }

    $passenger->name = $data->name;
    $passenger->email = $data->email;
    $passenger->phone = $data->phone;
    $passenger->password = $data->password;

    $passenger->register();

    http_response_code(200);
    echo json_encode(array('data' => 'Successfully Registered'));
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array('error' => $e->getMessage()));
    throw $e;
}
