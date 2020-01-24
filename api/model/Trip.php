<?php
/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 22/02/2019
 * Time: 08:38
 */

require_once 'Route.php';
require_once 'Bus.php';

class Trip
{
    private $conn;
    private $table = 'trips';

    public $id;
    public $route_id;
    public $bus_id;
    public $deptTime;
    public $arrivalTime;
    public $amount;
    public $active;
    public $dateAdded;
    public $lastUpdated;

    public $route;
    public $bus;

    /**
     * Trip constructor.
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS trips (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                route_id INT NOT NULL,
                bus_id INT NOT NULL,
                deptTime TIME NOT NULL,
                arrivalTime TIME NOT NULL,
                amount INT NOT NULL,
                active INT NOT NULL DEFAULT 1,
                dateAdded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                lastUpdated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (route_id) REFERENCES routes(id),
                FOREIGN KEY (bus_id) REFERENCES buses(id)
            )
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function addTrip()
    {
        try {
            $query = 'INSERT INTO trips
                SET 
                route_id = :route_id,
                bus_id = :bus_id,
                deptTime = :deptTime,
                arrivalTime = :arrivalTime,
                amount = :amount
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':route_id', htmlspecialchars(strip_tags($this->route_id)));
            $stmt->bindParam(':bus_id', htmlspecialchars(strip_tags($this->bus_id)));
            $stmt->bindParam(':deptTime', htmlspecialchars(strip_tags($this->deptTime)));
            $stmt->bindParam(':arrivalTime', htmlspecialchars(strip_tags($this->arrivalTime)));
            $stmt->bindParam(':amount', htmlspecialchars(strip_tags($this->amount)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function editTrip()
    {
        try {
            $query = 'UPDATE trips
                SET 
                route_id = :route_id,
                bus_id = :bus_id,
                deptTime = :deptTime,
                arrivalTime = :arrivalTime,
                amount = :amount
                WHERE
                id = :id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->bindParam(':route_id', htmlspecialchars(strip_tags($this->route_id)));
            $stmt->bindParam(':bus_id', htmlspecialchars(strip_tags($this->bus_id)));
            $stmt->bindParam(':deptTime', htmlspecialchars(strip_tags($this->deptTime)));
            $stmt->bindParam(':arrivalTime', htmlspecialchars(strip_tags($this->arrivalTime)));
            $stmt->bindParam(':amount', htmlspecialchars(strip_tags($this->amount)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteTrip()
    {
        try {
            $query = 'DELETE FROM trips WHERE id=:id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getTrips()
    {
        try {
            $query = 'SELECT * FROM trips';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getTripsForRoute()
    {
        try {
            $query = 'SELECT * FROM trips WHERE route_id = :route_id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':route_id', htmlspecialchars(strip_tags($this->route_id)));
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getSingleTrip()
    {
        try {
            $query = 'SELECT * FROM trips WHERE id=:id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }


    //++++++++++++++++++++++++++++++++++++++++++
    public function setTrip()
    {
        try {
            $trip = $this->getSingleTrip();

            $route = new Route($this->conn);
            $route->id = $trip['route_id'];

            $bus = new Bus($this->conn);
            $bus->id = $trip['bus_id'];

            $this->id = $trip['id'];
            $this->route_id = $trip['route_id'];
            $this->route = $route->fetchSingleRoute();
            $this->bus_id = $trip['bus_id'];
            $this->bus = $bus->fetchSingleBus();
            $this->deptTime = $trip['deptTime'];
            $this->arrivalTime = $trip['arrivalTime'];
            $this->amount = $trip['amount'];
            $this->active = $trip['active'];
            $this->dateAdded = $trip['dateAdded'];
            $this->lastUpdated = $trip['lastUpdated'];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function fetchSingleTrip()
    {
        try {
            $trip = $this->getSingleTrip();

            $route = new Route($this->conn);
            $route->id = $trip['route_id'];

            $bus = new Bus($this->conn);
            $bus->id = $trip['bus_id'];

            return array(
                'id' => $trip['id'],
                'route_id' => $trip['route_id'],
                'route' => $route->fetchSingleRoute(),
                'bus_id' => $trip['bus_id'],
                'bus' => $bus->fetchSingleBus(),
                'deptTime' => $trip['deptTime'],
                'arrivalTime' => $trip['arrivalTime'],
                'amount' => $trip['amount'],
                'active' => $trip['active'],
                'dateAdded' => $trip['dateAdded'],
                'lastUpdated' => $trip['lastUpdated']
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function fetchAllTrips($forRoute = false)
    {
        try {
            if ($forRoute)
                $d_trips = $this->getTripsForRoute();
            else
                $d_trips = $this->getTrips();

            $trips = array();
            foreach ($d_trips as $trip) {
                $route = new Route($this->conn);
                $route->id = $trip['route_id'];

                $bus = new Bus($this->conn);
                $bus->id = $trip['bus_id'];

                array_push($trips, array(
                    'id' => $trip['id'],
                    'route_id' => $trip['route_id'],
                    'route' => $route->fetchSingleRoute(),
                    'bus_id' => $trip['bus_id'],
                    'bus' => $bus->fetchSingleBus(),
                    'deptTime' => $trip['deptTime'],
                    'arrivalTime' => $trip['arrivalTime'],
                    'amount' => $trip['amount'],
                    'active' => $trip['active'],
                    'dateAdded' => $trip['dateAdded'],
                    'lastUpdated' => $trip['lastUpdated']
                ));
            }
            return $trips;
        } catch (Exception $e) {
            throw $e;
        }
    }

}