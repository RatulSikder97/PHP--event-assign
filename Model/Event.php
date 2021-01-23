<?php

class Event
{

    public $adminId;
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
        $query = "INSERT INTO 
                    `events`(`admin_id`, `title`,`description`,`image`,`place`,`address`,`date`,`status`) 
                   VALUES 
                    (:adminId, :title, :description, :image, :place, :address, :date, :status)";

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
        $stmt->bindParam(":adminId", $this->adminId);
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

    function getAllEvent($admin_id)
    {

        // query to insert record
        $query = "SELECT 
                       * 
                  FROM 
                       events 
                  where 
                       admin_id = :adminId";

        // prepare query
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":adminId", $admin_id);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    // get single event
    function getEvent($eventId)
    {
        // query to insert record
        $query = "SELECT 
                       * 
                  FROM 
                       events 
                  WHERE 
                       id = :eventId";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind param
        $stmt->bindParam(":eventId", $eventId);
        $stmt->execute();
        return $stmt->fetch();
    }

    //changeEventStatus
    function changeActiveStatus($eventId, $change){
        echo $eventId, $change;
        if($change =='true'){
            $query = "UPDATE
                        events 
                      SET 
                        `status`='active'
                      WHERE 
                        id = :eventId";
        } else if($change =='false'){
            $query = "UPDATE
                            events 
                        SET 
                            `status`='inactive'
                        WHERE 
                            id = :eventId";
        }

        $stmt = $this->conn->prepare($query);

        // bind param
        $stmt->bindParam(":eventId", $eventId);
        $stmt->execute();

    }

    // update event status
    function changeEventStatusByDate()
    {
        // query to insert record
        $queryToActive = "UPDATE 
                            events 
                          SET 
                            `status`='active' 
                          WHERE 
                            Date(date) = Date(Now())";

        $queryToInactive = "UPDATE 
                                events 
                            SET 
                                `status`='inactive' 
                            WHERE 
                                 Date(date) <> Date(Now())";
        // prepare query
        $stmtToInactive = $this->conn->prepare($queryToInactive);
        $stmtToActive = $this->conn->prepare($queryToActive);
        $stmtToActive->execute();
        $stmtToInactive->execute();


        return true;
    }

    // delete event
    function deleteEvent($eventId)
    {
        // query to insert record
        $query = "DELETE FROM 
                        events 
                    WHERE 
                        id = :eventId";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind param
        $stmt->bindParam(":eventId", $eventId);

        // delete image
        $event = $this->getEvent($eventId);
        unlink($event->image);

        $stmt->execute();

        return true;
    }
}
