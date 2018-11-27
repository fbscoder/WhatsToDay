<?php

namespace App\Controller;


use App\Controller\Utils\APIUtils;
use App\Controller\Utils\PersonUtils;
use App\Controller\Utils\WhatToDayUtilities;
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
        $username = "test";
        WhatToDayUtilities::setSession(PersonUtils::getPersonData($username));

        //APIUtils::test();
        return $this->render('test.html');


    }
}