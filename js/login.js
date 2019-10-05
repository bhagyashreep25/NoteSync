function switch_tab(tab) {
    if(tab=='log'){
        document.getElementById('login-div').style.display = 'flex';
        document.getElementById('register-div').style.display = 'None';
        document.getElementById('login_tab').style.backgroundColor = '#E2EAEF';
        document.getElementById('login_tab').style.color = '#23416B';
        document.getElementById('reg_tab').style.backgroundColor = 'transparent';
        document.getElementById('reg_tab').style.color = 'white';
    }
    else{
        document.getElementById('login-div').style.display = 'None';
        document.getElementById('register-div').style.display = 'flex';
        document.getElementById('login_tab').style.backgroundColor = 'transparent';
        document.getElementById('login_tab').style.color = 'white';
        document.getElementById('reg_tab').style.backgroundColor = '#E2EAEF';
        document.getElementById('reg_tab').style.color = '#23416B';
    }
}

function login() {
    email = document.getElementById('email').value;
    password = document.getElementById('password').value;
    data = {
        'email': email,
        'password': password,
    }
    console.log(data);
}

function register() {
    name = document.getElementById('name').value;
    email = document.getElementById('email').value;
    phone = document.getElementById('phone').value;
    password = document.getElementById('password').value;
    
    data = {
        'name': name,
        'email': email,
        'phone': phone,
        'password': password,
    }
    console.log(data);
}