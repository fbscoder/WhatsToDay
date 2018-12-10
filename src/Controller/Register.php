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

        if (isset($_POST["email"]) || isset($_POST["question"]) || isset($_POST["answer"])) {
            $email = $_POST["email"];
            $question = $_POST["question"];
            $answer = $_POST["answer"];
            unset($_POST);
            echo "<script>
                    localStorage.setItem('email', '$email');
                    localStorage.setItem('question', '$question');
                    localStorage.setItem('answer', '$answer');
                </script>";
        }
        //Check if all input fields are set and
        if (
            isset($_POST["email"]) &&
            isset($_POST["password"]) &&
            isset($_POST["password_repeat"]) &&
            isset($_POST["question"]) &&
            isset($_POST["answer"])
        ) {
            $password = sha1($_POST["password"]);
            $password_repeat = sha1($_POST["password_repeat"]);
            $email = $_POST["email"];
            $token = $_POST["token"];
            $question = $_POST["question"];
            $answer = sha1($_POST["answer"]);
            //Check the password
            if ($token != null) {
                if ($password == $password_repeat) {
                    //Checks if the person already exists in the dataBase
                    if (!PersonUtils::checkIfPersonExists($email)) {
                        if (PersonUtils::SavePersonInDataBase($email, $password, $question, $answer, $token)) {
                            WhatToDayUtilities::setSession(PersonUtils::getPersonData($email));
                            return $this->redirectToRoute('app_board_showboard');
                        }
                    } else {
                        echo "<script>
                    localStorage.setItem('register', 'Die E-Mail ($email) ist bereits in verwendung!');
                </script>";
                    }
                } else {
                    echo "<script>
                    localStorage.setItem('register', 'Ihr Passwort stimmt nicht überein!');
                </script>";
                }
            } else {
                echo "<script>
                    localStorage.setItem('register', 'Sie haben keinen Token generieren lassen!');
                </script>";
            }
        }

        return $this->render('register.html.twig');
    }
}