
<?php

class User {
    protected $Customer_ID;
    protected $Customer_Email;
    protected $Customer_Password;
    protected $Customer_Name;
    protected $Customer_Phone;
    protected $Customer_Address;
    /************************
    /* Constructors
    /******************** */

   function User ($_id, $_email, $_password, $_name , $_phone , &_address) {
        $this->Customer_ID = $_id;
        $this->Customer_Email = $_email;
        $this->Customer_Password = $_password;
        $this->Customer_Name = $_name;
 
    }

    /************************
      /* Setters
      /******************** */

    function setEmail($_email) {
        $this->email = $_email;
    }

    function setPassword($_password) {
        $this->password = $_password;
    }

    function setName($_name) {
        $this->name = $_name;
    }

    /************************
      /* Getters
      /******************** */

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getName() {
        return $this->name;
    }

    function getId() {
        return $this->id;
    }

}
?>
