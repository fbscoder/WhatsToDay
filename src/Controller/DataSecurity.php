<?php
/**
 * Created by PhpStorm.
 * User: Marcell
 * Date: 28.11.2018
 * Time: 09:42
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DataSecurity extends AbstractController
{
    /**
     * @Route("/DataSecurity")
     */
    public function showTask()
    {

        return $this->render('dataSecurity.html.twig');
    }
}