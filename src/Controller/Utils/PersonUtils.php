<?php

namespace App\Controller\Utils;

use App\Controller\Utils\Person\PersonData;

class PersonUtils
{
    public static function getPersonData($emal)
    {
        $conn = WhatToDayUtilities::getDataBaseConnection();
        $sql = "Select u.id, t.token_key from users u Join token t on t.id_keys = u.id Where u.email = '$emal'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                return new PersonData(sha1($row["id"]), $row["token_key"]);
            }
        } else {
            echo "0 results";
        }
        $conn->close();

    }

    public static function checkIfRightPerson($email, $password)
    {
        $conn = WhatToDayUtilities::getDataBaseConnection();
        $passwordHash = hash('SHA1',$password);


        return false;
    }

    public static function checkIfPersonExists()
    {
        $conn = WhatToDayUtilities::getDataBaseConnection();
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

    public static function SavePersonInDataBase($array)
    {
        // if ($conn->query($sql) === TRUE) {
        //     echo "New record created successfully";
        // } else {
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        // }
    }
}

