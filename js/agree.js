document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#asForm');
    const agreementCheckbox = document.querySelector('#agreement');

    form.addEventListener('submit', e => {
        if (!agreementCheckbox.checked) {
            alert('���� ���� �� ���� ���׿� �������ּž� �մϴ�.');
            e.preventDefault(); // �� ���� �ߴ�
        }
    });
});
