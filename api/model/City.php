<?php
/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 22/02/2019
 * Time: 08:38
 */

class City
{
    private $conn;
    private $table = 'cities';

    public $id;
    public $city;
    public $active;
    public $dateAdded;
    public $lastUpdated;

    /**
     * City constructor.
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS cities (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                city VARCHAR(50) NOT NULL UNIQUE,
                active INT NOT NULL DEFAULT 1,
                dateAdded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                lastUpdated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function addCity()
    {
        try {
            $query = 'INSERT INTO cities
                SET 
                city = :city
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':city', htmlspecialchars(strip_tags($this->city)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function editCity()
    {
        try {
            $query = 'UPDATE cities
                SET 
                city = :city
                WHERE
                id = :id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->bindParam(':city', htmlspecialchars(strip_tags($this->city)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteCity()
    {
        try {
            $query = 'DELETE FROM cities WHERE id=:id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getCities()
    {
        try {
            $query = 'SELECT * FROM cities';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getSingleCity()
    {
        try {
            $query = 'SELECT * FROM cities WHERE id=:id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }


    //++++++++++++++++++++++++++++++++++++++++++
    public function setCity()
    {
        try {
            $city = $this->getSingleCity();
            $this->id = $city['id'];
            $this->city = $city['city'];
            $this->active = $city['active'];
            $this->dateAdded = $city['dateAdded'];
            $this->lastUpdated = $city['lastUpdated'];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function fetchSingleCity()
    {
        try {
            $city = $this->getSingleCity();
            return array(
                'id' => $city['id'],
                'city' => $city['city'],
                'active' => $city['active'],
                'dateAdded' => $city['dateAdded'],
                'lastUpdated' => $city['lastUpdated']
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function fetchAllCities()
    {
        try {
            $cities = array();
            foreach ($this->getCities() as $city) {
                array_push($cities, array(
                    'id' => $city['id'],
                    'city' => $city['city'],
                    'active' => $city['active'],
                    'dateAdded' => $city['dateAdded'],
                    'lastUpdated' => $city['lastUpdated']
                ));
            }
            return $cities;
        } catch (Exception $e) {
            throw $e;
        }
    }

}