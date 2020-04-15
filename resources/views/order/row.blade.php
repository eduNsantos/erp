<tr>
    <td column="id">{{ $order->id }}</td>
    <td column="status">{{ $order->status->name }}</td>
    <td column="client">{{ $order->client->corporate_name }}</td>
    <td column="user">{{ $order->user->name }}</td>
    <td column="quantity">{{ $order->order_products()->count() }}</td>
    <td column="price">{{ $order->total_price }}</td>
    <td column="created_at">{{ date('d/m/Y H:i:s', strtotime($order->created_at)) }}</td>
    <td column="updated_at">{{ date('d/m/Y H:i:s', strtotime($order->updated_at)) }}</td>
    <td>
        @if ($order->status->name == 'Em análise')
            <button data-toggle="tooltip" title="Cancelar pedido" class="order-cancel btn btn-danger">
                <i class="fas fa-times"></i>
            </button>
        @endif
        @if ($order->status->name == 'Cancelado')
            <button data-toggle="tooltip" title="Ativar" class="order-activate btn btn-info">
                <i class="fas fa-check"></i>
            </button>
        @endif
    </td>
</tr>