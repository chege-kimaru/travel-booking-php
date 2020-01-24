<?php
/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 22/02/2019
 * Time: 08:38
 */

require_once 'Passenger.php';
require_once 'Trip.php';

class Booking
{
    private $conn;
    private $table = 'bookings';

    public $id;
    public $bookingDate;
    public $trip_id;
    public $passenger_id;
    public $passengerCount;
    public $paymentMethod;
    public $status;
    public $dateAdded;
    public $lastUpdated;

    public $trip;
    public $passenger;
    /**
     * Booking constructor.
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS bookings (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                bookingDate DATE NOT NULL,
                trip_id INT NOT NULL,
                passenger_id INT NOT NULL,
                passengerCount INT NOT NULL,
                paymentMethod VARCHAR(50) NOT NULL,
                status VARCHAR(50) NOT NULL DEFAULT 'pending',
                dateAdded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                lastUpdated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (trip_id) REFERENCES trips(id),
                FOREIGN KEY (passenger_id) REFERENCES passengers(id)
            )
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function addBooking()
    {
        try {
            $query = 'INSERT INTO bookings
                SET 
                bookingDate = :bookingDate,
                trip_id = :trip_id,
                passenger_id = :passenger_id,
                passengerCount = :passengerCount,
                paymentMethod = :paymentMethod
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':bookingDate', htmlspecialchars(strip_tags($this->bookingDate)));
            $stmt->bindParam(':trip_id', htmlspecialchars(strip_tags($this->trip_id)));
            $stmt->bindParam(':passenger_id', htmlspecialchars(strip_tags($this->passenger_id)));
            $stmt->bindParam(':passengerCount', htmlspecialchars(strip_tags($this->passengerCount)));
            $stmt->bindParam(':paymentMethod', htmlspecialchars(strip_tags($this->paymentMethod)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function confirmBooking()
    {
        try {
            $query = 'UPDATE bookings
                SET 
                status = "confirmed"
                WHERE
                id = :id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function cancelBooking()
    {
        try {
            $query = 'UPDATE bookings
                SET 
                status = "cancelled"
                WHERE
                id = :id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteBooking()
    {
        try {
            $query = 'DELETE FROM bookings WHERE id=:id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getBookings()
    {
        try {
            $query = 'SELECT * FROM bookings';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getSingleBooking()
    {
        try {
            $query = 'SELECT * FROM bookings WHERE id=:id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }


    //++++++++++++++++++++++++++++++++++++++++++
    public function setBooking()
    {
        try {
            $booking = $this->getSingleBooking();

            $passenger = new Passenger($this->conn);
            $passenger->id = $booking['passenger_id'];

            $trip = new Trip($this->conn);
            $trip->id = $booking['trip_id'];

            $this->id = $booking['id'];
            $this->bookingDate = $booking['bookingDate'];
            $this->trip_id = $booking['trip_id'];
            $this->trip = $trip->fetchSingleTrip();
            $this->passenger_id = $booking['passenger_id'];
            $this->passenger = $passenger->fetchSinglePassenger();
            $this->passengerCount = $booking['passengerCount'];
            $this->paymentMethod = $booking['paymentMethod'];
            $this->status = $booking['status'];
            $this->dateAdded = $booking['dateAdded'];
            $this->lastUpdated = $booking['lastUpdated'];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function fetchSingleBooking()
    {
        try {
            $booking = $this->getSingleBooking();

            $passenger = new Passenger($this->conn);
            $passenger->id = $booking['passenger_id'];

            $trip = new Trip($this->conn);
            $trip->id = $booking['trip_id'];

            return array(
                'id' => $booking['id'],
                'bookingDate' => $booking['bookingDate'],
                'trip_id' => $booking['trip_id'],
                'trip' => $trip->fetchSingleTrip(),
                'passenger_id' => $booking['passenger_id'],
                'passenger' => $passenger->fetchSinglePassenger(),
                'passengerCount' => $booking['passengerCount'],
                'paymentMethod' => $booking['paymentMethod'],
                'status' => $booking['status'],
                'dateAdded' => $booking['dateAdded'],
                'lastUpdated' => $booking['lastUpdated']
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function fetchAllBookings()
    {
        try {
            $bookings = array();
            foreach ($this->getBookings() as $booking) {

                $passenger = new Passenger($this->conn);
                $passenger->id = $booking['passenger_id'];

                $trip = new Trip($this->conn);
                $trip->id = $booking['trip_id'];

                array_push($bookings, array(
                    'id' => $booking['id'],
                    'bookingDate' => $booking['bookingDate'],
                    'trip_id' => $booking['trip_id'],
                    'trip' => $trip->fetchSingleTrip(),
                    'passenger_id' => $booking['passenger_id'],
                    'passenger' => $passenger->fetchSinglePassenger(),
                    'passengerCount' => $booking['passengerCount'],
                    'paymentMethod' => $booking['paymentMethod'],
                    'status' => $booking['status'],
                    'dateAdded' => $booking['dateAdded'],
                    'lastUpdated' => $booking['lastUpdated']
                ));
            }
            return $bookings;
        } catch (Exception $e) {
            throw $e;
        }
    }

}