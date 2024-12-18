<div style="width: 100%;max-width: 600px;margin:0 auto">
    <div style="background: white;padding: 15px;border:1px solid #dedede;">
        <h2 style="margin:10px 0;border-bottom: 1px solid #dedede;padding-bottom: 10px;">Danh sách sản phẩm bạn đã
            mua</h2>
        <div>
            @php
                $total = 0;
            @endphp
            @foreach($products as $key => $item)
            @php
                $product = \App\Models\Product::find($item['od_product_id']);
                $total += (($product->pro_price * $item['od_qty']) * (100 - $product->pro_sale)) / 100;
            @endphp
                <div style="border-bottom: 1px solid #dedede;padding-bottom: 10px;padding-top: 10px;">
                    <div class="" style="width: 15%;float: left;">
                        <a href="javascript:;">
                            <img style="max-width:100%;width:80px;height:100px;object-fit: contain;"
                                 src="https://www.sporter.vn/wp-content/uploads/2022/04/Ao-bong-da-khong-logo-dragon-mau-trang-1.jpg">
                        </a>
                    </div>
                    <div style="width: 80%;float: right;">
                        <h4 style="margin:10px 0">{{ $product->pro_name }}</h4>
                        <p style="margin: 4px 0;font-size: 14px;">Giá <span>{{  number_format($product->pro_price,0,',','.') }} đ</span>
                        </p>
                        @if ($product->pro_sale)
                            <p style="margin: 4px 0;font-size: 14px;">
                                <span style="text-decoration: line-through;">{{  number_price( ($product->pro_price * (100 - $product->pro_sale)) / 100,0),0,',','.' }} đ</span>
                                <span class="sale">- {{ $product->pro_sale }} %</span>
                            </p>
                        @endif
                    </div>
                    <div style="clear: both;"></div>
                </div>
            @endforeach
            @if ($shopping->voucher_id)
            <p>Voucher đã sử dụng : {{ $shopping->voucher->name }}</p>
            @endif
            <h2>Tổng tiền : <b>{{ number_format($total) }}đ</b></h2>
        </div>
        <div>
            <p>Đây là email tự động xin vui không không trả lời vào email này</p>
            </p>
        </div>
    </div>
    <div style="background: #f4f5f5;box-sizing: border-box;padding: 15px">
        <p style="margin:2px 0;color: #333">Email : admin@support.com</p>
        <p style="margin:2px 0;color: #333">Phone : 0123456789</p>
    </div>
</div>
