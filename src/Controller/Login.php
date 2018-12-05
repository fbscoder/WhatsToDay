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
        //$username = "test";
        //WhatToDayUtilities::setSession(PersonUtils::getPersonData($username));

        //APIUtils::test();
        return $this->render('login.html.twig');
    }
}