<?php

use App\Controllers\API\SendSurvey;

if (isset($_POST)) {
    if (!empty($_POSTp['email'])) {
        $send = ['title' => 'bezgmo@email.ua', 'question' => 'somehash', 'voice' => true];

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><response></response>');

        foreach ($send as $item) {
            $row = $xml->addChild('row');
            $row->addChild('title', $item['title']);
            $row->addChild('question', $item['question']);
            $row->addChild('voice', $item['voice']);
        }

        header('Content-type: text/xml; charset=utf-8');


        var_dump();

        echo $xml->asXML();
    }


}

//new SendSurvey();
