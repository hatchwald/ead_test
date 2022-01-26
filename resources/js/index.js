// import $ from 'jquery'
// import '@popperjs/core'
// import 'bootstrap'
// import 'datatables.net-bs5'
// import $, { ajax } from 'jquery';
// var dt = require('datatables.net')();
$(function () {

    $.ajax({
        url: '/data-employee',
        method: 'GET'
    }).done(data => {
        console.log(data)
    }).fail(err => {
        console.log(err);
    })

    const dt_table_employees = $("#table_employee").DataTable({
        "ajax": '/data-employee',
        "columns": [
            {
                data: null,
                render: (data, type, row, meta) => {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'nama' },
            { data: 'jenis_kelamin' },
            { data: 'nomor_hp' },
            { data: 'email' },
            { data: 'current_salary' },
            {
                data: 'foto_profil',
                sortable: false,
                render: (data, type, row) => {
                    return `<img src="./${data}" class="img-tables" alt="">`
                }
            },
            {
                data: null,
                sortable: false,
                render: (data, type, row) => {
                    return `<a href="#" class="btn btn-warning">Update</a> <a href="#" class="btn btn-danger">Delete</a>`;
                }
            }
        ]
    })
    $("#btn_add").on("click", function () {
        $("#form_employee fieldset").prop("disabled", false)
        $("#submit_btn").prop("disabled", false)
        $("#form_employee").trigger("reset")
        $("#modal_dialogue").modal("show")
    })

    $("#form_employee").on("submit", e => {
        e.preventDefault()
        const data = $("#form_employee").serializeArray()
        const foto = $("#foto_profil")[0].files[0]
        let form_table = document.getElementById("form_employee")
        let form_data = new FormData(form_table)
        $("#submit_btn").prop('disabled', true)
        $("#form_employee fieldset").prop("disabled", true)
        $("#modal_dialogue").modal("hide")
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: form_data,
            url: "/employee",
            method: "POST",
            contentType: false,
            processData: false

        }).done(data => {
            dt_table_employees.ajax.reload()
            $("#toast_notif .toast-body").html("Success Created data")
            $("#toast_notif").toast("show")

        }).fail(err => {
            $("#toast_notif .toast-body").html("An Error was happen , check log")
            $("#toast_notif").toast("show")
            $("#toast_notif .btn-close").on("click", function () {
                $("#form_employee fieldset").prop("disabled", false)
                $("#submit_btn").prop("disabled", false)
                $("#modal_dialogue").modal("show")
            })
            console.log(err)
        })
    })

});