<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel 9 Ajax Crud</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
</head>
<body>



    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="text-center py-5">Laravel 9 Ajax Crud</h2>
                <div class="row pb-3">
                    <div class="col-3">

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                            + Add Product
                        </button>

                    </div>
                    <div class="col-9">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search here...">
                    </div>
                </div>

                <div class="table-data">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col" width="120px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $key => $product)
                            <tr>
                                <th>{{ $key+1 }}</th>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>
                                    <a href="" class="btn btn-sm btn-primary" id="update_product_form"
                                       data-bs-toggle="modal" data-bs-target="#updateModal"
                                       data-id="{{$product->id}}"
                                       data-name="{{$product->name}}"
                                       data-price="{{$product->price}}"
                                    >
                                    <i class="las la-edit"></i> </a>
                                    <a href="" class="btn btn-sm btn-danger delete_product" data-id="{{$product->id}}" >
                                        <i class="las la-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{$products->links()}}

                </div>
            </div>
        </div>
    </div>


    @include('include.add_product_modal');
    @include('include.update_product_modal');
    @include('include.product_js')

    {!! Toastr::message() !!}

</body>
</html>

