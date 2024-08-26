

function createAudioControlElement(audioNumber,listItem) {
    // Create the <p> element for the audio number
    const pElement = document.createElement('p');
    pElement.className = 'audio_number';
    pElement.textContent = audioNumber;

    // Create the play button with an icon
    const playButton = document.createElement('button');
    playButton.className = 'audio-button replay-button';
    const playIcon = document.createElement('i');
    playIcon.className = 'fi fi-rr-play';
    playButton.appendChild(playIcon);

    playButton.addEventListener('click', function(e) {
    
      const liParent = playButton.closest('li.audio_item');
      const ownAudio = liParent.querySelector('audio');
        if (ownAudio) {
          // console.log("playing")
          ownAudio.play();
        }
  });

    // Create the re-speak button with an icon
    const reSpeakButton = document.createElement('button');
    reSpeakButton.className = 'audio-button re-speak-button';
    const reSpeakIcon = document.createElement('i');
    reSpeakIcon.className = 'fi fi-rr-rotate-left';
    reSpeakButton.appendChild(reSpeakIcon);

    reSpeakButton.addEventListener('click', function(e) {
    
      const liReSpeak = reSpeakButton.closest('li.audio_item');
      const reSpeakAudio = liReSpeak.querySelector('audio');
      const audio_id = reSpeakAudio.id

      replayMessage(audio_id);
      
    });


    // Create the delete button with an icon
    const deleteButton = document.createElement('button');
    deleteButton.className = 'audio-button delete-button';
    const deleteIcon = document.createElement('i');
    deleteIcon.className = 'fi fi-rr-x';
    deleteButton.appendChild(deleteIcon);

    deleteButton.addEventListener('click', function(e) {
    
      const liDel = deleteButton.closest('li.audio_item');
      const del_id = liDel.id
      audioList.pop(del_id)
      updateButtonStates(audioList, maxRecordings, buttonStart, submitButton);
      liDel.remove();
      const allLi = document.querySelectorAll(".audio_item");

      allLi.forEach((p, index) => {
        const pTag = p.querySelector('.audio_number');
        
        if (pTag) {
            pTag.textContent = index + 1;
        }
      });

    });
 
    listItem.appendChild(pElement);
    listItem.appendChild(playButton);
    listItem.appendChild(reSpeakButton);
    listItem.appendChild(deleteButton);
}





// for the audio  
let audioList = [];
let recordedMessageList = [];


const maxRecordings = 5;
const submitButton = document.getElementById('submitButton');
const audioListElement = document.getElementById('audioList');
// const audioFilesInput = document.getElementById('audioFiles');
const userTextElement = document.getElementById('user_text');
const skipedButton = document.getElementById('skipped');

const buttonStart = document.querySelector('#buttonStart')
const buttonStop = document.querySelector('#buttonStop')

let container = new DataTransfer();

const blobs = [];

const files = []
async function main () {
    try {
     
      const audio = document.querySelector('#audio')
   
      const stream = await navigator.mediaDevices.getUserMedia({ // <1>
        video: false,
        audio: true,
      })
  
      const [track] = stream.getAudioTracks()
      const settings = track.getSettings() // <2>
  
      const audioContext = new AudioContext() 
      await audioContext.audioWorklet.addModule('audio-recorder.js') // <3>
  
      const mediaStreamSource = audioContext.createMediaStreamSource(stream) // <4>
      const audioRecorder = new AudioWorkletNode(audioContext, 'audio-recorder') // <5>
      const buffers = []
  
      audioRecorder.port.addEventListener('message', event => { // <6>
        buffers.push(event.data.buffer)
      })
      audioRecorder.port.start() // <7>
  
      mediaStreamSource.connect(audioRecorder) // <8>
      audioRecorder.connect(audioContext.destination)
      

      
      buttonStart.addEventListener('click',event => {

        if (audioList.length >= maxRecordings) return;
          buttonStart.classList.add("pause")
          buttonStop.classList.remove("pause")
          
          const parameter = audioRecorder.parameters.get('isRecording')
          parameter.setValueAtTime(1, audioContext.currentTime) 
          buffers.splice(0, buffers.length)
      });
      
      
      buttonStop.addEventListener('click', event => {
       
        buttonStop.classList.add("pause")
        buttonStart.classList.remove("pause")
        displayMessage(getData)

        const parameter = audioRecorder.parameters.get('isRecording')
        parameter.setValueAtTime(0, audioContext.currentTime) // <10>
        const blob = encodeAudio(buffers, settings) // <11>
        const url = URL.createObjectURL(blob)
        
        const ids = recordedMessageList.flat().map(item => item.id);

        const msg_id = ids[ids.length - 1]
        audioList.push(url)
        const file = new File([blob], `${msg_id}.wav`, {
          type: 'audio/wav',
          lastModified: Date.now()
        });

        files.push(file);
        const listItem = document.createElement('li');
        listItem.className = "audio_item";
        const audioElement = document.createElement('audio');
        audioElement.controls = true;
        audioElement.src = url;
        audioElement.id = msg_id;
        listItem.appendChild(audioElement);
        createAudioControlElement(audioList.length,listItem);
        audioListElement.appendChild(listItem);
        updateButtonStates(audioList, maxRecordings, buttonStart, submitButton);

      })

      skipedButton.addEventListener('click',event=>{
        recordedMessageList.pop(-1);
        
        displayMessage(getData)

      })

      submitButton.addEventListener('click',event=>{
        newsave();
        // empty the li 
        while (audioListElement.hasChildNodes()){
            audioListElement.removeChild(audioListElement.firstChild)
        }
        // get a new data
        displayMessage(getData)

        // set the audio list to 0
        audioList = []
        
        // set the recorded message list to 0
        recordedMessageList = []

        updateButtonStates(audioList, maxRecordings, buttonStart, submitButton);

      });
      
    } catch (err) {
      console.error(err)
    }
  }
  main()
  
  function updateButtonStates(audioList, maxRecordings, buttonStart, submitButton) {
    if (audioList.length >= maxRecordings) {
        buttonStart.disabled = true;
        submitButton.disabled = false;
        skipedButton.disabled = true;
        skipedButton.style.display ="none";

    } else {
        buttonStart.disabled = false;
        submitButton.disabled = true;
        skipedButton.disabled= false;
        skipedButton.style.display ="block";

    }
}

function newsave(){
  const formData = new FormData();
  // console.log(files)
  for (let i = 0; i < files.length; i++) {
    formData.append('files[]', files[i]); 
   
}
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  fetch('/records/upload', {
    method: 'POST',
    headers: {
      "X-CSRF-TOKEN": token  
    },
    body: formData
  })
  .then(response => response.json()) 
  .then(data => {
    console.log('Success:', data);

  })
  .catch(error => {
    console.error('Error:', error);
  });
}


  async function saveRecord() {
    const formData = new FormData();
    formData.append('files',files[0]);
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const saveRequest = new Request("records/upload", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": token  
        },
        body: formData
    });
    try {
        const response = await fetch(saveRequest);

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const responseData = await response.json();
        // console.log('Response:', responseData);
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
}



async function getData() {
    const url = "/messages";
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


async function findData(message_id) {
    const url = `/messages/findMessage/${message_id}`;
    try {
      const response = await fetch(url);
      if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
      }
  
      const message = await response.json();
      
      return message;

    } catch (error) {
      console.error(error.message);
    }
  }

async function replayMessage(id){
  const message = await findData(id);
  if (message) {
    userTextElement.textContent = message['message'];
  } else {
    userTextElement.textContent = "No message received.";
  }
}

async function displayMessage(fn) {
  const message = await fn();
  if (message) {
    userTextElement.textContent = message[0]['message'];
    // console.log("'checking")
    recordedMessageList.push(message)
    // console.log(recordedMessageList)

  } else {
    userTextElement.textContent = "No message received.";
  }
}

const zip = (arr, ...arrs) => {
  return arr.map((val, i) => arrs.reduce((a, arr) => [...a, arr[i]], [val]));
}
 
document.addEventListener('DOMContentLoaded', displayMessage(getData));
  
  
const dataArray = [];

  
function toSend(audio,message_id){
  return{
   'audio':audio,
   'message_id' :message_id
  }
}

