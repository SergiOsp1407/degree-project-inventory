
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
function frmUser() {

    document.getElementById("title").textContent = "Nuevo Usuario";
    document.getElementById("btnAction").textContent = "Registrar";
    document.getElementById("passwords").classList.remove("d-none");
    document.getElementById("frmUser").reset();
    /*This Ajas function was used to show new users
    $("#new_user").modal("show");*/
    myModal.show();
    document.getElementById("title").textContent = "Nuevo Usuario";
    
}

//This function was updated in video 31 when updating Bootstrap
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
function btnEditUser(id) {

    document.getElementById("title").textContent = "Actualizar usuario";
    document.getElementById("btnAction").textContent = "Modificar";
    const url = base_url + "Users/edit" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {

            const response = JSON.parse(this.responseText);
            document.getElementById("id").value = response.id;
            document.getElementById("user").value = response.user;
            document.getElementById("name").value = response.name;
            document.getElementById("cashRegister").value = response.id_caja;
            document.getElementById("passwords").classList.add("d-none");
            myModal.show();
            
        }
    }
    
}

function btnDeleteUser(id){

}

function btnreEnterUser(id) {
    
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

function registerClient(e){

}