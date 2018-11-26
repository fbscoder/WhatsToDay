<?php

namespace App\Controller;


use http\Env\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Test extends AbstractController
{
    public function __construct()
    {

    }
    /**
     * @Route("/Test")
     */
    public function index()
    {
        return new \Symfony\Component\HttpFoundation\Response('Test');
    }
}