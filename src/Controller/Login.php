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
        if (isset($_POST)) {
            $ok = PersonUtils::checkIfRightPerson($_POST["email"], $_POST["password"]);
            if($ok){
                WhatToDayUtilities::setSession(PersonUtils::getPersonData($_POST["email"]));
                header("/Boards");
            }
            //ERROR
        }

        return $this->render('login.html.twig');
    }
}