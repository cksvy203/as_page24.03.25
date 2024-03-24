<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>수리 접수 완료 안내 페이지</title>
    <link rel="stylesheet" href="stylesheet/complete.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>접수 완료</h1>
        <div class="info">
            <?php
            $customerName = isset($_GET['customerName']) ? htmlspecialchars($_GET['customerName']) : "";
            $receiptNumber = isset($_GET['receiptNumber']) ? htmlspecialchars($_GET['receiptNumber']) : "미배정";
            $serviceType = isset($_GET['serviceType']) ? htmlspecialchars($_GET['serviceType']) : "미정";
            ?>
            <p><strong>일시:</strong> <?php echo date("Y-m-d H:i:s"); ?></p>
            <p><strong>고객명:</strong> <?php echo $customerName; ?></p>
            <p><strong>접수 번호:</strong> <?php echo $receiptNumber; ?></p>
            <p><strong>서비스 유형:</strong> <?php echo $serviceType; ?></p>
        </div>
        <div class="additional-info">
            <h2>이용해 주셔서 감사합니다!</h2>
            <p>고객님의 만족스러운 서비스 제공을 위해 최선을 다하겠습니다.</p>
            <p>서비스 진행 상황에 대한 자세한 정보는 카카오톡 알림톡으로 전송 해드리겠습니다.</p>
        </div>
    </div>
</body>
</html>
