<?php

namespace App\Controller\Utils;

use Trello\Client;
use Trello\Manager;

class APIUtils
{

    public static function test()
    {
        //session_start();
        $Person = $_SESSION["PersonUtils"];

        $client = new Client();
        echo $_SESSION["PersonUtils"]->API_KEY . "<br>";
        echo $_SESSION["PersonUtils"]->TOKEN . "<br>";
        echo $_SESSION["PersonUtils"]->ID . "<br>";

        //$client->authenticate($Person->API_KEY, $Person->TOKEN, Client::AUTH_URL_CLIENT_ID);
        $client->authenticate('aa8b7e7e0a878b7f8e6d805c78ff2526', '90dec1d14cd5336ba006af1bd79829c1a6ed45480130c3a40fb7fccf3d1927e4', Client::AUTH_URL_CLIENT_ID);
        $boards = $client->api("member")->boards()->all();//->cards()->all();
        $cardList = $client->api("boards")->lists()->all($boards[0]["id"]);
        //$cardList = $client->api("cardList")->cards()->all($cardList[0]["id"]);

        echo "<pre>";
        print_r($cardList);
        //print();

        $manager = new Manager($client);

        //$card = $manager->getCard($boards[0]['id']);




    }

}


