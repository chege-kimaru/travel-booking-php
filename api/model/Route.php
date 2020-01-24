<?php
/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 22/02/2019
 * Time: 08:38
 */
require_once 'City.php';

class Route
{
    private $conn;
    private $table = 'routes';

    public $id;
    public $title;
    public $from_id;
    public $to_id;
    public $active;
    public $dateAdded;
    public $lastUpdated;

    public $from;
    public $to;
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
            CREATE TABLE IF NOT EXISTS routes (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(50) NOT NULL UNIQUE,
                from_id INT NOT NULL,
                to_id INT NOT NULL,
                active INT NOT NULL DEFAULT 1,
                dateAdded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                lastUpdated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (from_id) REFERENCES cities(id),
                FOREIGN KEY (to_id) REFERENCES cities(id),
                UNIQUE (from_id, to_id)
            )
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function addRoute()
    {
        try {
            $query = 'INSERT INTO routes
                SET 
                title = :title,
                from_id = :from_id,
                to_id = :to_id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':title', htmlspecialchars(strip_tags($this->title)));
            $stmt->bindParam(':from_id', htmlspecialchars(strip_tags($this->from_id)));
            $stmt->bindParam(':to_id', htmlspecialchars(strip_tags($this->to_id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function editRoute()
    {
        try {
            $query = 'UPDATE routes
                SET 
                title = :title,
                from_id = :from_id,
                to_id = :to_id
                WHERE
                id = :id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->bindParam(':title', htmlspecialchars(strip_tags($this->title)));
            $stmt->bindParam(':from_id', htmlspecialchars(strip_tags($this->from_id)));
            $stmt->bindParam(':to_id', htmlspecialchars(strip_tags($this->to_id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteRoute()
    {
        try {
            $query = 'DELETE FROM routes WHERE id=:id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getRoutes()
    {
        try {
            $query = 'SELECT * FROM routes';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getSingleRoute()
    {
        try {
            $query = 'SELECT * FROM routes WHERE id=:id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }


    //++++++++++++++++++++++++++++++++++++++++++
    public function setRoute()
    {
        try {
            $route = $this->getSingleRoute();

            $from = new City($this->conn);
            $from->id = $route['from_id'];
            $this->from = $from->fetchSingleCity();

            $to = new City($this->conn);
            $to->id = $route['to_id'];
            $this->to = $to->fetchSingleCity();

            $this->id = $route['id'];
            $this->title = $route['title'];
            $this->from_id = $route['from_id'];
            $this->to_id = $route['to_id'];
            $this->active = $route['active'];
            $this->dateAdded = $route['dateAdded'];
            $this->lastUpdated = $route['lastUpdated'];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function fetchSingleRoute()
    {
        try {
            $route = $this->getSingleRoute();

            $from = new City($this->conn);
            $from->id = $route['from_id'];

            $to = new City($this->conn);
            $to->id = $route['to_id'];

            return array(
                'id' => $route['id'],
                'title' => $route['title'],
                'from_id' => $route['from_id'],
                'to_id' => $route['to_id'],
                'from' => $from->fetchSingleCity(),
                'to' => $to->fetchSingleCity(),
                'active' => $route['active'],
                'dateAdded' => $route['dateAdded'],
                'lastUpdated' => $route['lastUpdated']
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function fetchAllRoutes()
    {
        try {
            $routes = array();
            foreach ($this->getRoutes() as $route) {
                $from = new City($this->conn);
                $from->id = $route['from_id'];

                $to = new City($this->conn);
                $to->id = $route['to_id'];

                array_push($routes, array(
                    'id' => $route['id'],
                    'title' => $route['title'],
                    'from_id' => $route['from_id'],
                    'to_id' => $route['to_id'],
                    'from' => $from->fetchSingleCity(),
                    'to' => $to->fetchSingleCity(),
                    'active' => $route['active'],
                    'dateAdded' => $route['dateAdded'],
                    'lastUpdated' => $route['lastUpdated'],
                ));
            }
            return $routes;
        } catch (Exception $e) {
            throw $e;
        }
    }

}