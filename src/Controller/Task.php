<?php
/**
 * Created by PhpStorm.
 * User: Marcell
 * Date: 28.11.2018
 * Time: 09:42
 */

namespace App\Controller;


use App\Controller\Utils\APIUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Task extends AbstractController
{
    /**
     * @Route("/showTasks")
     */
    public function showTask()
    {
        //If session not started start the session
        if (!isset($_SESSION))
            session_start();
        //Check if the 'PersonData' session is set
        if (!isset($_SESSION["PersonData"]))
            return $this->redirectToRoute('app_login_index');

        try {
            //Count the Tasks
            $params['taskTodayCount'] = 0;
            $params['taskTomorrowCount'] = 0;
            //Set the card to finish if the id is in the session
            if (isset($_POST['card_id']))
                APIUtils::setTaskToFinish($_POST["card_id"]);
            $boards = json_decode($_GET['selectedBoards']);
            $count = 0;
            //show tasks today and tasks tomorrow
            foreach ($boards as $i => $board) {
                $params['taskToday'] = APIUtils::getBoardTasksToday($board);
                $params['taskTomorrow'] = APIUtils::getBoardTasksTomorrow($board);

                foreach ($params['taskToday'] as $c => $task) {
                    $tasks[$count]['title'] = $task->title;
                    $tasks[$count]['description'] = $task->description;
                    $tasks[$count]['checkListData'] = $task->checkListData;
                    $tasks[$count]['id'] = $task->id;
                    $tasks[$count]['labels'] = $task->getLabels();
                    $tasks[$count]['personsInCard'] = null;
                    foreach ($task->personInCard as $name) {
                        $tasks[$count]['personsInCard'] .= $name . ", ";
                    }
                    $count++;
                }
                foreach ($params['taskTomorrow'] as $c => $task) {
                    $tasksTomorrow[$count]['title'] = $task->title;
                    $tasksTomorrow[$count]['description'] = $task->description;
                    $tasksTomorrow[$count]['checkListData'] = $task->checkListData;
                    $tasksTomorrow[$count]['id'] = $task->id;
                    $tasksTomorrow[$count]['labels'] = $task->getLabels();
                    $tasksTomorrow[$count]['personsInCard'] = null;
                    foreach ($task->personInCard as $name) {
                        $tasksTomorrow[$count]['personsInCard'] .= $name . ", ";
                    }

                    $count++;
                }
            }
            if (empty($task) && empty($tasksTomorrow))
                throw new \Exception('Nichts mehr zu tun.');
            elseif (!empty($tasks) && empty($tasksTomorrow)) {
                $tasksTomorrow = 'Morgen sind keine Tätigkeiten zu erledigen';
            } elseif (!empty($tasksTomorrow) && empty($tasks)) {
                $tasks = "Heute sind keine Tätigkeiten zu erledigen";
            }
            $params['taskToday'] = $tasks;
            $params['taskTomorrow'] = $tasksTomorrow;

            if (is_array($params['taskToday'])) {
                $params['taskTodayCount'] = APIUtils::getCountedTasks($params['taskToday']);
            }
            if (is_array($params['taskTomorrow'])) {
                $params['taskTomorrowCount'] = APIUtils::getCountedTasks($params['taskTomorrow']);
            }
            return $this->render('aufgaben.html.twig', $params);
        } catch (\Exception $exception) {
            $params['error'] = $exception->getMessage();
            return $this->render('error.html.twig', $params);
        }
    }
}