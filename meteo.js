//Essendo un API KEY ho ottenuto la chiave traite registrazione al sito https://home.openweathermap.org/api_keys
const appid="5f8df21211323f74fc4ae4f892f857f6";



function onJson(json){
    console.log(json);

    const div = document.querySelector('.Meteo .result');
    div.innerHTML = '';

    const città = document.createElement("h1");
    const latitude = document.createElement("p");
    const longitude=document.createElement("p");
    const umidity=document.createElement("p");
    const press=document.createElement("p");
    const tempture=document.createElement("p");

    città.textContent="CITTA:"+json.name;
    latitude.textContent="LATITUDINE:"+json.coord['lat'];
    longitude.textContent="LONGITUDINE:"+json.coord['lon'];
    umidity.textContent="UMIDITA':"+json.main['humidity'];
    press.textContent="PRESSIONE:"+json.main['pressure'];
    tempture.textContent="TEMPERATURA:"+(json.main['temp']-273,15);

    div.appendChild(città);
    div.appendChild(latitude);
    div.appendChild(longitude);
    div.appendChild(umidity);
    div.appendChild(press);
    div.appendChild(tempture);

}


function onResponse(response){
    console.log('Risposta ricevuta');
    return response.json();
}



/*function OnError(error){
    console.log('Errore: '+ error)
}*/




function requestApi(event){

    event.preventDefault();
    const text_in = document.querySelector('.Meteo #input');
    const text_value = encodeURIComponent(text_in.value);
    fetch("http://api.openweathermap.org/data/2.5/weather?q="+text_value+",Italy&appid=5f8df21211323f74fc4ae4f892f857f6").then(onResponse).then(onJson)

}

//event listener per API METEO
let meteo_form = document.querySelector('.Meteo form');
meteo_form.addEventListener('submit', requestApi);