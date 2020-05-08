require('./bootstrap');
require('@fortawesome/fontawesome-free/js/all');
window.swal = require('sweetalert2')

import Vue from 'vue';
import axios from 'axios'
import 'jquery-mask-plugin'

const dateFormat = require('dateformat');
const items = []
let tableColumns = []

$(document).ready(function () {
    let columns = $('th[column]').toArray()
    let values = $('td[column]').toArray()
    let count = 0;

    // Seleciona as colunas disponíveis
    tableColumns = columns.map(column => $(column).attr('column'))
    // Seleciona os valores e tira os espaços em branco
    values = values.map(value => $(value).text().trim())

    // Seleciona cada item e cria um objeto
    while (count < values.length) {
        let item = {}
        tableColumns.forEach(column => {
            item[column] = values[count]
            count++
        })
        items.push(item)
    }

    $('[data-toggle]').tooltip()
})

$(document).on('click', 'th[column]', function (e) {
    let column = $(this).attr('column')
    let tableItems = $('td[column]')
    let order = $(this).attr('order')
    
    $('th[order]').removeAttr('order')
    $('.order-icon').empty()

    if (typeof order == "undefined" || order == "DESC") {
        $(this).attr('order', 'ASC')
        $(this).find('.order-icon').html('<i class="fas fa-caret-down"></i>')
    } else {
        $(this).attr('order', 'DESC')
        $(this).find('.order-icon').html('<i class="fas fa-caret-up"></i>')
    }

    order = $(this).attr('order')

    //Ordena o array do menor para o maior
    items.sort((a, b) => {
        if (a[column] > b[column]) {
            return 1
        }
        
        if (a[column] < b[column]) {
            return -1
        }

        return 0
    })

    if (order == "DESC") {
        items.reverse()
    }

    // substitui os valores nos campos
    let i = 0
    while (i < tableItems.length) {
        items.forEach(item => {
            tableColumns.forEach(column => {
                $(tableItems[i]).text(item[column])
                i++
            })
        })
    }
})

/**
 * Abstração para envio de formulário via post ajax
 */
$(document).on('submit', '.ajax-form', function (e) {
    let form = $(this)
    let submitButton = $(form).find('[type="submit"]')
    let secondsToEnableSubmitButton = 1;

    e.preventDefault()
    console.log(form.serialize())
    axios.post($(form).attr('action'), form.serialize())
    .then(response => {
        swal.fire({
            title: 'Aviso',
            text: response.data.message,
            icon: response.data.type
        })
        .then(() => location.reload())
    })
    .catch(error => {
        showErrorsOnSweetalert(error)
    })
    
    submitButton.prop('disabled', true)
    setTimeout(() => submitButton.prop('disabled', false), secondsToEnableSubmitButton * 1000)
})

$(document).on('click', '.btn-close-modal', function() {
    $('.modal').modal('hide')
});
/**
 * Exporta para o excel
 */
$(document).on('click', '.export-excel', function (e) {
    e.preventDefault();
    (async () => {
        await window.open($(this).attr('href'), '_top')
        await swal.fire('Arquivo baixado!', 'Verifique seus downloads.', 'success')
    })();
})


$(document).on('click', '.nav-tabs .nav-link', function () {
    $(this).toggleClass('active')
});
/**
 * Faz a requisição do formulário de cadastro no back-end
 */
$(document).on('click', '.uses-modal', function (e) {
    const item = this
    const registerModal = $('#registerModal')
    
    e.preventDefault()

    swal.fire({
        title: 'Carregando...',
        text: 'Por favor, aguarde',
        showConfirmButton: false
    })

    axios.get($(item).attr('href'))
    .then(response => {
        swal.close()
        registerModal.find('.modal-body').html(response.data)
        registerModal.modal()
    })
})

/**
 * Toggle checkboxes para alterar visibilidade das colunas
 */
$(document).on('click', '.toggle-columns', function (e) {
    $('#columns').toggle()
})

/**
 * Altera visibilidade das colunas na listagem
 */
$(document).on('change', '#columns input[type=checkbox]', function (e) {
    const column = $(this).prop('id')
    $(`.${column}`).toggle();
})

/**
 * Fecha modal de cadastro ao clicar em cancelar
 */
$(document).on('click', 'form .btn-danger', function (e) {
    $('#registerModal').modal('hide')
})

/**
 * Altera data na session para consultas
 */
$(document).on('submit', '#filter form', function(e) {
    e.preventDefault();

    let initialDate = $('#initial_date').val();
    let finalDate = $('#final_date').val();
    const formated = {
        initialDate: initialDate,
        finalDate: finalDate
    }

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

    axios.post('/change-date', {
        initial_date: initialDate,
        final_date: finalDate
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

$(document).on('click', '.add-item', function () {
    let clonedTr = $(this).closest('tr').clone();
    let hasEmptyRows = false;

    $.each($('#order-table tbody tr'), function (index, input) {
        if ($(this).find('.product-id').val() == "") {
            hasEmptyRows = true
            return false;
        }
    })

    if (hasEmptyRows) {
        swal.fire({
            title: 'Aviso',
            text: 'Existem linhas vazias! Exclua ou preencha!',
            icon: 'warning'
        })
        return false
    }

    $.each(clonedTr.find('input'), function (index, input) {
        $(input).val("")
    })

    $(this).closest('tr').after(clonedTr)
});


$(document).on('click', '.remove-item', function () {
    if ($('#order-table tbody tr').length == 1) {
        swal.fire({
            title: 'Aviso',
            text: 'Não é possivel remover todos as linhas dos pedidos!',
            icon: 'warning'
        })
    } else {
        swal.fire({
            title: 'Aviso',
            text: 'Tem certeza que deseja remover esta linha?',
            showConfirmButton: true,
            showCancelButton: true,
            icon: 'question',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não',
        })
        .then(result => {
            if (result.value) {
                $(this).closest('tr').remove();
            }
        })
    }
});

$(document).on('keyup change', '#order-items .product-search', function (e) {
    let products = JSON.parse($('#order-table').attr('products'))
    let searchProduct = products.find(product => {
        let value = $(this).val().toLowerCase()
        let productCode = product.code.toLowerCase()
        let productDescription = product.description.toLowerCase()

        if (productCode.indexOf(value) !== -1 || productDescription.indexOf(value) !== -1) {
            return product
        }
    })

    let tableRow = $(this).closest('tr')

    if (typeof searchProduct !== "undefined") {
        let availableBalance = searchProduct.balances[0].quantity - searchProduct.balances[1].quantity

        tableRow.find('.product-id').val(searchProduct.id)
        tableRow.find('.description').val(searchProduct.description)
        tableRow.find('.balance').val(availableBalance)
        tableRow.find('.unit').val(searchProduct.unit.name)
    } else {
        tableRow.find('input:not(.product-search)').val('Produto não encontrado')
        tableRow.find('.product-id').val('')
    }
});

$(document).on('keyup', '#order-table .quantity', function () {
    let quantity = parseInt($(this).val())
    let balance = parseInt($(this).closest('tr').find('.balance').val())

    if (quantity > balance) {
        swal.fire({
            title: 'Aviso',
            text: 'Você não pode vender mais do que existe!',
            icon: 'warning'
        })
        .then(() => $(this).val(balance))
    }
})

$(document).on('click', '.order-cancel', function () {
    let id = $(this).closest('tr').find('[column="id"]').text()

    swal.fire({
        title: 'Aviso',
        html: 'Deseja realmente <b>cancelar</b> esse pedido?',
        icon: 'question',
        showConfirmButton: true,
        confirmButtonText: 'Sim',
        showCancelButton: true,
        cancelButtonText: 'Não',
    })
    .then(result => {
        if (result.value) {
            axios.put('./order/cancel', { id })
            .then(response => {
                swal.fire({
                    title: 'Aviso',
                    text: response.data.message,
                    icon: 'success'
                })
                $(this).closest('tr').after(response.data.row)
                $(this).closest('tr').remove()
            })
            .catch(error => {
                showErrorsOnSweetalert(error)
            })
        }
    })
})

$(document).on('click', '.order-activate', function () {
    let id = $(this).closest('tr').find('[column="id"]').text()
    
    swal.fire({
        title: 'Aviso',
        html: 'Deseja realmente <b>ativar</b> esse pedido?',
        icon: 'question',
        showConfirmButton: true,
        confirmButtonText: 'Sim',
        showCancelButton: true,
        cancelButtonText: 'Não',
    })
    .then(result => {
        if (result.value) {
            axios.put('./order/activate', { id })
            .then(response => {
                swal.fire({
                    title: 'Aviso',
                    text: response.data.message,
                    icon: 'success'
                })
                $(this).closest('tr').after(response.data.row)
                $(this).closest('tr').remove()
            })
            .catch(error => {
                showErrorsOnSweetalert(error)
            })
        }
    })
})

function showErrorsOnSweetalert (error) {
    const errors = Object.values(error.response.data.errors)
    const list = document.createElement('ul')

    for (let error of errors) {
        let item = document.createElement('li')
        item.textContent = error
        
        list.appendChild(item)
    }

    swal.fire('Aviso', list, 'error')
}