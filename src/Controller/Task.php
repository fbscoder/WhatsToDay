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
use App\Controller\Utils\APIUtils;

class Task extends AbstractController
{
    /**
     * @Route("/showTasks")
     */
    public function showTask()
    {
        $params['taskToday'] = APIUtils::getBoardTasksToday($_GET['board']);
        $params['taskTodayCount'] = APIUtils::getCountedTasks($params['taskToday']);
        $params['taskTomorrow'] = APIUtils::getBoardTasksTomorrow($_GET['board']);
        $params['taskTomorrowCount'] = APIUtils::getCountedTasks(APIUtils::getBoardTasksTomorrow($_GET['board']));
        if (isset($_POST['card_id']))
            APIUtils::setTaskToFinish($_POST["card_id"]);

        return $this->render('aufgaben.html.twig', $params);
    }
}