document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#asForm');
    const agreementCheckbox = document.querySelector('#agreement');

    form.addEventListener('submit', e => {
        if (!agreementCheckbox.checked) {
            alert('수리 접수 전 참고 사항에 동의해주셔야 합니다.');
            e.preventDefault(); // 폼 제출 중단
        }
    });
});
