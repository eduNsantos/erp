<template>
    <div>
        <div class="form-row">
            <div class="col">
                <label for="client_id">Cliente</label>
                <select name="client_id" class="select2">
                    <option value="">Selecione um cliente</option>
                    <option 
                        v-for="client in clients"
                        :key="client.id"
                        :value="client.id">
                        {{ client.corporate_name }}
                    </option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label for="">Procurar</label>
                <input type="search" v-model="searchProduct">
            </div>
            <div class="col">
                <label for="">Descrição</label>
                <input type="search" v-model="product.description">
            </div>
        </div>
    </div>
</template>

<script>
import $ from 'jquery'
import 'select2'

export default {
    props: ['clients', 'products'],
    data() {
        return {
            productsId: []
        }
    },
    mounted() {
        $('.select2').select2();
    }
}
</script>

<style>

</style>