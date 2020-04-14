@extends('list')

@section('tbody')
    @foreach ($items as $order)
        <tr>
            <td column="id">{{ $order->id }}</td>
            <td column="client">{{ $order->client->corporate_name }}</td>
            <td column="user">{{ $order->user->name }}</td>
            <td column="quantity">{{ $order->products()->count() }}</td>
            <td column="price">{{ date('d/m/Y H:i:s', strtotime($order->total_price)) }}</td>
            <td column="created_at">{{ date('d/m/Y H:i:s', strtotime($order->created_at)) }}</td>
            <td column="updated_at">{{ $order->updated_at }}</td>
            <td>
                <button data-toggle="tooltip" title="Cancelar pedido" class="cancel btn btn-danger">
                    <i class="fas fa-times"></i>
                </button>
            </td>
        </tr>
    @endforeach
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            let id = $(this).closest('tr').find('.id').text()

            $('.cancel').click(function () {
                swal.fire({
                    title: 'Aviso',
                    text: 'Deseja realmente cancelar esse pedido?',
                    icon: 'question',
                    showConfirmButton: true,
                    confirmButtonText: 'Sim',
                    showCancelButton: true,
                    cancelButtonText: 'Não',
                })
                .then(result => {
                    if (result.value) {
                        axios.put('./order/cancel', {
                            id: 1
                        })
                        .then(response => swal.fire({
                            title: 'Aviso',
                            text: response.data.message,
                            icon: 'success'
                        }))
                    }
                })
            })
        })
    </script>
@endsection