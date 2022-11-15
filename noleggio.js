
function onJson(json){
    console.log(json);

    const proprietario=document.querySelector('#proprietario');
    proprietario.innerHTML="";

    const div=document.createElement('div');
    proprietario.appendChild(div);

    const h1=document.createElement('h1');
    const codice_fiscale=document.createElement('p');
    const nome=document.createElement('p');
    const cognome=document.createElement('p');
    const eta=document.createElement('p');

    h1.textContent="DATI DEL PROPRIETARIO";
    codice_fiscale.textContent="CODICE FISCALE:"+json.codFiscale_prop;
    nome.textContent="NOME PROP:"+json.nome_prop;
    cognome.textContent="COGNOME PROP:"+json.cognome_prop;
    eta.textContent="ETA PROP"+json.eta_prop;

    div.appendChild(h1);
    div.appendChild(codice_fiscale);
    div.appendChild(nome);
    div.appendChild(cognome);
    div.appendChild(eta);
}


function onResponse(response){
    return response.json();
    
}



function convalida(event)
{
    if(form.marca.value=="")
    {
        alert("ATTENZIONE! INSERIRE LA MARCA DELL'AUTO/CAMION/MOTO CERCATA");
        
    }
    else
    {
        event.preventDefault();
        const marca=form.marca.value;
        const veicolo=form.veicolo.value;
        const volume=form.volume.value;
        const anno=form.anno.value;
        fetch('noleggio.php?marca='+marca+'&veicolo='+veicolo+'&volume='+volume+'&anno='+anno).then(onResponse).then(onJson);

    }

}


const form = document.forms['noleggio_form'];
form.addEventListener("submit",convalida);