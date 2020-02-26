require('./bootstrap');
require('@fortawesome/fontawesome-free/js/all');

const dateFormat = require('dateformat');

import axios from 'axios'
import swal from 'sweetalert2'
import 'jquery-mask-plugin'

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
})

$(document).on('click', 'th[column]', function (e) {
    let column = $(this).attr('column')
    let tableItems = $('td[column]')

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

    console.log(items)
})

$(document).on('click', '.add-item', function () {
    let formRow = $(this).closest('.form-row')
    let clonedFormRow = $(formRow).clone()
    clonedFormRow.find('input, select').val('')
    $(formRow).after(clonedFormRow)
})

$(document).on('keyup', '.product-search', function (e) {
    let searchedProduct = $(this).val().toLowerCase()
    let product = products.find(product => {
        let productCode = product.code.toLowerCase()
        let productName = product.name.toLowerCase()
        
        if (productCode.indexOf(searchedProduct) != -1 || productName.indexOf(searchedProduct) != -1) {
            return true
        }
    })

    let productId = $(this).closest('.form-row').find('[name="product_id[]"]')
    let description = $(this).closest('.form-row').find('.description')
    let unit = $(this).closest('.form-row').find('.unit')

    if (typeof product !== "undefined") {
        productId.val(product.id)
        description.val(product.description)
        unit.val(product.unit.initials)
    } else {
        productId.val('')
        description.val('Produto não encontrado. Procure novamente.')
    }
})

/**
 * Abstração para envio de formulário via post ajax
 */
$(document).on('submit', '.ajax-form', function (e) {
    const form = this

    e.preventDefault()

    axios.post($(form).attr('action'), new FormData(form))
    .then(response => {
        swal.fire('Aviso', response.data.message, response.data.type)
    })
    .catch(error => {
        const errors = Object.values(error.response.data.errors)
        const list = document.createElement('ul')

        for (let error of errors) {
            let item = document.createElement('li')
            item.textContent = error
            
            list.appendChild(item)
        }

        swal.fire('Aviso', list, 'error')
    })
})

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

/**
 * Faz a requisição do formulário de cadastro no back-end
 */
$(document).on('click', '.create-item', function (e) {
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