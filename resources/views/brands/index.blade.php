@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<style>
    .container {
        max-width: 1100px;
        margin: 60px auto;
        padding: 40px;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    h1 {
        text-align: center;
        margin-bottom: 35px;
        font-size: 32px;
        color: #6b46c1;
        font-weight: 700;
    }

    .btn-create {
        background: #6b46c1;
        color: #fff;
        padding: 10px 18px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        transition: background 0.3s ease;
    }

    .btn-create:hover {
        background: #5936a3;
        text-decoration: none;
    }

    .table {
        width: 100%;
        margin-top: 30px;
        border-collapse: collapse;
        font-size: 16px;
    }

    .table th, .table td {
    padding: 16px;
    border: 1px solid #eee;
    text-align: center;
    vertical-align: middle;
    }

    .table th {
        background: #f8f9ff;
        color: #555;
        font-weight: bold;
    }

    .table tr:nth-child(even) {
        background: #fcfcfc;
    }

    .table tr:hover {
        background: #f2f2ff;
    }

    .icon-btn {
        border: none;
        background: none;
        cursor: pointer;
        color: #6b46c1;
        font-size: 18px;
        margin-right: 8px;
        transition: transform 0.2s;
    }

    .icon-btn:hover {
        transform: scale(1.2);
        color: #4c2e9f;
    }

    .delete-btn:hover {
        color: #e3342f;
    }

    .action-icons {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    }

    .tooltip {
        position: relative;
    }

    .tooltip:hover::after {
        content: attr(data-tooltip);
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translateX(-50%);
        background: #333;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        white-space: nowrap;
    }
</style>

<div class="container">
    <h1>Danh sách Thương hiệu</h1>
    <a href="{{ route('brands.create') }}" class="btn-create"><i class="fas fa-plus"></i> Thêm mới</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên thương hiệu</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
                <tr>
                    <td>{{ $brand->id }}</td>
                    <td>{{ $brand->name }}</td>
                    <td>
                        <div class="action-icons">
                            <a href="{{ route('brands.edit', $brand->id) }}" class="icon-btn tooltip" data-tooltip="Chỉnh sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="icon-btn delete-btn tooltip" data-tooltip="Xóa">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
