document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();
    let formData = {
        email : document.getElementById("email").value,
        password : document.getElementById("toggle").value,
        remember : document.getElementById("flexSwitchCheckDefault").value,
        _token : document.getElementById("_token").value
    };
    alert(formData.email);
    /*const url = '';
    let fetchData = {
        method : "POST",
        body: JSON.stringify(formData),
        headers : new Headers({
            'Content-Type' : 'application/json; charset=UTF-8'
        })
    };
    fetch(url, fetchData)
    .then(function(response){
        return response.json();
    })
    .then(function(data){
        if(data){

        }
    })
    .catch(function(){

    })*/
})