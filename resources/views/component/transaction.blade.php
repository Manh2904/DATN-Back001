<table class="table table-condensed">
    <tbody>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Avatar</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Total</th>
    </tr>

    @foreach($order as $list)
        <tr>
            <th>#{{ $list->id }}</th>
            <th>{{ $list->product->pro_name ?? "[N\A]"}}(Kích cỡ: {{ $size[$list->od_size] }})</th>
            <th><img style="height:80px;width:80px" src="{{ $list->product->pro_avatar }}" alt=""></th>
            <th>{{ number_price($list->od_price,0,',','.') }}đ</th>
            <th>{{$list->od_qty }}</th>
            <th>{{ number_price($list->od_price *$list->od_qty ,0,',','.')}}đ</th>
        </tr>
    @endforeach

    </tbody>

</table>
