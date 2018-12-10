<?php

namespace App\Controller;


use App\Controller\Utils\PersonUtils;
use App\Controller\Utils\WhatToDayUtilities;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Register extends AbstractController
{
    /**
     * @Route("/Register")
     */
    public function index()
    {
        //If session not started start the session
        if (!isset($_SESSION))
            session_start();
        //If session 'PersonData' is set then clear the 'PersonData' session
        if (isset($_SESSION["PersonData"]))
            unset($_SESSION["PersonData"]);
        //Check if all input fields are set and not empty
        if ((isset($_POST["email"]) && !empty($_POST["email"])) &&
            (isset($_POST["password"]) && !empty($_POST["password"])) &&
            (isset($_POST["password_repeat"]) && !empty($_POST["password_repeat"])) &&
            (isset($_POST["token"]) && !empty($_POST["token"])) &&
            (isset($_POST["question"]) && !empty($_POST["question"])) &&
            (isset($_POST["answer"]) && !empty($_POST["answer"]))) {
            $password = sha1($_POST["password"]);
            $password_repeat = sha1($_POST["password_repeat"]);
            $email = $_POST["email"];
            $token = $_POST["token"];
            $question = $_POST["question"];
            $answer = sha1($_POST["answer"]);
            //Check the password
            if ($password == $password_repeat) {
                //Checks if the person already exists in the dataBase
                if (!PersonUtils::checkIfPersonExists($email)) {
                    if (PersonUtils::SavePersonInDataBase($email, $password, $question, $answer, $token)) {
                        WhatToDayUtilities::setSession(PersonUtils::getPersonData($email));
                        return $this->redirectToRoute('app_board_showboard');
                    }
                } else {
                    //ERROR E-Mail wurde bereits verwendet!
                }
            } else {
                //ERROR passwort stimmt nicht überein!
            }
        } else {
            //ERROR sind alle felder ausgefüllt?
        }

        return $this->render('register.html.twig');
    }
}