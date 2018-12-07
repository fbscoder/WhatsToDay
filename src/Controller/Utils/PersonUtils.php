<?php

namespace App\Controller\Utils;

use App\Controller\Utils\Person\PersonData;
use Symfony\Component\HttpFoundation\Response;

class PersonUtils
{
    public static function getPersonData($email)
    {
        $conn = WhatToDayUtilities::getDataBaseConnection();
        $sql = "Select u.id, t.token from users u Join token t on t.u_id = u.id Where u.email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return new PersonData($row["id"], $row["token"]);
            }
        } else {
            echo "0 results";
        }
        $conn->close();

    }

    public static function checkIfRightPerson($email, $password)
    {
        $conn = WhatToDayUtilities::getDataBaseConnection();
        $passwordHash = hash('SHA1', $password);
        $sql = "select u.id, t.token from users u
                JOIN token t ON u.id = t.u_id
            where u.email = '$email' and u.password = '$passwordHash'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return true;
            }
        } else {
            return false;
        }
    }

    public static function checkIfPersonExists()
    {
        $conn = WhatToDayUtilities::getDataBaseConnection();
        $email = "test.test@test.at";
        $sql = "select email from users
            where  email = '$email'";
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

    /**
     * @\Sensio\Bundle\FrameworkExtraBundle\Configuration\Route  ("/changePassword")
     */
    public function changePassword()
    {
        $conn = WhatToDayUtilities::getDataBaseConnection();
        if (isset($_SESSION['PersonData'])) {
            $sql = "select password from users where id =" . $_SESSION['PersonData']->ID;
            $result = $conn->query($sql)->fetch_assoc();
            $oldPasswordHashed = hash('SHA1', $_POST['passwordOld']);
            if ($oldPasswordHashed == $result['password'] && $_POST['passwordNew'] === $_POST['passwordNewRepeat']) {
                $newPasswordHash = hash('SHA1', $_POST['passwordNewRepeat']);
                $sql = $conn->prepare('UPDATE users SET password = ' . "'" . $newPasswordHash . "'" . ' 
                WHERE id =' . $_SESSION['PersonData']->ID);
                $sql->execute();
                return new Response('success');
            } elseif ($oldPasswordHashed != $result['password'] && $_POST['passwordNew'] === $_POST['passwordNewRepeat']) {
                return new Response('oldPasswordWrong');
            } elseif ($oldPasswordHashed == $result['password'] && $_POST['passwordNew'] != $_POST['passwordNewRepeat']) {
                return new Response('passwordNotMatching');
            }
        }

    }
}

