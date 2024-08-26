document.getElementById('upload').addEventListener('click', function() {
    var fileInput = document.getElementById('sortpicture');
    var file_data = fileInput.files[0];  

    var form_data = new FormData();                  
    form_data.append('file', file_data);
    // alert(form_data);                             

    fetch('upload.php', {
        method: 'POST',
        body: form_data
    })
    .then(response => response.text()) // assuming the server returns text
    .then(php_script_response => {
        alert(php_script_response); // <-- display response from the PHP script, if any
    })
    .catch(error => console.error('Error:', error));
});



async function post(request) {
    try {
      const response = await fetch(request);
      const result = await response.json();
      console.log("Success:", result);
    } catch (error) {
      console.error("Error:", error);
    }
  }
  
  const request1 = new Request("https://example.org/post", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ username: "example1" }),
  });

  
  post(request1)