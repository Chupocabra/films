document.addEventListener('DOMContentLoaded', () => {

    const forms = document.getElementById('reg_window');
        forms.addEventListener('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            formData = Object.fromEntries(formData);
            fetch('add_user.php', { // файл-обработчик
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
                    //console.log(formData);
                    //form.reset(); // очищаем поля формы
                })
                .catch((error) => console.error(error))
        });
});