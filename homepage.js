

function onText(text){

            console.log(text);

            
            let div = document.createElement("div");

            let desc = document.createElement("p");
            let poster = document.createElement("img");

            //Separo la parte scritta con l'immagine
            let div_left = document.createElement("div");
            let div_right = document.createElement("div");

            let center = document.querySelector(".flex_center .bacheca");
        

            desc.textContent = text;
            poster.src ="";

            center.appendChild(div);
            
            div.appendChild(div_left);
            div.appendChild(div_right);
            div_left.appendChild(desc);
            div_right.appendChild(poster);

            div.classList.add("post");
            div_left.classList.add("post_left");
            div_right.classList.add("post_right");

            let cancella = document.querySelector(".creazione form textarea");
            cancella.value = "";

    }

    function onResponse(response)
        {
            console.log('Risposta ricevuta');
            return response.text();
        }  


function crea_post(event){

    if(form.text_area.value.length == 0)
    {
        event.preventDefault();  
        form.text_area.placeholder="ATTENZIONE!... Non hai scritto nulla nella descrizione";  
    }
    else
    {
        event.preventDefault();
        const descrizione=form.text_area.value;
        fetch('homepage.php?descrizione='+descrizione).then(onResponse).then(onText);
    }



}

//Aggiungo l'event listener al submit per la creazione dei post

const form = document.forms['creazione_form'];
form.addEventListener('submit', crea_post);
