<?php
/**
 * Created by PhpStorm.
 * User: Marcell
 * Date: 28.11.2018
 * Time: 09:41
 */

namespace App\Controller;


use App\Controller\Utils\APIUtils;
use App\Controller\Utils\PersonUtils;
use App\Controller\Utils\WhatToDayUtilities;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Board extends AbstractController
{
    /**
     * @Route("/Boards")
     */
    public function showBoard()
    {
        $username = "test";
        WhatToDayUtilities::setSession(PersonUtils::getPersonData($username));
        $params['boards'] = APIUtils::getBoards();
        return $this->render('showBoards.html.twig', $params);
    }

}