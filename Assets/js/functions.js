
// Receive data using Ajax
let tblUsers, tblClients, tblCashRegister, tblMeasures, tblCategories, tblProducts, t_h_c, t_h_v, t_balance, myModal;

document.addEventListener("DOMContentLoaded", function() {

    $('#select_client').select2({
        placeholder: 'Buscar Cliente',
        minimumInputLength: 2,
        ajax: {
            url: base_url + 'Clients/searchClient',
            dataType: 'json',
            delay: 250,
            data: function (params){
                return {
                    cli: params.term
                };
            },
            cache: true
        }
    });

    $('#select_pro').select2({
        placeholder: 'Buscar Producto',
        minimumInputLength: 2,
        ajax: {
            url: base_url + 'Products/searchProduct',
            dataType: 'json',
            delay: 250,
            data: function (params){
                return {
                    pro: params.term
                };
            },
            processResults: function (data){
                return{
                    results: data
                };
            },
            cache: true
        }
    });

    if (document.getElementById('my_modal')) {
        myModal = new bootstrap.Modal(document.getElementById('my_modal'));        
    }

    $('#client').select2();
    const buttons = [{
        extend: 'excelHtml5',
        footer: true,
        title: 'Archivo',
        filename: 'Export_File',
        text: '<span class="badge bg-success"><i class="fas fa-file-excel"></i></span>'
    },
    {

        extend: 'pdfHtml5',
        download: 'open',
        footer: true,
        title: 'Reporte de usuarios',
        filename: 'Reporte de usuarios',
        text: '<span class="badge bg-danger"><i class="fas fa-file-pdf"></i></span>',
        exportOptions: {
            columns: [0, ':visible']
        }

    },
    {
        extend: 'copyHtml5',
        footer: true,
        title: 'Reporte de usuarios',
        filename: 'Reporte de usuarios',
        text: '<span class="badge bg-primary"><i class="fas fa-copy"></i></span>',
        exportOptions: {
            columns: [0, ':visible']
        }

    },
    {
        extend: 'print',
        footer: true,
        filename: 'Export_File_print',
        text: '<span class="badge bg-dark"><i class="fas fa-print"</i></span>'

    },
    {
        extend: 'csvHtml5',
        footer: true,
        filename: 'Export_File_csv',
        text: '<span class="badge bg-success"><i class="fas fa-file-csv"</i></span>'

    },
    {
        extend: 'colvis',
        text: '<span class="badge bg-info"><i class="fas fa-columns"</i></span>',
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
                'data' : 'name'
            },
            {
                'data' : 'cash_register'
            },
            {
                'data' : 'status'
            },
            {
                'data' : 'actions'
            }

        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
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

        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
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

        ],
        language: {
            "url" : "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
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

    t_h_c = $('#t_history_purchase').DataTable({

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
                'data' : 'status'
            },
            {
                'data' : 'actions'
            }
        ]
    });


    t_h_v = $('#t_history_sale').DataTable({

        ajax: {

            url: base_url + "Purchases/list_sales_history",
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
                'data' : 'total'
            },
            {
                'data' : 'sale_date'
            },
            {
                'data' : 'actions'
            }
        ]
    });

    t_balance = $('#t_balance').DataTable({

        ajax: {

            url: base_url + "CashRegister/list_balance",
            dataSrc: ''
        },
        columns: [

            {
                'data' : 'id'
            },
            {
                'data' : 'initial_amount'
            },
            {
                'data' : 'final_amount'
            },
            {
                'data' : 'opening_date'
            },
            {
                'data' : 'closing_date'
            },
            {
                'data' : 'total_sales'
            },
            {
                'data' : 'total_sales_amount'
            },
            {
                'data' : 'status'
            }

        ],
        language: {
            "url" : "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons
    });
    //End table Balance


    

})


function frmChangePassword(e) {

    e.preventDefault();
    const actualPassword = document.getElementById('actualPassword').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (actualPassword == '' || newPassword == '' || confirmPassword == '') {

        alerts('Todos los campos son obligatorios', 'warning');
        
    }else{

        if (newPassword != confirmPassword) {

            alerts('Las contraseñas no coinciden', 'warning');            

        } else {

            const url = base_url + "Users/changePassword";
            const frm = document.getElementById("frmChangePassword");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));        
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    myModal.hide();
                    alerts(response.message, response.icon);                
                    frm.reset();
                }            
        
            
            }

        } 
    }
}


//Function used in User module to create new users
function frmUser() {

    document.getElementById("title").textContent = "Nuevo Usuario";
    document.getElementById("btnAction").textContent = "Registrar";
    document.getElementById("passwords").classList.remove("d-none");
    document.getElementById("frmUser").reset();
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
        
        alerts('Debes llenar todos los campos!' , 'warning');
        
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
                alerts(response.message, response.icon);
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
                    alerts(response.message, response.icon);
                    tblUsers.ajax.reload();
                         
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
                    alerts(response.message, response.icon);
                    tblUsers.ajax.reload();
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
    const dni_client = document.getElementById("dni_client");
    const name = document.getElementById("name");
    const phone = document.getElementById("phone");
    const address = document.getElementById("address");

    if (dni_client.value == "" || name.value == "" || phone.value == "" || address.value == "") {

        alerts('Todos los campos son obligatorios!' , 'warning');
        
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
                alerts(response.message, this.response.icon);
                tblClients.ajax.reload();
                
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
            document.getElementById("dni_client").value = response.dni_client;
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
                    alerts(response.message, this.response.icon);
                    tblClients.ajax.reload();    
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
                    alerts(response.message, this.response.icon);
                    tblClients.ajax.reload();                    
                }
            }            
        }
      })
    
}

//End Clients

function frmCategory() {

    document.getElementById("title").textContent = "Nueva Categoría";
    document.getElementById("btnAction").textContent = "Registrar";
    document.getElementById("frmCategory").reset();
    document.getElementById("id").value = "";
    myModal.show();   
   
    
}

//This function was updated in video 31 when updating Bootstrap
//Function used in User module to register new users
function registerCategory(e) {
    e.preventDefault();
    const name = document.getElementById("name");

    if (name.value == "") {

        alerts(response.message, response.icon);
        
    }else{
        // Petiton with Ajax
        const url = base_url + "Category/register";
        const frm = document.getElementById("frmCategory");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        
        http.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
                const response = JSON.parse(this.responseText);
                myModal.hide();
                alerts(response.message, this.response.icon);
                tblCategories.ajax.reload();
                
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
                    alerts(response.message, response.icon);                    
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

            const url = base_url + "Categories/reenter/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    alerts(response.message, response.icon);                   
                }
            }            
        }
      })
    
}
//End Categories
// /hello/
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

        
        alerts('Todos los campos son obligatorios!' , 'warning');
        
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
                alerts(response.message, this.response.icon);
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


function frmMeasures() {

    document.getElementById("title").textContent = "Nueva Medida";
    document.getElementById("btnAction").textContent = "Registrar";
    document.getElementById("frmMeasures").reset();
    document.getElementById("id").value = "";
    myModal.show();
    
}


function registerMeasures(e) {

    e.preventDefault();
    const name = document.getElementById("name");
    const short_name = document.getElementById("short_name");
    if (name.value == "" || short_name.value == "") {
        alerts('Todos los campos son obligatorios', 'warning');        
    }else{

        const url = base_url + "Measures/register";
        const frm = document.getElementById("frmMeasures");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));        
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const response = JSON.parse(this.responseText);
                myModal.hide();
                alerts(response.message, this.response.icon);
                tblMeasures.ajax.reload();
                
            }            
        }

    }
    
}


function btnEditMeasure(id) {

    document.getElementById("title").textContent = "Actualizar medida";
    document.getElementById("btnAction").textContent = "Modificar";
    const url = base_url + "Measures/edit/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {
            const response = JSON.parse(this.responseText);
            document.getElementById("id").value = response.id;
            document.getElementById("name").value = response.name;
            document.getElementById("short_name").value = response.short_name;
            myModal.show();            
        }        
    }    
}


function btnDeleteMeasure(id){

    Swal.fire({
        title: '¿Estas seguro de eliminar la metrica?',
        text: "Esta metrica no eliminará de manera permanente, cambiará el estado a Inactivo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminalo!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Measures/delete/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    alerts(response.message, response.icon);
                    tblMeasures.ajax.reload();              
                }
            }            
        }
    })
}


function btnReenterMeasure(id) {

    Swal.fire({
        title: '¿Estas seguro de reingresar esta metrica?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Measure/reenter/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    alerts(response.message, response.icon);
                    tblMeasures.ajax.reload();                    
                }
            }            
        }
      })
    
}


//End Measures Functions


function frmProduct() {

    document.getElementById("title").textContent = "Nuevo Producto";
    document.getElementById("btnAction").textContent = "Registrar";
    document.getElementById("frmProduct").reset();
    document.getElementById("id").value = "";
    myModal.show();
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

        alerts('Todos los campos son obligatorios!' , 'warning');
        
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
                alerts(response.message, this.response.icon);
                frm.reset();
                myModal.hide();
                tblProducts.ajax.reload();
                
            }            
        }
    }    
}


//Function used in User module to edit Products
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
                    alerts(response.message, response.icon);
                    tblProducts.ajax.reload();              
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
                    alerts(response.message, response.icon);
                    tblProducts.ajax.reload();                    
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
    const code = document.getElementById("code").value;
    if (code != '') {

        if (e.which == 13) {            
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
                        document.getElementById("ammount").removeAttribute('disabled');
                        document.getElementById("ammount").focus();
                        
                    }else{
    
                        alerts('El producto no existe', 'warning');
                        document.getElementById("code").value = '';
                        document.getElementById("code").focus();
    
                        
                    }
                }
            }            
        }       
    }else{
        alerts('Ingrese el código', 'warning');
    }
}

function searchCodeSale(e){
    e.preventDefault();
    const code = document.getElementById("code").value;
    if (code != '') {

        if (e.which == 13) {            
            const url = base_url + "Purchases/searchCode/" + code;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
    
                if (this.readyState == 4 && this.status == 200) {
                    
                    const response = JSON.parse(this.responseText);
                    
                    if (response) {
    
                        document.getElementById("description").value = response.description;
                        document.getElementById("purchase_price").value = response.sale_price;
                        document.getElementById("id").value = response.id;
                        document.getElementById("ammount").removeAttribute('disabled');
                        document.getElementById("ammount").focus();
                        
                    }else{
    
                        alerts('El producto no existe', 'warning');
                        document.getElementById("code").value = '';
                        document.getElementById("code").focus();
    
                        
                    }
                }
            }            
        }       
    }else{
        alerts('Ingrese el código', 'warning');
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
                    alerts(this.response.message, this.response.icon);
                    frm.reset;
                    loadDetail();

                    document.getElementById('amount').setAttribute('disabled','disabled');
                    document.getElementById('code').focus();
                }
            }                        
        }
    }
}

function calculateSalePrice(e) {
    e.preventDefault();
    const amount = document.getElementById("amount").value;
    const purchase_price = document.getElementById("purchase_price").value;
    document.getElementById("subtotal").value = purchase_price * amount;

    if (e.which == 13) {
        if (amount > 0) {
            const url = base_url + "Purchases/inputSale/";
            const frm = document.getElementById("frmSale");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {

                    const response = JSON.parse(this.responseText);                    
                    alerts(this.response.message, this.response.icon);
                    frm.reset;
                    loadDetailSale();
                    document.getElementById('amount').setAttribute('disabled','disabled');
                    document.getElementById('code').focus();
                }
            }                        
        }
    }
}

if (document.getElementById('tblDetail')) {

    loadDetail();
    
}
if (document.getElementById('tblSales')) {

    loadDetailSale();
    
}

function loadDetail() {

    const url = base_url + "Purchases/list/tmp_details";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {

            const response = JSON.parse(this.responseText);
            let html = '';
            response.detail.forEach(row => {

                html += `<tr>
                <td>${row['id']}</td>
                <td>${row['description']}</td>
                <td>${row['amount']}</td>
                <td>${row['price']}</td>
                <td>${row['sub_total']}</td>
                <td>
                <button class="btn btn-danger" type="button" onclick="deleteDetail(${row['id']}, 1)"><i class="fas fa-trash-alt"></i></button>                
                </td>
                </tr>`;                
            });

            document.getElementById("tblDetail").innerHTML= html;
            document.getElementById("total").innerHTML= response.total_pay.total;
            
        }
    }
    
}

function loadDetailSale() {

    const url = base_url + "Purchases/list/tmp_sales";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {

            const response = JSON.parse(this.responseText);
            let html = '';
            response.detail.forEach(row => {
                html += `<tr>
                <td>${row['id']}</td>
                <td>${row['description']}</td>
                <td>${row['amount']}</td>
                <td><input class="form-control" placeholder="Descuento" typ="text" onkeyup="calculateDiscount(event, ${row['id']} )">></td>
                <td>${row['discount']}</td>
                <td>${row['price']}</td>
                <td>${row['sub_total']}</td>
                <td>
                <button class="btn btn-danger" type="button" onclick="deleteDetail(${row['id']}, 2)"><i class="fas fa-trash-alt"></i></button>                
                </td>
                </tr>`;                
            });

            document.getElementById("tblSales").innerHTML= html;
            document.getElementById("total").innerHTML= response.total_pay.total;
            
        }
    }
    
}

function calculateDiscount(e, id) {
    e.preventDefault();

    if (e.target.value == '') {
        alerts('Ingrese el descuento', 'warning');        
    }else{
        if (e.which == 13) {

            const url = base_url + "Purchases/calculateDiscount/" + id + "/" + e.target.value;  
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    alerts(response.message, response.icon);
                    loadDetailSale();
                    
                }
            }            
        }
    }    
}


function deleteDetail(id, action) {

    let url;

    if (action == 1) {
        url = base_url + "Purchases/delete/" + id;        
    }else{
        url = base_url + "Purchases/deleteSale/" + id;
    }
    
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
            const response = JSON.parse(this.responseText);
            alerts(response.message, response.icon);
            if (action == 1) {
                loadDetail();               
            }else{
                loadDetailSale();              
            }
                          
        }
    }    
}


function triggerTransaction(action) {    

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

            let url;
            if (action == 1) {
                url = base_url + "Purchases/registerPurchase/";        
            }else{
                const id_client = document.getElementById('id_client').value;
                url = base_url + "Purchases/registerSale/" + id_client; 
            }
            
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.message == "ok") {    
                                            
                        alerts(response.message, response.icon);
                        let route;
                        if (action == 1) {
                            /*Direccionamiento a traves del boton 'Generar compra'
                            para el pdf con la factura*/
                            route = base_url + 'Purchases/triggerPDF/' + response.id_purchase;                            
                        }else{
                            route = base_url + 'Purchases/triggerPDFSale/' + response.id_sale;
                        }
                        window.open(route);
                        setTimeout(() => {
                            window.location.reload();                            
                        }, 300);                        
                    }else{
                        alerts(response.message, response.icon);
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

function alerts(alert_message, alert_icon) {

    Swal.fire({
        position: 'top-end',
        icon: alert_icon,
        titleL: alert_message,
        showConfirmButton: false,
        timer: 3000
    })


    
}


if (document.getElementById('minimumStock')) {
    reportStock();
    soldProducts();    
}


function reportStock() {
    const url = base_url + "Administration/reportStock";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const response = JSON.parse(this.responseText);  
            let name = [];
            let amount = [];
            for (let i = 0; i < response.length; i++) {
                name.push(response[i]['description']);
                amount.push(response[i]['amount']);                
            }
            //Pie Chart for stock
            var ctx = document.getElementById("minimumStock");
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: name,
                    datasets: [{
                        data: amount,
                        backgroundColor: ['#007bff', '#dc3565', '#ffc107', '#28a745'],
                    }],
                },
            });
        }
    }    
}

function soldProducts() {

    const url = base_url + "Administration/soldProducts";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
            const response = JSON.parse(this.responseText);  
            let name = [];
            let amount = [];
            for (let i = 0; i < response.length; i++) {

                name.push(response[i]['description']);
                amount.push(response[i]['Total']);
                
            }
            //Pie Chart for stock
            var ctx = document.getElementById("soldProducts");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: name,
                    datasets: [{
                        data: amount,
                        backgroundColor: ['#007bff', '#dc3565', '#ffc107', '#28a745'],
                    }],
                },
            });
        }
    }
    
}


// // Charts, Metrics and Visual reports
var ctx = document.getElementById("minimumStock");
var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ["Blue", "Red", "Yellow", "Green"],
        datasets: [{
            data: [12.21, 15.58, 11.25, 8.32],
            backgroundColor: ['#007bff', '#dc3565', '#ffc107', '#28a745'],
        }],
    },
});



var ctx = document.getElementById("soldProducts");
var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Blue", "Red", "Yellow", "Green"],
        datasets: [{
            data: [12.21, 15.58, 11.25, 8.32],
            backgroundColor: ['#007bff', '#dc3565', '#ffc107', '#28a745'],
        }],
    },
});


function btnCancelPurchase(id) {    

    Swal.fire({
        title: '¿Estas seguro de anular la compra?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + 'Purchases/cancelPurchase/' + id; 
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    alerts(response.message, response.icon);
                    t_h_c.ajax.reload();                       
                                    
                }
            }            
        }
      })    
}


function cashBalance() {
    
    document.getElementById('hide_fields').classList.add('d-none');
    document.getElementById('initial_amount').value = '';
    document.getElementById('btnAction').textContent = 'Abrir caja';
    $('#open_cashRegister').modal('show');
    
}

function openBalance(e) {

    e.preventDefault();

    const initial_amount = document.getElementById('initial_amount').value;
    if (initial_amount == '') {

        alerts('Ingrese el monto inicial','warning');
        
    }else{
        const frm = document.getElementById('frmOpenCashRegister');    
        const url = base_url + 'CashRegister/openBalance';
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
            const response = JSON.parse(this.responseText);
            alerts(response.message, response.icon);
            t_balance.ajax.reload();
            $('#open_cashRegister').modal('hide');
            
        }
    }

        
    }
    
}

function closeCashRegister() {
    const url = base_url + 'CashRegister/getSales';
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const response = JSON.parse(this.responseText);
            document.getElementById('final_amount').value = response.total_amount.total;
            document.getElementById('total_sales').value = response.total_sales.total;
            document.getElementById('initial_amount').value = response.initial.initial_amount;
            document.getElementById('general_amount').value = response.initial.id;            
            document.getElementById('id').value = response.general_amount;            
            document.getElementById('hide_fields').classList.remove('d-none');
            document.getElementById('btnAction').textContent = 'Cerrar caja';
            myModal.show();
        }    
    }

    // Swal.fire({
    //     title: '¿Estas seguro de cerrar la caja?',
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Si',
    //     cancelButtonText: 'No'
    // }).then((result) => {
    //     if (result.isConfirmed) {

    //         const url = base_url + 'CashRegister/close/'; 
    //         const http = new XMLHttpRequest();
    //         http.open("GET", url, true);
    //         http.send();
    //         http.onreadystatechange = function() {
    //             if (this.readyState == 4 && this.status == 200) {
    //                 const response = JSON.parse(this.responseText);
    //                 alerts(response.message, response.icon);
    //                 t_balance.ajax.reload();                       
                                    
    //             }
    //         }            
    //     }
    // })
    
}


function registerPermissions(e) {

    e.preventDefault();
    const url = base_url + 'Users/registerPermissions';
    const frm = document.getElementById('form');
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const response = JSON.parse(this.responseText);

            if (response != '') {

                alerts(response.message, response.icon);
                
            }else{

                alerts('Error no identificado', 'error');

            }
        }    
    }
    
}