<?php
// 데이터베이스 서버 연결 정보
$servername = "54.180.89.122"; // 데이터베이스 호스트 이름
$username = "cksvy203"; // 데이터베이스 사용자 이름
$password = "cksvy4964"; // 데이터베이스 비밀번호
$dbname = "as_customer"; // 사용할 데이터베이스 이름

try {
    // 데이터베이스에 연결하여 PDO 객체 생성
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // 에러 모드를 예외로 설정
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // AS_submissions 테이블 생성 함수 호출
    createDatabaseTables($db);
    
    echo "<p>성공적으로 데이터베이스에 연결되었습니다.</p>";
} catch(PDOException $e) {
    // 데이터베이스 연결 실패 시 오류 출력 후 스크립트 종료
    die("데이터베이스 연결 실패: " . $e->getMessage());
}

// 데이터베이스 테이블 생성 함수
function createDatabaseTables($db) {
    try {
        // AS_submissions 테이블 생성 쿼리 업데이트
        $sql = "CREATE TABLE IF NOT EXISTS AS_submissions (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            product VARCHAR(255) NOT NULL,
            customer_name VARCHAR(255) NOT NULL,
            phone_number VARCHAR(20) NOT NULL,
            address VARCHAR(255) NOT NULL,
            model_name VARCHAR(255) NOT NULL,
            issue TEXT NOT NULL,
            receipt_number VARCHAR(50), -- 접수번호 필드 추가
            serviceType VARCHAR(50), -- 서비스 유형 필드 추가
            submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        // 테이블 생성 쿼리 실행
        $db->exec($sql);

        // 성공 메시지 출력
        echo "<p>데이터베이스 테이블이 성공적으로 생성되었습니다.</p>";
    } catch(PDOException $e) {
        // 오류 메시지 출력
        echo "<p>데이터베이스 테이블 생성 중 오류가 발생했습니다: " . $e->getMessage() . "</p>";
    }
}
?>
