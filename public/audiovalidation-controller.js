
const TextElement = document.getElementById('listen_text');
const audioArea = document.getElementById("audio_area");
const buttonArea =  document.getElementById("button_area");

const creatButton = (id,audio_id,text,classlist,state)=>{
    let button = document.createElement("button")
    button.textContent = text;
    button.id=id;
    const classl = classlist.split(" ");
    classl.forEach(className => button.classList.add(className));
    buttonArea.appendChild(button)

    button.addEventListener('click',()=>{
        validate(state,audio_id);
        while (audioArea.hasChildNodes()){
            audioArea.removeChild(audioArea.firstChild)
        }
         while (buttonArea.hasChildNodes()){
            buttonArea.removeChild(buttonArea.firstChild)
        }
        displayMessage(getData)
    });

}


async function getData() {
    const url = "/listen/message";
    try {
      const response = await fetch(url);
      if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
      }
      const message = await response.json();
      console.log("ok")
      return message;

    } catch (error) {
      console.error(error.message);
    }
  }

const createAudio = (id,path) => {
    let audio = document.createElement("audio");
    audio.controls = true
    audio.id = id
    audio.src = path
    audioArea.appendChild(audio)
}



async function displayMessage(fn) {
    const message = await fn();
    if (message) {
      TextElement.textContent = message['message'];
      createAudio(message["record_id"],message["path"]);
      creatButton("valider",message["record_id"],"Valider","valider admin_button admin_valider","valid")
      creatButton("rejeter",message["record_id"],"Rejeter","rejeter admin_button admin_rejeter","rejected")
    } else {
      TextElement.textContent = "evo!!!";
    }
  }

document.addEventListener('DOMContentLoaded', displayMessage(getData));


// validation


const validate = (state,record_id) =>{
    const data = {
        "state":state,
        "record_id":record_id
    }
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/records/update', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          "X-CSRF-TOKEN": token  
        },
        body: JSON.stringify(data)
      })
      .then(response => response.json()) 
      .then(data=>{
        console.log(data)
      })
      .catch(error => {
        console.error('Error:', error);
      });
    
}

