<?php

class Event
{

    public $title;
    public $description;
    public $image;
    public $place;
    public $address;
    public $date;
    public $status;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create event
    function create()
    {

        // query to insert record
        $query = "INSERT INTO `events`(`title`,`description`,`image`,`place`,`address`,`date`,`status`) VALUES (:title, :description, :image, :place, :address, :date, :status)";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->place = htmlspecialchars(strip_tags($this->place));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->status = htmlspecialchars(strip_tags($this->status));



        // bind values
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":place", $this->place);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":status", $this->status);


        // execute query
        if ($stmt->execute()) {

            return true;
        }

        return false;
    }

    // get all event of certain admin

    function getAllEvent($admin_id = 0)
    {

        // query to insert record
        $query = "SELECT * FROM events";
        // prepare query
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
       
        return $stmt->fetchAll();
    }

    // get single event
    function getEvent($event_id)
    {
        // query to insert record
        $query = "SELECT * FROM events WHERE id = :event_id";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind param
        $stmt->bindParam(":event_id", $event_id);
        $stmt->execute();
        return $stmt->fetch();
    }
}
