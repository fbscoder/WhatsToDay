<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Login extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        require_once 'UserFunctions.php';
        require_once 'WhatToDayUtilities.php';
        require_once 'Main_API.php';

        $username = "test";
        $person = UserFunctions::getPersonData($username);

        WhatToDayUtilities::setSession($person);

        Main_API::test();

        return new Response('Test');

    }
}