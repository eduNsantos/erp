require('./bootstrap');
require('@fortawesome/fontawesome-free/js/all');

const dateFormat = require('dateformat');

$(document).on('ready', function() { 
    $('body').bootstrapMaterialDesign();
});

$(document).on('click', '#sidebar .function-item', function(e) {
    const menuContent = $('#menu-content')
    const url = $(this).attr('href');
    const loader = `<div class="row align-items-center justify-content-center h-100"><div class="lds-dual-ring"></div></div>`

    e.preventDefault();

    $.ajax({
        url: url,
        beforeSend: () => $(menuContent).html(loader)
    })
    .done(response => {
        $(menuContent).html(response)
    })
    .then(() => {
        let initialDate = $('#initial_date').val();
        let finalDate = $('#final_date').val();
        const formated = {
            initialDate: initialDate,
            finalDate: finalDate
        }

        updateDateInfo(formated)
    });
});

$(document).on('submit', '#filter form', function(e) {
    let initialDate = $('#initial_date').val();
    let finalDate = $('#final_date').val();
    const formated = {
        initialDate: initialDate,
        finalDate: finalDate
    }

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

    $.ajax({
        url: '/change-date',
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
        },
        data: {
            initial_date: initialDate,
            final_date: finalDate
        }
    })

    updateDateInfo(formated)
})

function updateDateInfo(formated) {
    let currentPeriod = $('#current-period');

    formated.initialDate = new Date(formated.initialDate)
    formated.finalDate = new Date(formated.finalDate)

    formated.initialDate = formated.initialDate.setDate(formated.initialDate.getDate() + 1)
    formated.finalDate = formated.finalDate.setDate(formated.finalDate.getDate() + 1)

    formated.initialDate = dateFormat(formated.initialDate, 'dd/mm/yyyy');
    formated.finalDate = dateFormat(formated.finalDate, 'dd/mm/yyyy');

    $(currentPeriod).find('.initial-date').html('De: ' + formated.initialDate);
    $(currentPeriod).find('.final-date').html('à: ' + formated.finalDate);
}