<?php
/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 10/02/2019
 * Time: 11:45
 */
require_once 'Database.php';
require_once '../model/Admin.php';
require_once '../model/Passenger.php';
require_once '../model/City.php';
require_once '../model/Route.php';
require_once '../model/Trip.php';
require_once '../model/Booking.php';
require_once '../model/Bus.php';

$database = new Database();

$db = $database->connect();

$db->beginTransaction();
try {

    $admin = new Admin($db);
    $admin->createTable();

    $passenger = new Passenger($db);
    $passenger->createTable();

    $city = new City($db);
    $city->createTable();

    $route = new Route($db);
    $route->createTable();

    $trip = new Trip($db);
    $trip->createTable();

    $booking = new Booking($db);
    $booking->createTable();

    $bus = new Bus($db);
    $bus->createTable();

    $stmt = $db->prepare('ALTER TABLE trips ADD amount INT NOT NULL DEFAULT 600');
    $stmt->execute();

    $db->commit();

    echo json_encode(array("data"=> "Successfully initialized database."));
} catch (Exception $e) {
    $db->rollBack();
    echo json_encode(array("error"=> $e->getMessage()));
}