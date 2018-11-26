<?php

namespace App\Controller;


use http\Env\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Login extends AbstractController
{
    public function __construct()
    {

    }
    /**
     * @Route("/")
     */
    public function index()
    {
        require_once 'Person.php';
        require_once 'WhatToDayUtilities.php';
        $Person = new Person();
        $username = "test";
        $Person->setPersonData($username);
        $utili = new WhatToDayUtilities();
        $utili->setSession($Person);

        return new \Symfony\Component\HttpFoundation\Response('Test');

    }
}