
$("#exported_data_click").on("click", () => {
    const timestamps = new Date().getTime()
    $("#data_export_employee").wordExport(`data-karyawan-${timestamps}`);

})