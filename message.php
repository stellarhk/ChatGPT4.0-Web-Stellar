<?php
require_once(__DIR__."/config.php");

header( "Content-Type: application/json" );
$context = json_decode( $_POST['context'] ?? "[]" ) ?: [];

//$open_ai_key =$_POST['key']?:'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';
$open_ai_key =$_POST['key']?:'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';

if(!empty($_GET['balance'])){
    if(empty($_POST['key'])){
        echo json_encode( [
            "msg" =>"请输入key在查询",
            "status" => "0",
        ] );
        exit();
    }
    $info=balance($open_ai_key);
    if(!$info){
        echo json_encode( [
            "msg" =>"key错误",
            "status" => "0",
        ] );
        exit();
    }
    echo json_encode( [
        "total_available" => $info['total_available'],//剩余
        "total_used"=>$info['total_used'],//已使用
        "total_granted"=>$info['total_granted'],//全部
        "status" => "1",
    ] );
    exit();
}

// 设置默认的请求文本prompt
$prompt = "";

// 添加文本到prompt
if( empty( $context ) ) {
    // 如果没有内容，下面是默认内容
    $prompt .= "
    Question:\n'我问你个问题，你告诉我答案OK吗？
    \n\nAnswer:\n好 
    \n\n Question:\n'请问aizhineng.cc是什么
    \n\nAnswer:\n aizhineng.cc是一个免费chatgpt分享站";
    $please_use_above = "";
} else {
    // 将上次的问题和答案作为问题进行提交
    $prompt .= "";
    $context = array_slice( $context, -5 );
    foreach( $context as $message ) {
        $prompt .= "Question:\n" . $message[0] . "\n\nAnswer:\n" . $message[1] . "\n\n";
    }
    $please_use_above = ". Please use the questions and answers above as context for the answer.";
}
// add new question to prompt
$prompt = $prompt . "Question:\n" . $_POST['message'] . $please_use_above . "\n\nAnswer:\n\n";



// create a new completion
if($_POST['id']==2){
   /* if(!$_POST['key']){
         echo json_encode( [
            "raw_message" => 0,
            "message" => '绘图版收费较高,请使用自己的key进行测试!',
            "status" => "success",
        ] );
        exit();
    }*/
    $mapping=imges($open_ai_key,$_POST['message']);
        echo json_encode( [
            "raw_message" => $mapping['status'],
            "message" => $mapping['text'],
            "status" => "success",
        ] );
        exit();
} else {
        $text=completions($open_ai_key,$prompt);
        echo json_encode( [
            "message" => str_replace(array("\r\n", "\r", "\n"), "", strip_tags($text)),
            "raw_message" => $text,
            "status" => "success",
        ] );
         exit();
}
