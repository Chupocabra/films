const applicantForm = document.getElementById('reg_window')
applicantForm.addEventListener('submit', handleFormSubmit)

function serializeForm(formNode) {
    const { elements } = formNode

    const data = new FormData()

    Array.from(elements)
        .filter((item) => !!item.name)
        .forEach((element) => {
            const { name, type } = element
            const value = type === 'checkbox' ? element.checked : element.value

            data.append(name, value)
        })
    console.log(Array.from(data.entries()))
    return data
}


async function sendData(data) {
    return await fetch('/add_user.php', {
        method: 'POST',
        body: data
    })
}

function toggleLoader() {
    const loader = document.getElementById('loader')
    loader.classList.toggle('hidden')
}

function onSuccess(formNode) {
    alert('Вы зарегестрированы')
    formNode.classList.toggle('hidden')
}

function onError(error) {
    alert(error.message)
}

async function handleFormSubmit(event) {
    event.preventDefault()
    const data = serializeForm(event.target)

    toggleLoader()

    const { status, error } = await sendData(data)
    toggleLoader()

    if (status === 200) {
        onSuccess(event.target)
    } else {
        onError(error)
    }
}




