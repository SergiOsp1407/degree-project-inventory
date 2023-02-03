
// Receive data using Ajax
let tblUsers, tblClient, tblCashRegister, tblMeasures, tblCategories, tblProducts, t_h_c, t_h_v, t_balance, myModal;

document.addEventListener("DOMContentLoaded", function() {

    myModal = new bootstrap.Modal(document.getElementById('my_modal'));

    $('#client')/select2();
    const buttons = [{
        extend: 'excelHtml5',
        footer: true,
        title: 'Archivo',
        filename: 'Export_File',
        text: '<span class="badge <!--Este bg se cambio en el video 31-->bg-success"><i class="fas fa-file-exce '
    },
    {

        extend: 'pdfHtml5',
        download: 'open',
        footer: true,
        title: 'Reporte de usuarios',
        filename: 'Reporte de usuarios',
        text: '<span class="badge bg-danger"><i class="fas fa-file-p"',
        exportOptions: {
            columns: [0, ':visible']
        }

    },
    {
        extend: 'copyHtml5',
        footer: true,
        title: 'Reporte de usuarios',
        filename: 'Reporte de usuarios',
        text: '<span class="badge bg-primary"><i class="fas fa-copy"',
        exportOptions: {
            columns: [0, ':visible']
        }

    },
    {
        extend: 'print',
        footer: true,
        filename: 'Export_File_print',
        text: '<span class="badge bg-dark"><i class="fas fa-print'

    },
    {
        extend: 'csvHtml5',
        footer: true,
        filename: 'Export_File_csv',
        text: '<span class="badge bg-success"><i class="fas fa-file-csv '

    },
    {
        extend: 'colvis',
        text: '<span class="badge bg-info"><i class="fas fa-columns ',
        postfixButtons: ['colvisRestore']

    }]
    
})



function frmLogin(e){

    e.preventDefault();

    const user = document.getElementById("user");
    const password = document.getElementById("password");

    // Verification of information on inputs holders in login page
    if (user.value == "") {
        password.classList.remove("is-invalid");
        user.classList.add("is-invalid");
        user.focus();        
    }else if(password.vale == ""){
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
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                const response = JSON.parse(this.responseText);
                if (res == "ok") {

                    window.location = base_url + "Usuarios";
                    
                }else{
                    document.getElementById("alert").classList.remove("d-none");
                    document.getElementById("alert").innerHTML = response;
                }
                
            }
        }
    }

}

function frmChangePassword(e) {
    
}

//This function was updated in video 31 when updating Bootstrap
//Function used in User module to create new users
function frmUser() {

    document.getElementById("title").textContent = "Nuevo Usuario";
    document.getElementById("btnAction").textContent = "Registrar";
    document.getElementById("passwords").classList.remove("d-none");
    document.getElementById("frmUser").reset();
    /*This Ajax function was used to show new users
    $("#new_user").modal("show");*/
    myModal.show();

    //Pending verify if this document.getElement have to be erase
    document.getElementById("id").vale = "";
    document.getElementById("title").textContent = "Nuevo Usuario";
    
}

//This function was updated in video 31 when updating Bootstrap
//Function used in User module to register new users
function registerUser(e) {
    e.preventDefault();
    const user = document.getElementById("user");
    const name = document.getElementById("name");
    const cashRegister = document.getElementById("cashRegister");

    if (user.value == "" || name.value == "" || cashRegister.value == "") {

        /*Function using SweetAlert to show custom positioned dialog
        Swal.fire({

            position: 'top-end',
            icon: 'error',
            title: 'Debes llenar todos los campos!',
            showConfirmButton: false,
            timer: 2500

        })*/

        alerting('Todos los campos son obligatorios!' , 'warning');
        
    }else{
        // Petiton with Ajax
        const url = base_url + "Users/register";
        const frm = document.getElementById("frmUser");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        
        http.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
                const response = JSON.parse(this.responseText);
                myModal.hide();
                alerting(response.message, this.response.icon);
                tblUsers.ajax.reload();
                
            }            
        }
    }    
}

//This function was updated in video 31 when updating Bootstrap
//Function used in User module to edit users
function btnEditUser(id) {

    document.getElementById("title").textContent = "Actualizar usuario";
    document.getElementById("btnAction").textContent = "Modificar";
    const url = base_url + "Users/edit/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {

            const response = JSON.parse(this.responseText);
            document.getElementById("id").value = response.id;
            document.getElementById("user").value = response.user;
            document.getElementById("name").value = response.name;
            document.getElementById("cashRegister").value = response.id_cash_register;
            document.getElementById("passwords").classList.add("d-none");
            myModal.show();
            
        }
    }
    
}

function btnDeleteUser(id){

    Swal.fire({
        title: '¿Estas seguro de eliminarlo?',
        text: "Esta acción no eliminará de manera permanente, cambiará el estado a Inactivo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminalo!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Users/delete/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    if (response == "ok") {

                        Swal.fire(
                            'Mensaje!',
                            'Usuario eliminado con exito',
                            'success'
                        )
                        
                        tblUsers.ajax.reload();
                        
                    }else{

                        Swal.fire(
                            'Mensaje!',
                            response,
                            'error'
                        )     

                    }                    
                }
            }            
        }
      })
}

function btnReenterUser(id) {

    Swal.fire({
        title: '¿Estas seguro de reingresar el usuario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Users/reenter/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    if (response == "ok") {

                        Swal.fire(
                            'Mensaje!',
                            'Usuario eliminado con exito',
                            'success'
                        )
                        
                        tblUsers.ajax.reload();
                        
                    }else{

                        Swal.fire(
                            'Mensaje!',
                            response,
                            'error'
                        )     

                    }                    
                }
            }            
        }
      })
    
}

//End Users


//This function was updated in video 31 when updating Bootstrap
function frmClient() {

    document.getElementById("title").innerHTML = "Nuevo Cliente";
    document.getElementById("btnAction").innerHTML = "Registrar";
    document.getElementById("frmClient").reset();
    myModal.show();
    document.getElementById("id").value = "";
    
}

function registerClient(e) {
    e.preventDefault();
    const dni_client = document.getElementById("dni");
    const name = document.getElementById("name");
    const phone = document.getElementById("phone");
    const address = document.getElementById("address");

    if (dni_client.value == "" || name.value == "" || phone.value == "" || address.value == "") {

        // Swal.fire({

        //     position: 'top-end',
        //     icon: 'error',
        //     title: 'Debes llenar todos los campos!',
        //     showConfirmButton: false,
        //     timer: 2500

        // })

        alerting('Todos los campos son obligatorios!' , 'warning');
        
    }else{
        // Petiton with Ajax
        const url = base_url + "Clients/register";
        const frm = document.getElementById("frmClient");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        
        http.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
                const response = JSON.parse(this.responseText);
                myModal.hide();
                alerting(response.message, this.response.icon);
                //tblUsers.ajax.reload();
                
            }            
        }
    }    
}

//This function was updated in video 31 when updating Bootstrap
//Function used in User module to edit users
function btnEditUser(id) {

    document.getElementById("title").textContent = "Actualizar usuario";
    document.getElementById("btnAction").textContent = "Modificar";
    const url = base_url + "Users/edit/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {

            const response = JSON.parse(this.responseText);
            document.getElementById("id").value = response.id;
            document.getElementById("user").value = response.user;
            document.getElementById("name").value = response.name;
            document.getElementById("cashRegister").value = response.id_cash_register;
            document.getElementById("passwords").classList.add("d-none");
            myModal.show();
            
        }
    }
    
}

function btnDeleteUser(id){

    Swal.fire({
        title: '¿Estas seguro de eliminarlo?',
        text: "Esta acción no eliminará de manera permanente, cambiará el estado a Inactivo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminalo!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Users/delete/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    if (response == "ok") {

                        Swal.fire(
                            'Mensaje!',
                            'Usuario eliminado con exito',
                            'success'
                        )
                        
                        tblUsers.ajax.reload();
                        
                    }else{

                        Swal.fire(
                            'Mensaje!',
                            response,
                            'error'
                        )     

                    }                    
                }
            }            
        }
      })
}

function btnReenterUser(id) {

    Swal.fire({
        title: '¿Estas seguro de reingresar el usuario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Users/reenter/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    if (response == "ok") {

                        Swal.fire(
                            'Mensaje!',
                            'Usuario eliminado con exito',
                            'success'
                        )
                        
                        tblUsers.ajax.reload();
                        
                    }else{

                        Swal.fire(
                            'Mensaje!',
                            response,
                            'error'
                        )     

                    }                    
                }
            }            
        }
      })
    
}