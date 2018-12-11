<?php

namespace App\Controller;


use App\Controller\Utils\PersonUtils;
use App\Controller\Utils\WhatToDayUtilities;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Login extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        //If session not started start the session
        if (!isset($_SESSION))
            session_start();
        //If session 'PersonData' is set then clear the 'PersonData' session
        if (isset($_SESSION["PersonData"]))
            unset($_SESSION["PersonData"]);

        if ((isset($_POST["email"]) && !empty($_POST["email"])) && isset($_POST["password"]) && !empty($_POST["password"])) {
            $password = $_POST["password"];
            $email = $_POST["email"];
            $ok = PersonUtils::checkIfRightPerson($email, $password);
            if ($ok) {
                WhatToDayUtilities::setSession(PersonUtils::getPersonData($email));
                return $this->redirectToRoute('app_board_showboard');
            } else {
                //Sticky navBar
                echo "<script>
                    sessionStorage.setItem('login', '$email');
                </script>";
                unset($_POST["email"]);
                unset($_POST["password"]);
            }
        }

        return $this->render('login.html.twig');
    }
}