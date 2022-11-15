function convalida(event)
{
    var nome=form.nome.value;
    var cognome=form.cognome.value;
    var email=form.email.value;
    var username=form.username.value;
    var password=form.password.value;
    var confPassword=form.confermaPassword.value;
    var evento=event;

    if(nome == '') {
		setErrorFor(nome_DOM, 'Nome non deve essere vuoto',evento);
	} 

    if(cognome =='') {
		setErrorFor(cognome_DOM, 'Cognome non deve essere vuoto',evento);
	} 
	
	if(email =='') {
		setErrorFor(email_DOM, 'Email non deve essere vuota',evento);
	} 

    function manda()
    {   
        setErrorFor(username_DOM, 'Username gia esistente',evento);
    }

    function onText(text)
    {
        if(text=="exists")
        {
            manda();
        }
    }

    function onResponse(response)
    {
        return response.text();
    }

    if(username == '' || !/^[a-zA-Z0-9_]{1,15}$/.test(username)) {
		setErrorFor(username_DOM, 'Username no vuoto. Amesse lettere,numeri,uderscore.Max 15',evento);
	}else{
        fetch("check_username.php?q="+encodeURIComponent(username)).then(onResponse).then(onText);
    }
	
	if(password == '') {
		setErrorFor(password_DOM, 'Password non deve essere vuota',evento);
	}
	
	if(confPassword == '') {
		setErrorFor(password2_DOM, 'Conferma Password non deve essere vuoto',evento);
	} 

}

function setErrorFor(input,message,event) {
    const control=input.parentElement;
	const small = control.querySelector('small');
    small.classList.remove("hidden");
	small.innerText = message;
    event.preventDefault();
}









const form = document.querySelector(".formregister");
const nome_DOM = document.getElementById('nome');
const cognome_DOM = document.getElementById('cognome');
const username_DOM = document.getElementById('username');
const email_DOM = document.getElementById('email');
const password_DOM = document.getElementById('password');
const password2_DOM = document.getElementById('confermaPassword');
form.addEventListener("submit",convalida);