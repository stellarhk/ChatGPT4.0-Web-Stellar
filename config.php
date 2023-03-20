<?php
function balance($API_KEY){
    $options = array(
        'http' => array(
            'method' => 'GET',
            'header' => "Authorization: Bearer " . $API_KEY."\r\n"."Content-type: application/json",
            'timeout' => 15 * 60 // 超时时间（单位:s）
        ),'ssl'=>array('verify_peer' => false,'verify_peer_name' => false)
    );
    $context = stream_context_create($options);
    $response = @file_get_contents('https://api.openai.com/dashboard/billing/credit_grants', false, $context);

    if (isset($response)) {

        $json_array = json_decode($response, true);
        return $json_array;
    }
}

function completions($API_KEY,$TEXT)
{

    $params = json_encode(array(
        'prompt' => $TEXT,
        'model' => 'text-davinci-003',
        'temperature' => 0.5,
        'max_tokens' => 2000,
        'top_p' => 1.0,
        'frequency_penalty' => 0.8,
        'presence_penalty' => 0.0,
        'stop' => [
            "\nNote:",
            "\nQuestion:"
        ]
    ));

    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => "Authorization: Bearer " . $API_KEY."\r\n"."Content-type: application/json",
            'content' => $params,
            'timeout' => 15 * 60 // 超时时间（单位:s）
        ),'ssl'=>array('verify_peer' => false,'verify_peer_name' => false)
    );
    $context = stream_context_create($options);
    $response = @file_get_contents('https://api.openai.com/v1/completions', false, $context);

    $text = "服务器连接错误,请稍后再试!";

    if (isset($response)) {
        $json_array = json_decode($response, true);
        if( isset( $json_array['choices'][0]['text'] ) ) {
            $text = str_replace( "\\n", "\n", $json_array['choices'][0]['text'] );
        } elseif( isset( $json_array['error']['message']) ) {
            $text = $json_array['error']['message'];
        } else {
            $text = "对不起，我不知道该怎么回答。";
        }
    }
    return $text;
}

function imges($API_KEY,$TEXT)
{

    $params = json_encode(array(
        'prompt' => $TEXT,
        "n" => 1,
        "size" => "1024x1024",

    ));

    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => "Authorization: Bearer " . $API_KEY."\r\n"."Content-type: application/json",
            'content' => $params,
            'timeout' => 15 * 60 // 超时时间（单位:s）
        ),'ssl'=>array('verify_peer' => false,'verify_peer_name' => false)
    );
    $context = stream_context_create($options);
    $response = @file_get_contents('https://api.openai.com/v1/images/generations', false, $context);

    $text['text'] ="服务器连接错误,请稍后再试!";
    $text['status'] = 0;
    if (isset($response)) {
        $json_array = json_decode($response, true);

        if( isset( $json_array['data'][0]['url'] ) ) {
            $text['status'] = 1;
            $text['text'] = str_replace( "\\n", "\n", $json_array['data'][0]['url'] );
        } elseif( isset( $json_array['error']['message']) ) {
            $text['status'] = 0;
            $text['text'] = $json_array['error']['message'];
        } else {
            $text['status'] = 0;
            $text['text'] = "出现一点小问题,可能是网络问题,也可能是您的关键字违规。";
        }
    }
    return $text;
}