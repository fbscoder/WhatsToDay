<?php
/**
 * Created by PhpStorm.
 * User: Marcell
 * Date: 28.11.2018
 * Time: 09:42
 */

namespace App\Controller;


use PhpParser\Node\Stmt\If_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Utils\APIUtils;

class Task extends AbstractController
{
    /**
     * @Route("/showTasks")
     */
    public function showTask()
    {
        if (!isset($_SESSION))
            session_start();
        if (!isset($_SESSION["PersonData"]))
            return $this->redirectToRoute('app_login_index');
        try {
            $params['taskTodayCount'] = 0;
            $params['taskTomorrowCount'] = 0;
            if (isset($_POST['card_id']))
                APIUtils::setTaskToFinish($_POST["card_id"]);
            $boards = json_decode($_GET['selectedBoards']);
            $count = 0;
            foreach ($boards as $i => $board) {
                $params['taskToday'] = APIUtils::getBoardTasksToday($board);
                $params['taskTomorrow'] = APIUtils::getBoardTasksTomorrow($board);

                foreach ($params['taskToday'] as $c => $task) {
                    $tasks[$count]['title'] = $task->title;
                    $tasks[$count]['description'] = $task->description;
                    $tasks[$count]['checkListData'] = $task->checkListData;
                    $tasks[$count]['id'] = $task->id;
                    $count++;
                }
                foreach ($params['taskTomorrow'] as $c => $task) {
                    $tasksTomorrow[$count]['title'] = $task->title;
                    $tasksTomorrow[$count]['description'] = $task->description;
                    $tasksTomorrow[$count]['checkListData'] = $task->checkListData;
                    $tasksTomorrow[$count]['id'] = $task->id;
                    $count++;
                }
            }
            if (empty($task) && empty($tasksTomorrow))
                throw new \Exception('Es sind aktuell keine Tasks zu erledigen.');
            elseif (!empty($tasks) && empty($tasksTomorrow)) {
                $tasksTomorrow = 'No Tasks defined for tomorrow';
            } elseif (!empty($tasksTomorrow) && empty($tasks)) {
                $tasks = "No Task defined for today";
            }
            $params['taskToday'] = $tasks;
            $params['taskTomorrow'] = $tasksTomorrow;

            if (is_array($params['taskToday'])) {
                $params['taskToday'] = array_values($params['taskToday']);
                $params['taskTodayCount'] = APIUtils::getCountedTasks($params['taskToday']);
            }
            if (is_array($params['taskTomorrow'])) {
                $params['taskTomorrow'] = array_values($params['taskTomorrow']);
                $params['taskTomorrowCount'] = APIUtils::getCountedTasks($params['taskTomorrow']);
            }
            return $this->render('aufgaben.html.twig', $params);
        } catch (\Exception $exception) {
            $params['error'] = $exception->getMessage();
            return $this->render('error.html.twig', $params);
        }
    }
}