<?php


$language = $_REQUEST['language'];
$voice = $_REQUEST['voice'];
$text = trim($_REQUEST['text']);
$role = $_REQUEST['role'];
$style = $_REQUEST['style'];
$rate = $_REQUEST['rate'];
$pitch = $_REQUEST['pitch'];

$data = '<speak version="1.0" xmlns="http://www.w3.org/2001/10/synthesis" xmlns:mstts="https://www.w3.org/2001/mstts" xml:lang="'.$language.'">
            <voice name="'.$voice.'">
                <mstts:express-as role="'.$role.'" style="'.$style.'">
                    <prosody rate="'.$rate.'%" pitch="'.$pitch.'%">
                        '.$text.'
                    </prosody>
                </mstts:express-as>
            </voice>
        </speak>';

    /*$data = '<speak version="1.0" xmlns="http://www.w3.org/2001/10/synthesis"
                       xmlns:mstts="https://www.w3.org/2001/mstts" xml:lang="zh-CN">
                    <voice name="zh-CN-XiaomoNeural">
                        女儿看见父亲走了进来，问道：
                        <mstts:express-as role="YoungAdultFemale" style="calm">
                            “您来的挺快的，怎么过来的？”
                        </mstts:express-as>
                        父亲放下手提包，说：
                        <mstts:express-as role="OlderAdultMale" style="calm">
                            “刚打车过来的，路上还挺顺畅。”
                        </mstts:express-as>
                    </voice>
                </speak>';*/
    // echo($data);exit();




$region = "japaneast"; // 此处需要申请个人账号 申请地址：https://azure.microsoft.com/zh-cn/products/cognitive-services/text-to-speech/#features
$AccessTokenUri = "https://".$region.".api.cognitive.microsoft.com/sts/v1.0/issueToken";
$apiKey = "7014d2487cc844c08b8f4558c6cc5294"; // 个人密钥 同上方申请

$headerArray =array(
    'header'  => "Ocp-Apim-Subscription-Key: ".$apiKey."\r\n" .
        "content-length: 0\r\n",
);

if (false) {
    $result = array(
        'code'=> 400,
        'msg'=>"token获取失败，请联系管理员",
        'author'=>"互联网",
        'url'=>"https://www.timecn.cn/"
    );
    echo json_encode($result,320);
    exit();
}else{
    $ttsServiceUri = "https://".$region.".tts.speech.microsoft.com/cognitiveservices/v1";
    $headers = "Content-type: application/ssml+xml\r\n" .
        "X-Microsoft-OutputFormat: audio-16khz-32kbitrate-mono-mp3\r\n" .
        "Ocp-Apim-Subscription-Key: ".$apiKey."\r\n" .
        //"Authorization: "."Bearer ".$access_token."\r\n" .
        "X-Search-AppId: 07D3234E49CE426DAA29772419F436CA\r\n" .
        "X-Search-ClientID: 1ECFAE91408841A480F00935DC390960\r\n" .
        "User-Agent: TTSPHP\r\n";

    $options = array (
        'http' => array (
            'header' => $headers,
            'method' => 'POST',
            'content' => $data
        )
    );
    $context  = stream_context_create ($options);
    $result_tts = @file_get_contents ($ttsServiceUri, false, $context);

    /*$headerArray =array($headers);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $ttsServiceUri);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,FALSE);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $context);
    curl_setopt($curl,CURLOPT_HTTPHEADER,$headerArray);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    if(curl_exec($curl) === false)
    {
        echo 'Curl error: ' . curl_error($ch);
    }
    else
    {
        echo '操作完成没有任何错误';
    }
    $output = curl_exec($curl);
    curl_close($curl);

    $result_tts = $output;*/

    $filename = rand()."_".time();

    $filepath=$filename.".mp3";
    //写入文件
    if(file_put_contents($filepath,$result_tts)){
        $result = array(
            'code'=> 200,
            'msg'=>"语音生成成功，下载链接有效期30分钟",
            'download'=>"https://www.timecn.cn/tts/$filepath",
            'author'=>"互联网",
            'url'=>"https://www.timecn.cn/"
        );
        echo json_encode($result,320);
        exit();
    }else{
        $result = array(
            'code'=> 400,
            'msg'=>"语音生成失败，请联系管理员",
            'author'=>"互联网",
            'url'=>"https://www.timecn.cn/"
        );
        echo json_encode($result,320);
        exit();
    }

}


function posturl($url,$data,$headerArray){
        $data  = json_encode($data);    
        //$headerArray =array("Content-type: application/ssml+xml","Accept:application/json");
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl,CURLOPT_HTTPHEADER,$headerArray);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        if(curl_exec($curl) === false)
        {
            echo 'Curl error: ' . curl_error($ch);
        }
        curl_close($curl);
        return $output;
}

