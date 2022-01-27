/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/export-data.js ***!
  \*************************************/
$("#exported_data_click").on("click", function () {
  var timestamps = new Date().getTime();
  $("#data_export_employee").wordExport("data-karyawan-".concat(timestamps));
});
/******/ })()
;