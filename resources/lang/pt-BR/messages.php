<?php

return [
    'sales' => [
        'module_name' => 'Vendas',
        'order' => [
            'id' => 'Controle',
            'status' => 'Status',
            'client' => 'Cliente',
            'item_quantity' => 'Quantidade de itens',
            'user' => 'Vendedor',
            'total_price' => 'Total',
            'created_at' => 'Data de cadastro',
            'updated_at' => 'Última alteração'
        ]
    ],
    'stock' => [
        'module_name' => 'Estoque',
        'product' => [
            'id' => 'Controle',
            'code' => 'Código',
            'name' => 'Nome',
            'description' => 'Descrição',
            'category' => 'Categoria',
            'unit' => 'Unidade',
            'brand' => 'Marca',
            'group' => 'Grupo',
            'status' => 'Status',
            'initials' => 'Sigla',
            'multiple' => 'Multiplo embalagem',
            'physical_balance' => 'Saldo físico',
            'reserved_balance' => 'Saldo reservado',
            'available_balance' => 'Saldo disponível',
            'created_at' => 'Data de cadastro',
            'updated_at' => 'Última alteração',
        ],
        'product-unit' => [
            'id' => 'Código',
            'name' => 'Nome',
            'initials' => 'Sigla',
            'created_at' => 'Data de cadastro',
            'updated_at' => 'Última alteração'
        ]
    ],
    'client' => [
        'person_type' => 'Tipo de pessoa',
        'register_number' => 'CPF/CNPJ',
        'corporate_name' => 'Razão social',
        'fantasy_name' => 'Nome fantasia',
        'main_contact' => 'Contato principal'
    ],
    'general-registration' => 'Cadastramento geral'
];
