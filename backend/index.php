<?php
require_once 'table_create.php';

$error = false;
$logFilePath = '/var/www/html/as/logs/';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product = $_POST['product'];
    $customerName = $_POST['customerName'];
    $phoneNumber = $_POST['phoneNumber'];
    $address = $_POST['address'];
    $modelName = $_POST['modelName'];
    $issue = $_POST['issue'];
    // 사용자 입력 대신 서버에서 접수 번호를 생성합니다.
    $serviceType = $_POST['serviceType'];

    try {
        $conn = $db;

        // 현재 날짜를 기반으로 하는 접수번호 생성 로직
        $today = date("Ymd");
        $stmt = $conn->prepare("SELECT MAX(receipt_number) AS lastReceiptNumber FROM AS_submissions WHERE receipt_number LIKE ?");
        $stmt->execute([$today."%"]);
        $row = $stmt->fetch();
        $lastReceiptNumber = $row ? intval(substr($row['lastReceiptNumber'], 8)) : 0;
        $receiptNumber = $today . sprintf('%04d', $lastReceiptNumber + 1);

        $stmt = $conn->prepare("SELECT * FROM AS_submissions WHERE customer_name = ? AND issue = ?");
        $stmt->execute([$customerName, $issue]);
        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            echo "<script>
                    if(confirm('이미 동일한 고객명과 증상으로 접수가 완료되었습니다. 확인을 누르면 메인 페이지로 이동합니다.')) {
                        window.location.href='../index.html';
                    }
                </script>";
        } else {
            $stmt = $conn->prepare("INSERT INTO AS_submissions (product, customer_name, phone_number, address, model_name, issue, receipt_number, serviceType) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$product, $customerName, $phoneNumber, $address, $modelName, $issue, $receiptNumber, $serviceType]);

            $conn = null;
            header('Location: ../complete.php?customerName=' . urlencode($customerName) . '&receiptNumber=' . urlencode($receiptNumber) . '&serviceType=' . urlencode($serviceType));
            exit();
        }

    } catch(PDOException $e) {
        $logFileName = 'error.' . date("YmdHisu") . '.log';
        $logFilePathWithName = $logFilePath . $logFileName;
        error_log("데이터베이스 오류: " . $e->getMessage(), 3, $logFilePathWithName);
        
        echo "<p>접수 처리 중 오류가 발생했습니다. 나중에 다시 시도해주세요.</p>";
        $error = true;

        $date = date("Y-m-d");
        $files = glob($logFilePath . 'error.' . $date . '*.log');
        $numErrors = count($files);

        if ($numErrors >= 3) {
            echo "<script>alert('오류가 발생했습니다. 지속적인 문제 발생 시 " . htmlspecialchars("chan@computer365.co.kr") . "로 문의 부탁드립니다.');</script>";
        }
    }
}
?>
