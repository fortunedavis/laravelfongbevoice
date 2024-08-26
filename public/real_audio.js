// collect DOMs
const display = document.querySelector('.display')
const controllerWrapper = document.querySelector('.controllers')

const State = ['Initial', 'Record', 'Download']
let stateIndex = 0
let mediaRecorder, chunks = [], audioURL = ''
const blobsArray = []

// mediaRecorder setup for audio
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia){
    console.log('mediaDevices supported..')

    navigator.mediaDevices.getUserMedia({
        audio: true
    }).then(stream => {
        mediaRecorder = new MediaRecorder(stream)

        mediaRecorder.ondataavailable = (e) => {
            chunks.push(e.data)
        }

        mediaRecorder.onstop = () => {
            const blob = new Blob(chunks, {'type': 'audio/wav; codecs=opus'})
            chunks = []
            audioURL = window.URL.createObjectURL(blob)
            document.querySelector('audio').src = audioURL
            filetransfert(blob,"zerty");
        }
    }).catch(error => {
        console.log('Following error has occured : ',error)
    })
}else{
    stateIndex = ''
    application(stateIndex)
}

const clearDisplay = () => {
    display.textContent = ''
}

const clearControls = () => {
    controllerWrapper.textContent = ''
}

const record = () => {
    stateIndex = 1
    mediaRecorder.start()
    application(stateIndex)
}

const stopRecording = () => {
    stateIndex = 2
    mediaRecorder.stop()
    application(stateIndex)
}

const downloadAudio = () => {
    const downloadLink = document.createElement('a')
    downloadLink.href = audioURL
    downloadLink.setAttribute('download', 'audio')
    downloadLink.click()
}

const addButton = (id, funString, text) => {
    const btn = document.createElement('button')
    btn.id = id
    btn.setAttribute('onclick', funString)
    btn.textContent = text
    controllerWrapper.append(btn)
}

const addMessage = (text) => {
    const msg = document.createElement('p')
    msg.textContent = text
    display.append(msg)
}

const addAudio = () => {
    const audio = document.createElement('audio')
    audio.controls = true
    audio.src = audioURL
    display.append(audio)
}

const submit = () =>{

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        const audioFile = document.getElementById("input");
        const formData = new FormData();

        const Data = blobsArray[0][0];
        console.log(Data)
        // formData.append('files', audioFile.files[0]);
        formData.append('files', Data);
        
        fetch('/records/upload',{
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

const application = (index) => {
    switch (State[index]) {
        case 'Initial':
            clearDisplay()
            clearControls()

            addButton('record', 'record()', 'Start Recording')
            break;

        case 'Record':
            clearDisplay()
            clearControls()

            addMessage('Recording...')
            addButton('stop', 'stopRecording()', 'Stop Recording')
            break

        case 'Download':
            clearControls()
            clearDisplay()

            addAudio()
            addButton('record', 'record()', 'Record Again')
            addButton('record', 'submit()', 'Submit')
            break

        default:
            clearControls()
            clearDisplay()

            addMessage('Your browser does not support mediaDevices')
            break;
    }

}

application(stateIndex)

const filetransfert = (blob,msg_id) => {

    let clip_audio = document.getElementById("input");
    let bloc = document.getElementById("ta");

    const audioType = "audio/wav";

    let file = new File([blob], `${msg_id}.wav`, {
        type: audioType,
        lastModified: new Date().getTime(),
    });

    let container = new DataTransfer();
    container.items.add(file);

    clip_audio.files = container.files;

    blobsArray.push(container.files)
   
}