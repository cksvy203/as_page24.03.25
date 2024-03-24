document.getElementById("phoneNumber").addEventListener("input", function() {
    // 입력된 전화번호에서 하이픈을 제외한 숫자만 추출
    let phoneNumber = this.value.replace(/[^0-9]/g, '');

    // 전화번호 형식에 맞게 하이픈 추가
    if (phoneNumber.length > 3) {
        phoneNumber = phoneNumber.substring(0, 3) + '-' + phoneNumber.substring(3);
    }
    if (phoneNumber.length > 8) {
        phoneNumber = phoneNumber.substring(0, 8) + '-' + phoneNumber.substring(8);
    }

    // 최종 전화번호 값 설정
    this.value = phoneNumber;
});
