
// Receive data using Ajax
let tblUsers, tblClients, tblCashRegister, tblMeasures, tblCategories, tblProducts, t_h_c, t_h_v, t_balance, myModal;

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

    }

    ]

    const dom = "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" + 
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>";

    tblUsers = $('#tblUsers').DataTable({

        ajax: {

            url: base_url + "Users/list",
            dataSrc: ''
        },
        columns: [

            {
                'data' : 'id'
            },
            {
                'data' : 'user'
            },
            {
                'data' : 'id_cash_register'
            },
            {
                'data' : 'status'
            },
            {
                'data' : 'actions'
            }

        ]
    });
    //End table Users

    tblClients = $('#tblClients').DataTable({

        ajax: {

            url: base_url + "Clients/list",
            dataSrc: ''
        },
        columns: [

            {
                'data' : 'id'
            },
            {
                'data' : 'dni_client'
            },
            {
                'data' : 'name'
            },
            {
                'data' : 'phone'
            },
            {
                'data' : 'address'
            },
            {
                'data' : 'status'
            },
            {
                'data' : 'actions'
            }

        ]
    });

    //End table clients

    tblCashRegister = $('#tblCashRegister').DataTable({

        ajax: {

            url: base_url + "CashRegister/list",
            dataSrc: ''
        },
        columns: [

            {
                'data' : 'id'
            },
            {
                'data' : 'cash_register'
            },
            {
                'data' : 'id_cash_register'
            },
            {
                'data' : 'status'
            },
            {
                'data' : 'actions'
            }

        ]
    });
    //End table CashRegister


    tblMeasures = $('#tblMeasures').DataTable({

        ajax: {

            url: base_url + "Measures/list",
            dataSrc: ''
        },
        columns: [

            {
                'data' : 'id'
            },
            {
                'data' : 'name'
            },
            {
                'data' : 'short_name'
            },
            {
                'data' : 'status'
            },
            {
                'data' : 'actions'
            }

        ]
    });
    //End table Medidas


    tblCategories = $('#tblCategories').DataTable({

        ajax: {

            url: base_url + "Categories/list",
            dataSrc: ''
        },
        columns: [

            {
                'data' : 'id'
            },
            {
                'data' : 'name'
            },
            {
                'data' : 'status'
            },
            {
                'data' : 'actions'
            }

        ]
    });
    //End table Categories


    tblProducts = $('#tblProducts').DataTable({

        ajax: {

            url: base_url + "Products/list",
            dataSrc: ''
        },
        columns: [

            {
                'data' : 'id'
            },
            {
                'data' : 'code'
            },
            {
                'data' : 'image'
            },
            {
                'data' : 'description'
            },
            {
                'data' : 'selling_price'
            },
            {
                'data' : 'amount'
            },
            {
                'data' : 'status'
            },
            {
                'data' : 'actions'
            },

        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        // buttons: [
        //     'copyHtml5',
        //     'excelHtml5',
        //     'csvHtml5',
        //     'pdfHtml5'
        // ]
        buttons: [{

            //Excel button
            extend: 'excelHtml5',
            footer: true,
            title: 'Archivo',
            filename: 'Export_File',

            //Personalize button
            text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
        },
        //PDF button
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Copy button
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Print button
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
        },
        //CVS button
        {
            extend: 'csvHtml5',
            footer: true,
            filename: 'Export_File_csv',
            text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
        },
        {
            extend: 'colvis',
            text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
    ]
    });
    //End table Products

   $('#t_history_purchase').DataTable({

        ajax: {

            url: base_url + "Purchases/list_history",
            dataSrc: ''
        },
        columns: [

            {
                'data' : 'id'
            },
            {
                'data' : 'total'
            },
            {
                'data' : 'purchase_date'
            },
            {
                'data' : 'actions'
            }
        ]
    });
    //End table Medidas

})


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
    document.getElementById("id").value = "";
    
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
function btnEditClient(id) {

    document.getElementById("title").textContent = "Actualizar cliente";
    document.getElementById("btnAction").textContent = "Modificar";
    const url = base_url + "Clients/edit/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {

            const response = JSON.parse(this.responseText);
            document.getElementById("id").value = response.id;
            document.getElementById("dni").value = response.dni;
            document.getElementById("name").value = response.name;
            document.getElementById("phone").value = response.phone;
            document.getElementById("address").value = response.address;
            myModal.show();
            
        }
    }
    
}

function btnDeleteClient(id){

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

            const url = base_url + "Clients/delete/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    if (response == "ok") {

                        Swal.fire(
                            'Mensaje!',
                            'Cliente eliminado con exito',
                            'success'
                        )
                        
                        tblClients.ajax.reload();
                        
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

function btnReenterClient(id) {

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

            const url = base_url + "Clients/reenter/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    if (response == "ok") {

                        Swal.fire(
                            'Mensaje!',
                            'Cliente reingresado con exito',
                            'success'
                        )
                        
                        tblClients.ajax.reload();
                        
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

//End Clients

function frmCategory() {

    document.getElementById("title").textContent = "Nuevo Usuario";
    document.getElementById("btnAction").textContent = "Registrar";
    document.getElementById("passwords").classList.remove("d-none");
    document.getElementById("frmUser").reset();
    /*This Ajax function was used to show new users
    $("#new_user").modal("show");*/
    myModal.show();

    //Pending verify if this document.getElement have to be erase
    document.getElementById("id").value = "";
    document.getElementById("title").textContent = "Nuevo Usuario";
    
}

//This function was updated in video 31 when updating Bootstrap
//Function used in User module to register new users
function registerCategory(e) {
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


//Function used in Category module to edit users
function btnEditCategory(id) {

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

function btnDeleteCategory(id){

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

function btnReenterCategory(id) {

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
//End Categories

/*
function frmCashRegister() {

    document.getElementById("title").textContent = "Nuevo Usuario";
    document.getElementById("btnAction").textContent = "Registrar";
    document.getElementById("passwords").classList.remove("d-none");
    document.getElementById("frmUser").reset();
    /*This Ajax function was used to show new users
    $("#new_user").modal("show");*/
    /*myModal.show(); 

    //Pending verify if this document.getElement have to be erase
    document.getElementById("id").value = "";
    document.getElementById("title").textContent = "Nuevo Usuario";
    
}

*/

/*

function registerCashRegister(e) {
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

        })*//*

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
}*/

/*
function btnEditCashRegister(id) {

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
    
}*/

/*
function btnDeleteCashRegister(id){

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
}*/

/*
function btnReenterCashRegister(id) {

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
    
}*/

//End CashRegister


function frmProduct() {

    document.getElementById("title").textContent = "Nuevo Producto";
    document.getElementById("btnAction").textContent = "Registrar";
    document.getElementById("frmProduct").reset();
    myModal.show();
    //Pending verify if this document.getElement have to be erase
    document.getElementById("id").value = "";
    deleteImage();
    
}


//Function used in Product module to register new products
function registerProduct(e) {
    e.preventDefault();
    const code = document.getElementById("code");
    const description = document.getElementById("description");
    const purchase_price = document.getElementById("purchase_price");
    const selling_price = document.getElementById("selling_price");
    const id_measure = document.getElementById("measure");
    const id_category = document.getElementById("category");

    if (code.value == "" || description.value == "" || purchase_price.value == "" || selling_price.value ) {

        alerting('Todos los campos son obligatorios!' , 'warning');
        
    }else{
        // Petiton with Ajax
        const url = base_url + "Products/register";
        const frm = document.getElementById("frmProduct");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        
        http.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
                const response = JSON.parse(this.responseText);
                myModal.hide();
                alerting(response.message, this.response.icon);
                tblProducts.ajax.reload();
                
            }            
        }
    }    
}

//This function was updated in video 31 when updating Bootstrap
//Function used in User module to edit users
function btnEditProduct(id) {

    document.getElementById("title").textContent = "Actualizar producto";
    document.getElementById("btnAction").textContent = "Modificar";
    const url = base_url + "Products/edit/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {

            const response = JSON.parse(this.responseText);
            document.getElementById("id").value = response.id;
            document.getElementById("code").value = response.code;
            document.getElementById("description").value = response.description;
            document.getElementById("purchase_price").value = response.purchase_price;
            document.getElementById("selling_price").value = response.selling_price;
            document.getElementById("measure").value = response.id_measure;
            document.getElementById("category").value = response.id_category;
            document.getElementById("img-preview").src = base_url + 'Assets/img/' +  response.image;
            document.getElementById("icon-close").innerHTML = `<button class="btn btn-danger" onclick="deleteImage()"><i class="fas fa-times"></i></button>`;
            document.getElementById("icon-image").classList.add("d-none");
            document.getElementById("actual_image").value = response.image;
        
            
            myModal.show();
            
        }
    }
    
}

function btnDeleteProduct(id){

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

            const url = base_url + "Products/delete/" + id;
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
                        
                        tblProducts.ajax.reload();
                        
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

function btnReenterProduct(id) {

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

            const url = base_url + "Products/reenter/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    if (response == "ok") {

                        Swal.fire(
                            'Mensaje!',
                            'Producto eliminado con exito',
                            'success'
                        )
                        
                        tblProducts.ajax.reload();
                        
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

//End Products


function preview(e) {

    const url_image = e.target.files[0];
    const url_tmp = URL.createObjectURL(url_image);
    document.getElementById("img-preview").src = url_tmp;
    document.getElementById("icon-image").classList.add("d-none");
    document.getElementById("icon-close").innerHTML = `<button class="btn btn-danger" onclick="deleteImage()"><i class="fas fa-times"></i></button>${url_image['name']}`;
    
}

function deleteImage() {

    document.getElementById("icon-close").innerHTML = '';
    document.getElementById("icon-image").classList.remove("d-none");
    document.getElementById("img-preview").src = '';
    document.getElementById("image").value = '';
    document.getElementById("actual_image").value = '';

    
}


function searchCode(e){

    e.preventDefault();

    if (e.which == 13) {

        const code = document.getElementById("code").value;
        const url = base_url + "Purchases/searchCode/" + code;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
                
                const response = JSON.parse(this.responseText);
                
                if (response) {

                    document.getElementById("description").value = response.description;
                    document.getElementById("purchase_price").value = response.purchase_price;
                    document.getElementById("id").value = response.id;
                    document.getElementById("ammount").focus();
                    
                }else{

                    Swal.fire({

                        position: 'top-end',
                        icon: 'error',
                        titleL: 'El producto no existe',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    document.getElementById("code").value = '';
                    document.getElementById("code").focus();

                    
                }
            }
        }            
    }    
}

function calculatePrice(e) {

    e.preventDefault();
    const amount = document.getElementById("amount").value;
    const purchase_price = document.getElementById("purchase_price").value;
    document.getElementById("subtotal").value = purchase_price * amount;

    if (e.which == 13) {
        if (amount > 0) {
            const url = base_url + "Purchases/inputInfo/";
            const frm = document.getElementById("frmPurchase");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    if (response == 'ok') {

                        Swal.fire({

                            position: 'top-end',
                            icon: 'success',
                            titleL: 'Producto Ingresado',
                            showConfirmButton: false,
                            timer: 3000
                        })

                        frm.reset();
                        loadDetail();
                    }else if (response == 'modificado') {
                        Swal.fire({

                            position: 'top-end',
                            icon: 'success',
                            titleL: 'Producto actualizado',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        frm.reset();
                        loadDetail();
                        
                    }
                }
            }                        
        }
    }
}

if (document.getElementById('tblDetail')) {

    loadDetail();
    
}


function loadDetail() {

    const url = base_url + "Purchases/list/";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {

            const response = JSON.parse(this.responseText);
            let html = '';
            response.detail.forEach(row => {

                html =  `<tr>
                <td>${row['id']}</td>
                <td>${row['description']}</td>
                <td>${row['amount']}</td>
                <td>${row['price']}</td>
                <td>${row['sub_total']}</td>
                <td>
                <button class="btn btn-danger" type="button" onclick="deleteDetail(${row['id']})"><i class="fas fa-trash-alt"></i></button>                
                </td>
                </tr>` ;                
            });

            document.getElementById("tblDetail").innerHTML= html;
            document.getElementById("total").innerHTML= response.total_pay.total;
            
        }
    }
    
}

function deleteDetail(id) {

    const url = base_url + "Purchases/delete/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
            const response = JSON.parse(this.responseText);
            if (response == 'ok') {

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Producto eliminado',
                    showConfirmButton: false,
                    timer: 3000
                })                
                loadDetail();
            }else{

                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error al eliminar el producto',
                    showConfirmButton: false,
                    timer: 3000
                })
            }                            
        }
    }    
}


function triggerPurchase(params) {

    Swal.fire({
        title: '¿Estas seguro de realizar la compra?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Purchases/registerPurchase/";
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.message == "ok") {

                        Swal.fire(
                            'Mensaje!',
                            'Compra generada',
                            'success'
                        )                        
                        /*Direccionamiento a traves del boton 'Generar compra'
                         para el pdf con la factura*/
                        const route = base_url + 'Purchases/triggerPDF/' + response.id_purchase;
                        window.open(route);
                        setTimeout(() => {
                            window.location.reload();                            
                        }, 300);
                        
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

function modifyCompany() {

    const frm = document.getElementById('frmCompany');

    const url = base_url + "Administration/modify";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
            const response = JSON.parse(this.responseText);

            if (response = 'ok') {

                alert('Modificado');
                
            }
                          
        }
    }

}