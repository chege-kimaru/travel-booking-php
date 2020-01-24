<?php
/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 22/02/2019
 * Time: 08:38
 */

class Passenger
{
    private $conn;
    private $table = 'admins';

    public $id;
    public $name;
    public $phone;
    public $email;
    public $password;
    public $active;
    public $dateAdded;
    public $lastUpdated;

    /**
     * Passenger constructor.
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS passengers (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                email VARCHAR(50) NOT NULL UNIQUE,
                phone VARCHAR(10) NOT NULL,
                password VARCHAR(255) NOT NULL,
                active INT NOT NULL DEFAULT 1,
                dateAdded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                lastUpdated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function register()
    {
        try {
            $query = 'INSERT INTO passengers
                SET 
                name = :name,
                email = :email,
                phone = :phone,
                password = :password
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':name', htmlspecialchars(strip_tags($this->name)));
            $stmt->bindParam(':email', htmlspecialchars(strip_tags($this->email)));
            $stmt->bindParam(':phone', htmlspecialchars(strip_tags($this->phone)));
            $stmt->bindParam(':password', password_hash($this->password, PASSWORD_BCRYPT));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function editPassenger()
    {
        try {
            $query = 'UPDATE passengers
                SET 
                name = :name,
                phone = :phone
                WHERE
                id = :id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->bindParam(':name', htmlspecialchars(strip_tags($this->name)));
            $stmt->bindParam(':phone', htmlspecialchars(strip_tags($this->phone)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deletePassenger()
    {
        try {
            $query = 'DELETE FROM passengers WHERE id=:id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getPassengers()
    {
        try {
            $query = 'SELECT * FROM passengers';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getSinglePassenger()
    {
        try {
            $query = 'SELECT * FROM passengers WHERE id=:id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getSinglePassengerByEmail()
    {
        try {
            $query = 'SELECT * FROM passengers WHERE email=:email';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', htmlspecialchars(strip_tags($this->email)));
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function changePassword()
    {
        try {
            $query = 'UPDATE passengers
                SET 
                password = :password
                WHERE id = :id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':password', password_hash($this->password, PASSWORD_BCRYPT));
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }


    //++++++++++++++++++++++++++++++++++++++++++
    public function setPassenger($byEmail = false)
    {
        try {
            if ($byEmail)
                $passenger = $this->getSinglePassengerByEmail();
            else
                $passenger = $this->getSinglePassenger();
            $this->id = $passenger['id'];
            $this->name = $passenger['name'];
            $this->phone = $passenger['phone'];
            $this->email = $passenger['email'];
            $this->password = $passenger['password'];
            $this->active = $passenger['active'];
            $this->dateAdded = $passenger['dateAdded'];
            $this->lastUpdated = $passenger['lastUpdated'];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function fetchSinglePassenger()
    {
        try {
            $passenger = $this->getSinglePassenger();
            return array(
                'id' => $passenger['id'],
                'name' => $passenger['name'],
                'phone' => $passenger['phone'],
                'email' => $passenger['email'],
                'active' => $passenger['active'],
                'dateAdded' => $passenger['dateAdded'],
                'lastUpdated' => $passenger['lastUpdated']
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function fetchAllPassengers()
    {
        try {
            $passengers = array();
            foreach ($this->getPassengers() as $passenger) {
                array_push($passengers, array(
                    'id' => $passenger['id'],
                    'name' => $passenger['name'],
                    'phone' => $passenger['phone'],
                    'email' => $passenger['email'],
                    'active' => $passenger['active'],
                    'dateAdded' => $passenger['dateAdded'],
                    'lastUpdated' => $passenger['lastUpdated']
                ));
            }
            return $passengers;
        } catch (Exception $e) {
            throw $e;
        }
    }

}