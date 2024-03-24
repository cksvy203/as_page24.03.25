<?php
// cURL을 사용하여 HTTP 요청을 보내기 위한 함수
function sendRequest($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

// 카카오 알림톡 API 키
$apiKey = 'Your_Kakao_Alert_API_Key';

// 고객의 휴대폰 번호
$customerPhoneNumber = $_POST['phoneNumber'];

// 접수 완료 문자 메시지 내용
$message = "고객님, 접수가 정상적으로 완료되었습니다. 감사합니다.";

// 카카오 알림톡 API 호출을 위한 요청 데이터
$data = array(
    'message' => $message,
    'receiverPhoneNumber' => $customerPhoneNumber,
    'apiKey' => $apiKey
);

// 카카오 알림톡 API 엔드포인트 URL
$url = 'https://kakao.alert.com/send';

// HTTP POST 요청을 보내고 응답을 받습니다.
$response = sendRequest($url, $data);

// 응답 확인
if ($response === 'success') {
    echo "알림톡이 성공적으로 전송되었습니다.";
} else {
    echo "알림톡 전송에 실패했습니다.";
}
?>
