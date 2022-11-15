function onJson(json){

    console.log(json);

    let left = document.querySelector(".flex_container .flex_left .sub-bottom");
    
    left.innerHTML="";

    let div_box = document.createElement("div");
    let nome= document.createElement("p");
    let cognome= document.createElement("p");
    let username= document.createElement("p");
    let mail= document.createElement("p");

    //assegno i valori ai nuovi oggetti creati


    div_box.appendChild(nome);
    div_box.appendChild(cognome);
    div_box.appendChild(username);
    div_box.appendChild(mail);
    left.appendChild(div_box);

}

function onResponse(response)
{
    console.log('Risposta ricevuta');
    return response.json();
}  


function cerca_utenti(event){

if(form_utenza.nome_utente.value.length == 0)
{
event.preventDefault();  
form_utenza.nome_utente.placeholder="ATTENZIONE!...Digita";  
}
else
{
event.preventDefault();
const nome_utente_cercato=form_utenza.nome_utente.value;
fetch('info_utente.php?utente='+nome_utente_cercato).then(onResponse).then(onJson);
}



}


const form_utenza = document.forms['ricerca_utenti_form'];
form_utenza.addEventListener('submit', cerca_utenti);