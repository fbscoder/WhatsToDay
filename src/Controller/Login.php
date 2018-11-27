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
        require_once 'PersonUtils.php';
        require_once 'WhatToDayUtilities.php';
        require_once 'APIUtils.php';

        $username = "test";
        $person = PersonUtils::getPersonData($username);

        WhatToDayUtilities::setSession($person);

        _APIUtils::test();

        return new Response('Test');

    }
}