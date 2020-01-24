<?php
/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 03/12/2018
 * Time: 21:54
 */
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Access-Control-Allow-Origin, Content-Type,
 X-Requested-With, Authorization');

require_once '../../config/Database.php';
require_once '../../model/Passenger.php';

include_once '../../config/constants.php';
require_once '../../vendor/autoload.php';

use \Firebase\JWT\JWT;

try {

    $database = new Database();
    $db = $database->connect();

    $passenger = new Passenger($db);

    $data = json_decode(file_get_contents("php://input"));

    $passenger->email = $data->email;
    $passenger->setPassenger(true);

    if (password_verify($data->password, $passenger->password)) {

        $token = array(
//        "iss" => $iss,
//        "aud" => $aud,
//        "iat" => $iat,
//        "nbf" => $nbf,
            "data" => array(
                "id" => $passenger->id,
                "email" => $passenger->email,
                "name" => $passenger->name
            )
        );

        // set response code
        http_response_code(200);

        // generate jwt
        $jwt = JWT::encode($token, JWT_KEY);
        echo json_encode(
            array(
                "data" => "Successful login.",
                "jwt" => $jwt,
                "name" => $passenger->name,
                "email" => $passenger->email,
                "id" => $passenger->id
            )
        );

    } else {

        // set response code
        http_response_code(401);
        echo json_encode(array("error" => "Login failed."));
    }
}catch(Exception $e) {
    http_response_code(500);
    echo json_encode(array("error" => $e->getMessage()));
    throw $e;
}