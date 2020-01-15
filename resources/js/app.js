require('./bootstrap');
require('@fortawesome/fontawesome-free/js/all');
const dateFormat = require('dateformat');

$(document).on('ready', function() { $('body').bootstrapMaterialDesign(); });

$(document).on('click', '#sidebar .function-item', function(e) {
    const menuContent = $('#menu-content')
    const url = $(this).attr('href');

    e.preventDefault();

    $.get(url, response => $(menuContent).html(response));
});

$(document).on('submit', '#filter form', function(e) {
    const form = $(this);
    const currentPeriod = $('#current-period');
    let initialDate = $(form).find('#initial_date').val();
    let finalDate = $(form).find('#final_date').val();

    e.preventDefault();

    if (initialDate == "") {
        alert('A data inicial deve ser definida');
        return false;
    } 
    
    if (finalDate == "") {
        alert('A data final deve ser definida');
        return false;
    }

    if (finalDate < initialDate) {
        alert('A data final não pode ser menor que a inicial');
        return false;
    }

    initialDate = new Date(initialDate)
    finalDate = new Date(finalDate)

    initialDate = initialDate.setDate(initialDate.getDate() + 1)
    finalDate = finalDate.setDate(finalDate.getDate() + 1)

    initialDate = dateFormat(initialDate, 'dd/mm/yyyy');
    finalDate = dateFormat(finalDate, 'dd/mm/yyyy');

    $(currentPeriod).find('.initial-date').html('De: ' + initialDate);
    $(currentPeriod).find('.final-date').html('à: ' + finalDate);
})