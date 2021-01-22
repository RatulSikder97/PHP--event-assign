<?php


class Admin
{

    // database connection and table name
    private $conn;

    // admin properties
    public $name;
    public $email;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // signup user
    function register()
    {

        if ($this->isAlreadyExist() || $this->checkNull()) {
            return false;
        }
        // query to insert record
        $query = "INSERT INTO `admins`(`name`, `email`, `password`) VALUES (:name, :email, :password)";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));


        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);


        // execute query
        if ($stmt->execute()) {

            return true;
        }

        return false;
    }
    // login user
    function login()
    {
        // select all query
        $query = "SELECT
                   *
                FROM
                    admins
                WHERE
                    email='" . $this->email . "' AND password='" . $this->password . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $adminInfo = $stmt->fetch();
            print_r( $adminInfo);
            $_SESSION['id'] = $adminInfo->id;
            $_SESSION['name'] = $adminInfo->name;
            
            header('Location: index.php');
          }
          else{
              echo "akdhfjksd";
          }
    }

    // admin logout
    function logout()
    {
      
        session_destroy();
        unset($_SESSION['id']);
        unset($_SESSION['name']);
        return true;
    }

    // Check if the user is already logged in
    public function is_logged_in()
    {
        // Check if user session has been set
        if (isset($_SESSION['name'])) {
            return true;
        }
    }

    // Redirect user
    public function redirect($url)
    {
        header("Location: $url");
    }

    // Check duplicate admin
    function isAlreadyExist()
    {
        $query = "SELECT *
            FROM
                admins
            WHERE
                email ='" . $this->email . "'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // check null
    function checkNull()
    {
        if ($this->name == "" || $this->email == "" || $this->password == "") {
            return true;
        }

        return false;
    }
}
