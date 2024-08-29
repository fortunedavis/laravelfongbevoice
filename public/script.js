const speakcard = document.getElementsByClassName("speak_card")[0];
const compl = document.getElementById("speak_complement");


if(speakcard){
    speakcard.addEventListener("mouseover", () => {
        compl.textContent = "Nɔ ɖ’alɔ ɖò nǔwiwa ɔ mɛ gbɔn gbè towe nina gblamɛ"; 
    });
    
    speakcard.addEventListener("mouseout", () => {
        compl.textContent = ""; // Restore initial text on mouse out
    });
    
}

const listencard = document.getElementsByClassName("listen_card")[0];
const listencomplement = document.getElementById("listen_complement");


if(listencard){
  
    // console.log(speakcard)
    listencard.addEventListener("mouseover", () => {
        listencomplement.textContent = "D’alɔ mǐ bɔ mǐ na kpɔ́n mɛ e ɖ’alɔ ɖò nǔwiwa ɔ mɛ lɛ é"; // This will replace the existing text
        // Or use compl.append("Fongbe dié"); if you want to append instead of replacing the text
    });

    listencard.addEventListener("mouseout", () => {
        listencomplement.textContent = ""; // Restore initial text on mouse out
    });
}


// listencard.classList.
const navelements = document.getElementsByClassName("mobile_elements")[0]
const fimenuburger = document.getElementById("fi_menu_burger_mobile")

let navelements_value = navelements.style.display

fimenuburger.addEventListener("click",()=>{

    if (navelements.style.display == "none"){
        navelements.style.display = "block";
    }else{
     navelements.style.display = "none";

    }
   
 });


 let myform = document.getElementById("myForm");
 let close = document.getElementById("close");
 
 // myform.addEventListener("click",()=>{
 //   document.getElementById("myForm").style.display = "none";
 // });
 
 close.addEventListener("click",()=>{
   document.getElementById("myForm").style.display = "none";
 });
 
 let navlogin =  document.querySelectorAll(".nav_login");
 navlogin.forEach(el => {
   el.addEventListener("click",()=>{
     document.getElementById("myForm").style.display = "block";
   });
 });
 
 let registerclose = document.getElementById("register_close");
 registerclose.addEventListener("click",()=>{
   document.getElementById("registerForm").style.display = "none";
 });
 
 let navregister =  document.querySelectorAll(".nav_register");
 navregister.forEach(el => {
    console.log("regsiter")
   el.addEventListener("click",()=>{
     document.getElementById("registerForm").style.display = "block";
   });
 });
 
 
 
//  let registerform  = document.getElementById("reg_form");
 
//  document.getElementById("register_submit").addEventListener('click',()=>{
// //    registerform.submit();
//    console.log("register")
//    console.log(registerform)
//  });
 
 
//  let connexionform = document.getElementById("connexion_form");
 
//  document.getElementById("connexion_submit").addEventListener('click',()=>{
//    connexionform.submit();
// //    console.log("connexion")
 
//  });

