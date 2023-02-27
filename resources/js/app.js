require('./bootstrap');
var Turbolinks = require("turbolinks");
Turbolinks.start();
window.addEventListener('close-model', event => {
    $('#modal-basic').modal('hide');
    $('#edit-modal').modal('hide');
    $('#modal-info-delete').modal('hide');
})