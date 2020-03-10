<template>
    <div>
        <div class="container">
            <label data-toggle="tooltip" title="Nome fantasia">Cliente</label>
            <select name="client_id" class="form-control">
                <option value="">Selecione</option>
                <option 
                    v-for="client in clients"
                    :key="client.id"
                    :value="client.id">
                    {{ client.fantasy_name }}
                </option>
            </select>
            <div class="table-responsive">
                <table id="order-table" class="w-100 table-bordered">
                    <thead>
                        <tr>
                            <th 
                                data-toggle="tooltip"
                                title="Pesquise por código ou nome"
                                class="search">
                                Pesquisa
                            </th>
                            <th class="name">Nome</th>
                            <th class="description">Descrição</th>
                            <th 
                                class="quantity">Quantidade</th>
                            <th 
                                class="available_balance"
                                data-toggle="tooltip"
                                title="Saldo disponível (descontando a reserva)"
                                aria-placeholder="asdsd">
                                Saldo disponível
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td
                                @keyup="searchProduct"
                                contenteditable="true"
                                class="search">
                            </td>
                            <td 
                                class="name">
                            </td>
                            <td
                                class="description">
                            </td>
                            <td
                                contenteditable="true"
                                class="quantity">
                            </td>
                            <td
                                class="available_balance">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="w-100 my-1">
                    <button
                        @click="addNewItem"
                        data-toggle="tooltip"
                        title="Adicionar novo item"
                        class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button 
                        data-toggle="tooltip"
                        title="Remover item"
                        class="btn btn-danger">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                <div class="my-1">
                    <h4>Informações gerais</h4>
                    <span><b>Total:</b> R$ {{ total }}</span>
                    <span><b>Quantidade:</b> {{ items.length }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['clients', 'products'],
    data() {
        return {
            items: []
        }
    },
    methods: {
        searchProduct (e) {
            let searchText = e.target.textContent.trim().toLowerCase()
            let foundValue = this.products.find(product => {
                let productCode = product.code.toLowerCase()
                let productName = product.name.toLowerCase()

                if (productCode.indexOf(searchText) !== -1 || productName.indexOf(searchText) !== -1) {
                    return product
                }
            })

            if (typeof foundValue !== "undefined") {
                return foundValue
            }
        },
        addNewItem (e) {
            let row = document.querySelector('tbody tr')
            // let tds = []
            let newRow = document.createElement('tr')

            for (let td of row.children) {
                let clonedTd = td.cloneNode()
                
                clonedTd.textContent = ""
                newRow.appendChild(clonedTd)
            }

            document.querySelector('tbody tr:last-child').after(newRow)
        }
    },
    mounted() {
    },
    computed: {
        total() {
            return 800;
        }
    }
}
</script>

<style scoped>
    th, td {
        padding: 3px;
    }
</style>