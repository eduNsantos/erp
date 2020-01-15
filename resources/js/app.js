require('./bootstrap');
require('@fortawesome/fontawesome-free/js/all')

$(document).on('ready', function() { $('body').bootstrapMaterialDesign(); });

$(document).on('click', '#sidebar .function-item', function(e) {
    const menuContent = $('#menu-content')
    const url = $(this).attr('href');

    e.preventDefault();

    $.get(url, response => $(menuContent).html(response));
});

$(document).on('submit', '#filter form', function(e) {
    const form = $(this)
    const currentPeriod = $('#current-period')
    const initialDate = $(form).find('#initial_date').val()
    const finalDate = $(form).find('#final_date').val()

    e.preventDefault();

    console.log(new Date(initialDate))

    if (initialDate == "") {
        alert('A data inicial deve ser definida');
        return false;
    } 
    
    if (finalDate == "") {
        alert('A data final deve ser definida');
        return false;
    }

    if (initialDate < finalDate) {
        alert('A data inical não pode ser menor que a final');
        return false;
    }

    $(currentPeriod).find('.initial-date').html('De: ' + initialDate);
    $(currentPeriod).find('.final-date').html('à: ' + finalDate);
})