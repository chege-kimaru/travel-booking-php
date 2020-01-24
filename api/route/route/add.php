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

require_once '../../model/Route.php';
require_once '../../config/Database.php';

require_once '../../config/constants.php';

try {

    $database = new Database();
    $db = $database->connect();

    $route = new Route($db);

    $data = json_decode(file_get_contents("php://input"));

    $route->title = $data->title;
    $route->from_id = $data->from_id;
    $route->to_id = $data->to_id;

    if($route->from_id == $route->to_id) {
        throw new Exception("A route can only connect two different cities");
    }

    $route->addRoute();

    http_response_code(200);
    echo json_encode(array('data' => 'Successfully added Route'));
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array('error' => $e->getMessage()));
    throw $e;
}
