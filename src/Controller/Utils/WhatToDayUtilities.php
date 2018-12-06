<?php
/**
 * Created by PhpStorm.
 * User: gajac
 * Date: 26.11.2018
 * Time: 14:08
 */

namespace App\Controller\Utils;


class WhatToDayUtilities
{
    public static function setSession($Person)
    {
        $_SESSION["PersonData"] = $Person;
    }
    public static function getDataBaseConnection()
    {
        $servername = "localhost";
        $uname = "root";
        $password = "root";
        $dbname = "whatstoday";

        // Create connection
        $conn = new \mysqli($servername, $uname, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    public static function isSessionNull()
    {
        if (isset($_SESSION['PersonUtils']) && !empty($_SESSION['PersonUtils'])) {
            return true;
        }
        return false;
    }
}