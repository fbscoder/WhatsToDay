<?php

class Person{
  public $ID;
  public $API_KEY;
  public $TOKEN;

  public function setPersonData($username){
    include '../DataBase/dataBase.php';
    $sql = "Select u.id, ak.api_key, ak.token_key from users u
            Join api_keys ak on ak.id_keys = u.id
            Where u.username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $this->ID = sha1($row["id"]);
          $this->API_KEY = $row["api_key"];
          $this->TOKEN = $row["token_key"];
        }
    } else {
        echo "0 results";
    }
    $conn->close();
  }

  public function checkIfRightPerson($array){
    include '../DataBase/dataBase.php';

  }

  public function checkIfPersonExists(){
    include '../DataBase/dataBase.php';
    $username = "test";
    $email = "test.test@test.at";
    $sql = "select username, email from users
            where username = '$username' or email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        print "ERROR";
        return true;
    } else {
        echo "Success";
        return false;
    }
  }

  public function SavePersonInDataBase($array){
    include '../DataBase/dataBase.php';
    // if ($conn->query($sql) === TRUE) {
    //     echo "New record created successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
  }
}
?>
