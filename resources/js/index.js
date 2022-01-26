// import $ from 'jquery'
// import '@popperjs/core'
// import 'bootstrap'
// import 'datatables.net-bs5'
// import $, { ajax } from 'jquery';
// var dt = require('datatables.net')();
$(function () {

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
                    return `<a href="#" class="btn btn-warning" data-id="${row.id}">Update</a> <a href="#" class="btn btn-danger" data-id="${data.id}">Delete</a>`;
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

    $("#form_employee_update").on("submit", e => {
        e.preventDefault()
        const data = $("#form_employee_update").serializeArray()
        const foto = $("#foto_profil")[0].files[0]
        let form_table = document.getElementById("form_employee_update")
        let form_data = new FormData(form_table)
        $("#submit_btn").prop('disabled', true)
        $("#form_employee_update fieldset").prop("disabled", true)
        $("#modal_dialogue_update").modal("hide")
        const id_employee = $("#id_employee").val()
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: form_data,
            url: `/employee/${id_employee}`,
            method: "POST",
            contentType: false,
            processData: false

        }).done(data => {
            dt_table_employees.ajax.reload()
            $("#toast_notif .toast-body").html("Success update data")
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

    $("#form_employee_delete").on("submit", e => {
        e.preventDefault()
        const data = $("#form_employee_delete").serializeArray()
        const foto = $("#foto_profil")[0].files[0]
        let form_table = document.getElementById("form_employee_delete")
        let form_data = new FormData(form_table)
        $("#submit_btn_delete").prop('disabled', true)
        $("#modal_dialogue_delete").modal("hide")
        const id_employee = $("#id_employee_delete").val()
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: form_data,
            url: `/employee/${id_employee}`,
            method: "POST",
            contentType: false,
            processData: false

        }).done(data => {
            dt_table_employees.ajax.reload()
            $("#toast_notif .toast-body").html("Success delete data")
            $("#toast_notif").toast("show")

        }).fail(err => {
            $("#toast_notif .toast-body").html("An Error was happen , check log")
            $("#toast_notif").toast("show")
            // $("#toast_notif .btn-close").on("click", function () {
            //     $("#form_employee fieldset").prop("disabled", false)
            //     $("#submit_btn").prop("disabled", false)
            //     $("#modal_dialogue").modal("show")
            // })
            console.log(err)
        })
    })

    $("#table_employee").on("click", ".btn-warning", function () {
        const curr = $(this).closest("tr")
        const nama = curr.find("td:eq(1)").text()
        $("#modal_dialogue_update #nama").val(nama)
        const jk = curr.find("td:eq(2)").text()
        $("#modal_dialogue_update #jenis_kelamin").val(jk)
        const no_hp = curr.find("td:eq(3)").text()
        $("#modal_dialogue_update #nomor_hp").val(no_hp)
        const email = curr.find("td:eq(4)").text()
        $("#modal_dialogue_update #email").val(email)
        const salary = curr.find("td:eq(5)").text()
        $("#modal_dialogue_update #current_salary").val(salary)
        $("#submit_btn").prop("disabled", false)
        $("#modal_dialogue_update").modal("show")
        const data_id = $(this).data("id")
        $("#id_employee").val(data_id)

    })

    $("#table_employee").on("click", ".btn-danger", function () {
        const curr = $(this).closest("tr")
        const nama = curr.find("td:eq(1)").text()
        $("#form_employee_delete #employee_name").html(nama)
        const data_id = $(this).data("id")
        $("#form_employee_delete #id_employee_delete").val(data_id)
        $("#submit_btn_delete").prop("disabled", false)
        $("#modal_dialogue_delete").modal("show");
    })

});