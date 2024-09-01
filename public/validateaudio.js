// let valider = document.getElementById("valider");
// let rejeter = document.getElementById("rejeter");

let validateButton = document.getElementsByClassName("valider")
let validateButtonsArray = Array.from(validateButton);
validateButtonsArray.forEach(button=>{
    button.addEventListener("click",()=>{
        let audioId = button.getAttribute('data-audio-id');
        validate("valid",audioId)
        console.log(audioId)
        let divCard = button.closest(".admin_message")
         if(divCard){
            divCard.remove();
         }
        });
});


let rejectedButton = document.getElementsByClassName("rejeter")
let rejectedButtonsArray = Array.from(rejectedButton);
rejectedButtonsArray.forEach(button=>{
    button.addEventListener("click",()=>{
        let audioId = button.getAttribute('data-audio-id');
        validate("rejected",audioId)
        let divCard = button.closest(".admin_message")
         if(divCard){
            divCard.remove();
         }
        });
});



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
      .then(data => {
        console.log(data)
        let successMessage = document.getElementById('success-message');
        successMessage.textContent = data.success;
        successMessage.style.display = 'block';
        setTimeout(()=>{
            successMessage.classList.add("fade-in");
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 100);
        },1000);
      })
      .catch(error => {
        console.error('Error:', error);
      });
    
}

