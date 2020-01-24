<?php
/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 22/02/2019
 * Time: 08:38
 */

class Admin
{
    private $conn;
    private $table = 'admins';

    public $id;
    public $username;
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
            CREATE TABLE IF NOT EXISTS admins (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL UNIQUE,
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
            $query = 'INSERT INTO admins
                SET 
                username = :username,
                password = :password
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':username', htmlspecialchars(strip_tags($this->username)));
            $stmt->bindParam(':password', password_hash($this->password, PASSWORD_BCRYPT));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteAdmin()
    {
        try {
            $query = 'DELETE FROM admins WHERE id=:id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAdmins()
    {
        try {
            $query = 'SELECT * FROM admins';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getSingleAdmin()
    {
        try {
            $query = 'SELECT * FROM admins WHERE id=:id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getSingleAdminByUsername()
    {
        try {
            $query = 'SELECT * FROM admins WHERE username=:username';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':username', htmlspecialchars(strip_tags($this->username)));
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function login($password)
    {
        try {
            $sql = "
                SELECT * FROM passengers
                WHERE username = :username
                AND password = :password
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', htmlspecialchars(strip_tags($this->username)));
            $stmt->bindParam(':password', password_verify($password, $this->password));
            $stmt->execute();

            if ($stmt->rowCount() <= 0) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function changePassword()
    {
        try {
            $query = 'UPDATE admins
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
    public function setAdmin($byUsername = false)
    {
        try {
            if ($byUsername)
                $admin = $this->getSingleAdminByUsername();
            else
                $admin = $this->getSingleAdmin();
            $this->id = $admin['id'];
            $this->username = $admin['username'];
            $this->password = $admin['password'];
            $this->active = $admin['active'];
            $this->dateAdded = $admin['dateAdded'];
            $this->lastUpdated = $admin['lastUpdated'];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function fetchSingleAdmin()
    {
        try {
            $passenger = $this->getSingleAdmin();
            return array(
                'id' => $passenger['id'],
                'username' => $passenger['username'],
                'active' => $passenger['active'],
                'dateAdded' => $passenger['dateAdded'],
                'lastUpdated' => $passenger['lastUpdated']
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function fetchAllAdmins()
    {
        try {
            $admins = array();
            foreach ($this->getAdmins() as $admin) {
                array_push($admins, array(
                    'id' => $admin['id'],
                    'username' => $admin['username'],
                    'active' => $admin['active'],
                    'dateAdded' => $admin['dateAdded'],
                    'lastUpdated' => $admin['lastUpdated']
                ));
            }
            return $admins;
        } catch (Exception $e) {
            throw $e;
        }
    }

}