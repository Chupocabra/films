const API_URL = 'http://httpbin.org/post';

window.onscroll = function() {myFunction()};
var header = document.getElementById("myHeader");
var sticky = header.offsetTop;
function myFunction() {
  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
      document.getElementById("myHeader").style.fontSize = "30px";
      document.getElementById("myLogo").style.height = "72.5px";
      document.getElementById("myHeader").style.height = "72.5px";
    } else {
        document.getElementById("myHeader").style.fontSize = "48px";
        document.getElementById("myLogo").style.height = "114px";
        document.getElementById("myHeader").style.height = "114px";
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
}


document.addEventListener("DOMContentLoaded", function () {
    let morePostsBtn = document.getElementById('show_more_btn');

    if (!!morePostsBtn) {
        morePostsBtn.addEventListener('click', loadPostsListener);
    }

    function loadPostsListener(event) {
        event.preventDefault();

        let page = parseInt(event.target.getAttribute('data-next-page'));
        if (isNaN(page)) {
            page = 0;
        }
        let url = 'show_more.php' + '?page=' + page;
        fetch(url)
            .then(response => response.text())
            .then((result) => {
                if (result.length > 0) {
                    morePostsBtn.insertAdjacentHTML('beforebegin', result);
                    morePostsBtn.setAttribute('data-next-page', (page + 1).toString());
                    morePostsBtn.setAttribute('last-id', (id-5).toString());
                } else {
                    morePostsBtn.remove();
                }
            })
            .catch(error => console.log(error));
    }
});

var modal = document.getElementById("myModalL");
var btn = document.getElementById("myBtnL");
var span = document.getElementById("log_close");
var modal2 = document.getElementById("myModalR");
var btn2 = document.getElementById("myBtnR");
var span2 = document.getElementById("reg_close");
var to_reg = document.getElementById("to_reg");
var to_log = document.getElementById("to_log");

to_log.onclick = function () {
    modal2.style.display = "none";
    modal.style.display = "block";
}

to_reg.onclick = function () {
    modal.style.display = "none";
    modal2.style.display = "block";
}

btn.onclick = function () {
    modal.style.display = "block";
    document.body.style.overflow = 'hidden';
}
btn2.onclick = function () {
    modal2.style.display = "block";
    document.body.style.overflow = 'hidden';
}

span.onclick = function () {
    modal.style.display = "none";
    document.body.style.overflow = 'auto';
}

span2.onclick = function () {
    modal2.style.display = "none";
    document.body.style.overflow = 'auto';
}

window.onclick = function(event) {
    if (event.target == modal || event.target == modal2){
        modal.style.display = "none";
        modal2.style.display = "none";
        document.body.style.overflow = 'auto';
    }
}



const reg_form = document.getElementById("reg_window")

reg_form.onsubmit = async(e) =>{
    e.preventDefault();
    let formData = new FormData(reg_form);
    let xhr = new XMLHttpRequest();
    xhr.open('POST', API_URL);
    xhr.responseType = 'json';
    xhr.send(formData);
    xhr.onload = function(){
        let response = xhr.response;
        let result = response.reg_form;
    }
    /*const name = reg_form.querySelector('[name="name"]'), 
    email = reg_form.querySelector('[name="email"]'); 
    const data = {
        name: name.value,
        email: email.value,
    };
    console.log(data);*/
}


const log_form = document.getElementById("log_window")
log_form.onsubmit=async (e)=>{
    e.preventDefault();
    const name = log_form.querySelector('[name="email"]'), 
    email = log_form.querySelector('[name="password"]'); 
    const data = {
        name: name.value,
        email: email.value,
    };
}

document.addEventListener('DOMContentLoaded', function () {
    var pass1 = document.querySelector('#pwd1'),
    pass2 = document.querySelector('#pwd2')
    pass1.addEventListener('input', function () {
        this.value != pass2.value ? pass2.setCustomValidity('Пароли не совпадают') : pass2.setCustomValidity('')
    })
    pass2.addEventListener('input', function (e) {
        this.value != pass1.value ? this.setCustomValidity('Пароли не совпадают') : this.setCustomValidity('')
    })
})    

document.addEventListener('DOMContentLoaded', function () {
    var pnoheHumber = document.querySelector('#phone');
    pnoheHumber.addEventListener('input', function () {
        this.value < 80000000000 || this.value > 89999999999  ? pnoheHumber.setCustomValidity('Номер не корректен'): this.setCustomValidity('')
    })
})  

