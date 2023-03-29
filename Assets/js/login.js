function frmLogin(e){
    e.preventDefault();
    const user = document.getElementById("user");
    const password = document.getElementById("password");

    // Verification of information on inputs holders in login page
    if (user.value == "") {
        password.classList.remove("is-invalid"); 
        user.classList.add("is-invalid");
        user.focus();       
    }else if(password.value == ""){
        user.classList.remove("is-invalid");   
        password.classList.add("is-invalid");
        password.focus();
    }else{
        // Petiton with Ajax
        const url = base_url + "Users/validate";
        const frm = document.getElementById("frmLogin");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        window.location.reload(); // se agrega funcion de recarga de pagina para ingresar al home 
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                const response = JSON.parse(this.responseText);
                if ( response == "ok") {
                    window.location = base_url + "Administration/home";                                
                    // window.location = base_url + "Users";  
                }else{
                    document.getElementById("alerts").classList.remove("d-none");
                    document.getElementById("alerts").innerHTML = response;
                }                
            }
        }
    }
}