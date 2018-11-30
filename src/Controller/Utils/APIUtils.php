<?php

namespace App\Controller\Utils;

use App\Controller\Utils\Task\CheckData;
use App\Controller\Utils\Task\CheckListData;
use App\Controller\Utils\Task\TaskData;
use Trello\Client;

/**
 * @property Client client
 */
class APIUtils
{
    private static function getClient()
    {
        $client = new Client();
        #$person = $_SESSION["PersonUtils"];
        //$client->authenticate('aa8b7e7e0a878b7f8e6d805c78ff2526', $person->TOKEN, Client::AUTH_URL_CLIENT_ID);
        //$client->authenticate('aa8b7e7e0a878b7f8e6d805c78ff2526', 'ec0c8c9c53c3931330d1186a26ff4038127862bcb8d4fd4455189b1e5f96a0f2', Client::AUTH_URL_CLIENT_ID);
        $client->authenticate('aa8b7e7e0a878b7f8e6d805c78ff2526', '90dec1d14cd5336ba006af1bd79829c1a6ed45480130c3a40fb7fccf3d1927e4', Client::AUTH_URL_CLIENT_ID);

        return $client;
    }

    public static function test()
    {
        $client = APIUtils::getClient();

        //Board array
        $boards = $client->api("member")->boards()->all();
//        //List array
//        $cardList = $client->api("boards")->lists()->all($boards[1]["id"]);
//        //Card array
//        $cards = $client->api("lists")->cards()->all($cardList[1]["id"]);
//        //CheckList Array for single card
//        $checkList = $client->api("cards")->checklists()->all($cards[0]["id"]);

        //Update dueComplete to complete //
        //$cards[1]["dueComplete"] = 1;
        //$client->api("cards")->update($cards[1]["id"], $cards[1]);
        // !!!!!!! //

        //echo "<pre>";
        //print_r($boards);
        //APIUtils::getCountedTasks(APIUtils::getBoardTasksToday($boards[0]));
        APIUtils::getBoardTasksTomorrow($boards[1]["id"]);
    }

    private static function getTaskList($board, $dateToCheck)
    {
        $client = APIUtils::getClient();
        $cardList = $client->api("boards")->lists()->all($board);
        if (count($cardList) != 0) {
            $taskList = [];
            for ($i = 0; $i < count($cardList); $i++) {

                $cards = $client->api("lists")->cards()->all($cardList[$i]["id"]);
                if (count($cards) != 0) {
                    for ($x = 0; $x < count($cards); $x++) {
                        $taskData = null;
                        $card = $cards[$x];
                        $title = $card["name"];
                        $description = $card["desc"];
                        $endDate = $card["due"];
                        if ($dateToCheck == date('Ymd', strtotime($endDate)) && !$card["dueComplete"]) {
                            $checkList = $client->api("cards")->checklists()->all($card["id"]);
                            if (count($checkList) != 0) {
                                $checkListData = [];
                                for ($y = 0; $y < count($checkList); $y++) {
                                    $checkData = [];
                                    $singleCheckList = $checkList[$y]["checkItems"];
                                    $checkListName = $checkList[$y]["name"];
                                    if (count($singleCheckList) != 0) {
                                        for ($z = 0; $z < count($singleCheckList); $z++) {
                                            $check = $singleCheckList[$z];
                                            $isChecked = true;
                                            if ($check["state"] == "incomplete") {
                                                $isChecked = false;
                                            }
                                            $checkName = $check["name"];
                                            $checkData[] = new CheckData($checkName, $isChecked);
                                        }
                                    }
                                    $checkListData[] = new CheckListData($checkListName, $checkData);
                                }
                                $taskData = new TaskData($title, $description, $checkListData);
                            }
                            if ($taskData == null)
                                $taskData = new TaskData($title, $description, null);
                            $taskList[] = $taskData;
                        }
                    }
                }
            }
//            print_r($taskList);
            return $taskList;
        }
    }

    public static function getBoardTasksToday($board)
    {
        return APIUtils::getTaskList($board, date('Ymd'));
    }

    public static function getBoardTasksTomorrow($board)
    {
        $date_format = "Ymd";
        $today = mktime();
        $d = date('d', $today);
        $m = date('m', $today);
        $y = date('Y', $today);
        $tomorrow = mktime(0, 0, 0, $m, ($d + 1), $y);
        return APIUtils::getTaskList($board, gmdate($date_format, $tomorrow));
    }

    public static function getCountedTasks($taskList)
    {
        return count($taskList);
    }

    public static function getBoards()
    {
        $client = APIUtils::getClient();
        $boards = $client->api("member")->boards()->all();
        return $boards;
    }
}


