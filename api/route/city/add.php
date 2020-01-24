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

require_once '../../model/City.php';
require_once '../../config/Database.php';

require_once '../../config/constants.php';

try {

    $database = new Database();
    $db = $database->connect();

    $city = new City($db);

    $data = json_decode(file_get_contents("php://input"));

    $city->city = $data->city;

    $city->addCity();

    http_response_code(200);
    echo json_encode(array('data' => 'Successfully added City'));
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array('error' => $e->getMessage()));
    throw $e;
}
