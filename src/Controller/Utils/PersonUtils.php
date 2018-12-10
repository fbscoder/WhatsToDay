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

    public static function checkIfPersonExists($email)
    {
        $conn = WhatToDayUtilities::getDataBaseConnection();
        $sql = "select email from users
            where  email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function SavePersonInDataBase($email, $password, $question, $answer, $token)
    {
        $conn = WhatToDayUtilities::getDataBaseConnection();
        $sql = "INSERT INTO users (password,email,question,answer) VALUES('$password','$email', '$question','$answer')";

        if (mysqli_query($conn, $sql)) {
            $last_id = $conn->insert_id;
            $sql = "INSERT INTO token (u_id,token) VALUES('$last_id', '$token')";
            mysqli_query($conn, $sql);
            return true;
        } else {
            return false;
        }

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

    /**
     * @\Sensio\Bundle\FrameworkExtraBundle\Configuration\Route  ("/changeEmail")
     */
    public function changeEmail()
    {
        $conn = WhatToDayUtilities::getDataBaseConnection();
        if (isset($_SESSION['PersonData'])) {
            $sql = 'SELECT email from users where id =' . $_SESSION['PersonData']->ID;
            $email = $conn->query($sql)->fetch_assoc();
            if ($_POST['emailOld'] == $email['email']) {
                $sql = $conn->prepare('UPDATE users SET email = ' . "'" . $_POST['emailNew'] . "'" . ' 
                WHERE id =' . $_SESSION['PersonData']->ID);
                $sql->execute();
                return new Response('success');
            } else {
                return new Response('emailNoMatch');
            }
        }
    }

    /**
     * @\Sensio\Bundle\FrameworkExtraBundle\Configuration\Route  ("/verifySecurityQuestion")
     */
    public function verifySecurityQuestion()
    {
        $conn = WhatToDayUtilities::getDataBaseConnection();
        $sql = "SELECT id from users where email = " . "'" . $_POST['enteredEmail'] . "'" . " AND question = " . $_POST['question'] . " AND answer = " . "'" . $_POST['SecurityQuestionAnswer'] . "'";
        $result = $conn->query($sql)->fetch_assoc();
        if (!empty($result)) {
            return new Response($result['id']);
        } else {
            return new Response('noUser');
        }
    }

    /**
     * @\Sensio\Bundle\FrameworkExtraBundle\Configuration\Route  ("/changeForgottenPassword")
     */
    public function changeForgottenPassword()
    {
        $conn = WhatToDayUtilities::getDataBaseConnection();
        if ($_POST['passwordNew'] == $_POST['passwordVerification']) {
            $passwordHash = hash('SHA1', $_POST['passwordVerification']);
            $sql = $conn->prepare('UPDATE users SET password = ' . "'" . $passwordHash . "'" . 'WHERE id =' . $_POST['userId']);
            $sql->execute();
            return new Response('success');
        } else {
            return new Response('PasswordsDoesNotMatch');
        }
    }

    /**
     * @\Sensio\Bundle\FrameworkExtraBundle\Configuration\Route  ("/getSecurityQuestion")
     */
    public function getSecurityQuestion()
    {
        $conn = WhatToDayUtilities::getDataBaseConnection();
        if (!empty($_POST['email'])) {
            $sql = "SELECT question FROM users WHERE email = " . "'" . $_POST['email'] . "'";
            $result = $conn->query($sql)->fetch_assoc();
            return new Response($result['question']);
        }
    }
}

