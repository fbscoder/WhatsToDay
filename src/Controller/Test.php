<?php
/**
 * Created by PhpStorm.
 * User: Marcell
 * Date: 27.11.2018
 * Time: 09:21
 */

namespace App\Controller;


use App\Controller\Utils\APIUtils;
use App\Controller\Utils\PersonUtils;
use App\Controller\Utils\WhatToDayUtilities;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Test extends AbstractController
{
    /**
     * @Route("/Test")
     */
    public function index()
    {
        $username = "test";
        WhatToDayUtilities::setSession(PersonUtils::getPersonData($username));
        APIUtils::test();

        return new Response('');
    }


}