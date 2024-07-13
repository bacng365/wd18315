<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Danh sách sản phẩm</title>
</head>
<body>
    <div>
        <label for="">Tìm kiếm sản phẩm</label>
        <input type="text" name="search" id="searchBox">
        <div id="result"></div>
    </div>
    <div>
        <a href="{{ route('products.addProducts') }}">Thêm sản phẩm</a>
    </div>
    <table border="1">
        <thead>
            <th>STT</th>
            <th>Tên</th>
            <th>Giá</th>
            <th>Lượt xem</th>
            <th>Danh mục</th>
            <th>Hành động</th>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->view }}</td>
                    <td>{{ $product->categoryName }}</td>
                    <td>
                        <a href="{{ route('products.editProducts', $product->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('products.deleteProducts') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" value="{{ $product->id }}" name="productId">
                            <button type="button" class="deleteBtns">Xóa</button>
                        </form>

                        {{-- <a href="{{ route('products.deleteProducts', $product->id) }}" class="btn btn-danger">Xóa</a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        let deleteBtns = document.querySelectorAll('.deleteBtns');
        deleteBtns.forEach(element => {
            element.addEventListener('click', (e) => {
                let isDelete = window.confirm('Bạn có muốn xóa sản phẩm không?');
                if (isDelete) {
                    element.parentElement.submit();
                }
            })
        });

        let searchBox = document.querySelector('#searchBox');
        let result = document.querySelector('#result');
        // console.log(result);
        searchBox.addEventListener('keyup', function(e) {
            // console.log(e.target.value);
            $.ajax({
                    url: 'search-product',
                    type: 'GET',
                    // dataType: 'html',
                    data: {
                        searchName: e.target.value
                    }
            }).done(function(ketqua) {
                result.innerHTML = "";
                console.log(ketqua);
                let productNames = '';
                (ketqua).forEach(element => {
                    productNames += `<div>${element.name}</div>`;
                });
                result.innerHTML = productNames;
            });
        })

        // console.log(result);
        // $(document).ready(function() {
        //     $('#searchBox').click(function(e) {
        //         // result.textContent = e.value;
        //         console.log(e.value);
        //         let productNames = '';

        //         (e).forEach(element => {
        //             productNames += `<div>${element.name}</div>`;
        //         });
        //         result.textConent = productNames;
        //     });
        // });
    </script>
</body>
</html>