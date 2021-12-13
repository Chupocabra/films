document.addEventListener('DOMContentLoaded', () => {
    var modal = document.getElementById("myModalL");
    const forms = document.getElementById('log_window');
    forms.addEventListener('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        formData = Object.fromEntries(formData);
        fetch('login_user.php', { // файл-обработчик
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;', // отправляемые данные
            },
            body: JSON.stringify(formData)
        })
            .then(response => response.json())
            .catch(error => console.error(error))
            .then((response) => {
                console.log(response);
                location.reload();
                //form.reset(); // очищаем поля формы
            })
            .catch((error) => console.error(error))
    });
});