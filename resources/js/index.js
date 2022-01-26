$(function () {

    $.ajax({
        url: '/data-employee',
        method: 'GET'
    }).done(data => {
        console.log(data)
    }).fail(err => {
        console.log(err);
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
            const length_table = $("#table_employee tbody tr").length
            console.log(data);
            //     $("#table_employee tbody").append(`<tr>
            //     <th scope="row">${length_table + 1}</th>
            //     <td>${datas[0].value}</td>
            //     <td>${datas[1].value}</td>
            // </tr>`)
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