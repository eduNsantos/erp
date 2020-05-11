const products = {};

$(document).ready(function () {
    products.finished = JSON.parse($("#finished-products").val())
    products.feedstock = JSON.parse($("#feedstock-products").val())
    products.package = JSON.parse($("#package-products").val())
})

$(document).on('change', '[name="product_id"]', function (e) {
    let selectedProduct = $(this).children("option:selected")

    if (!$('#keep_name').is(':checked')) {
        $('#name').val(selectedProduct.text())
    } else if (selectedProduct.val() == "") {
        $("#name").val("")
    }
})

$(document).on('change', '.product-id', function (e) {
    let selectedProduct = $(this).children('option:selected')
    let productType = $(this).attr('product-type')
    let tr = $(this).closest('tr')
    let product = products[productType].find(product => product.id == selectedProduct.val())
    let productIds = $(this).closest('tbody').find(`.product-id option:selected[value="${product.id}"]`)   
    
    if (productIds.length > 1) {
        swal.fire({
            title: 'Aviso',
            icon: 'warning',
            text: 'Não é possível adicionar o mesmo item mais de uma vez'
        })
        
        $(this).val("")
        return false
    }
    

    tr.find('.unit').val(product.unit.name)
});

$(document).on('click', '.add-component', function (e) {
    let tr;
    let hasEmptyFields = false
    let tableRows = $(this).closest('tbody').find('tr')

    $(tableRows).each((index, tr) => {
        hasEmptyFields = $(tr).find('.product-id option:selected').val() == "" || $(tr).find('.quantity').val() == ""
        if (hasEmptyFields) {
            swal.fire({
                title: 'Mensagem',
                text: 'Preeecha todos os campos antes de adicionar um novo',
                icon: 'warning'
            })
            return false
        }
    });

    if (hasEmptyFields) {
        return false
    }
    
    tr = $(this).closest('tr').clone();
    tr.find('input, select, textarea').val("")

    $(this).closest('tr').after(tr)
})

$(document).on('click', '.remove-component', function (e) {
    let tbody = $(this).closest('tbody')
    let tr = $(this).closest('tr')

    if (tbody.find('tr').length == 1) {
        swal.fire({
            title: 'Aviso',
            icon: 'warning',
            text: 'Não é possível remover todos os itens'
        })

        return false
    }

    swal.fire({
        title: 'Aviso',
        icon: 'question',
        text: 'Deseja mesmo remover este item?',
        showConfirmButton: true,
        confirmButtonText: 'Sim, desejo remover!',
        showCancelButton: true,
        cancelButtonText: 'Não'
    }).then(result => {
        if (result.value) {
            $(tr).remove()
        }
    })
})

function validateForm() {
    if ($('input[name="is_main"]').is(':checked')) {
        swal.fire("Essa estrutura irá substituir a principal")
    }
}

$(document).on('click', '#no_package', function () {
    let tableRows;
    $('#packages').toggle()

    if ($(this).is(':checked')) {
        $('#packages tbody tr').not(':first').remove()
        $('#packages tbody input, select, textarea').val("")
    }
})

$(document).on('click', '#is_main', function () {

    if ($(this).is(':checked')) {
        swal.fire({
            text: 'Marcar essa estrutura como principal desativará a atual',
            icon: 'warning'
        })
    }
})