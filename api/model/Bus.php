<?php
/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 22/02/2019
 * Time: 08:38
 */

class Bus
{
    private $conn;
    private $table = 'buses';

    public $id;
    public $title;
    public $numPlate;
    public $seatsNum;
    public $active;
    public $dateAdded;
    public $lastUpdated;

    /**
     * Bus constructor.
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS buses (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(50) NOT NULL UNIQUE,
                numPlate VARCHAR(50) NOT NULL UNIQUE,
                seatsNum INT NOT NULL,
                active INT NOT NULL DEFAULT 1,
                dateAdded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                lastUpdated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function addBus()
    {
        try {
            $query = 'INSERT INTO buses
                SET 
                title = :title,
                numPlate = :numPlate,
                seatsNum = :seatsNum
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':title', htmlspecialchars(strip_tags($this->title)));
            $stmt->bindParam(':numPlate', htmlspecialchars(strip_tags($this->numPlate)));
            $stmt->bindParam(':seatsNum', htmlspecialchars(strip_tags($this->seatsNum)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function editBus()
    {
        try {
            $query = 'UPDATE buses
                SET 
                title = :title,
                numPlate = :numPlate,
                seatsNum = :seatsNum
                WHERE
                id = :id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->bindParam(':title', htmlspecialchars(strip_tags($this->title)));
            $stmt->bindParam(':numPlate', htmlspecialchars(strip_tags($this->numPlate)));
            $stmt->bindParam(':seatsNum', htmlspecialchars(strip_tags($this->seatsNum)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteBus()
    {
        try {
            $query = 'DELETE FROM buses WHERE id=:id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getBuses()
    {
        try {
            $query = 'SELECT * FROM buses';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getSingleBus()
    {
        try {
            $query = 'SELECT * FROM buses WHERE id=:id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }


    //++++++++++++++++++++++++++++++++++++++++++
    public function setBus()
    {
        try {
            $bus = $this->getSingleBus();
            $this->id = $bus['id'];
            $this->title = $bus['title'];
            $this->numPlate = $bus['numPlate'];
            $this->seatsNum = $bus['seatsNum'];
            $this->active = $bus['active'];
            $this->dateAdded = $bus['dateAdded'];
            $this->lastUpdated = $bus['lastUpdated'];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function fetchSingleBus()
    {
        try {
            $bus = $this->getSingleBus();
            return array(
                'id' => $bus['id'],
                'title' => $bus['title'],
                'numPlate' => $bus['numPlate'],
                'seatsNum' => $bus['seatsNum'],
                'active' => $bus['active'],
                'dateAdded' => $bus['dateAdded'],
                'lastUpdated' => $bus['lastUpdated']
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function fetchAllBuses()
    {
        try {
            $buses = array();
            foreach ($this->getBuses() as $bus) {
                array_push($buses, array(
                    'id' => $bus['id'],
                    'title' => $bus['title'],
                    'numPlate' => $bus['numPlate'],
                    'seatsNum' => $bus['seatsNum'],
                    'active' => $bus['active'],
                    'dateAdded' => $bus['dateAdded'],
                    'lastUpdated' => $bus['lastUpdated']
                ));
            }
            return $buses;
        } catch (Exception $e) {
            throw $e;
        }
    }

}