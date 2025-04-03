@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Đặt hàng thành công!</h2>
    <p>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi.</p>
    <a href="{{ route('products.index') }}" class="btn btn-primary">OK</a>
</div>
@endsection
