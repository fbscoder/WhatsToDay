<?php
/**
 * Created by PhpStorm.
 * User: Marcell
 * Date: 27.11.2018
 * Time: 09:21
 */

namespace App\Controller;

use App\Controller\Utils\APIUtils;
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

        //header('/Boards');
        return new Response("");
    }


}