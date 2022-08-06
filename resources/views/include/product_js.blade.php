<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    $(document).ready(function (){

        function nitification(type, message){
            Command: toastr[type](message)

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        }

        $(document).on('click', '.add_product', function (event){
            event.preventDefault();

            let name = $('#name').val();
            let price = $('#price').val();

            $.ajax({
                url: "{{route('add.product')}}",
                method: 'post',
                data: {name, price},
                success: function (res){
                    if(res.status == 'success'){
                        $('#addModal').modal('hide');
                        $('#addProductForm')[0].reset();
                        $('.table').load(location.href+' .table');

                        nitification('success','Product Add Successfully');
                    }
                },
                error: function (err){
                    let errors = err.responseJSON.errors;
                    $.each(errors, function (key, value){
                        $('.errMassesContainer').append('<span class="text-danger">' + value + '</span>'+'<br>');
                    })
                }
            })
        });


        //edit product
        $(document).on('click', '#update_product_form', function (){
           let id = $(this).data('id');
           let name = $(this).data('name');
           let price = $(this).data('price');

           $('#product_id').val(id);
           $('#up_name').val(name);
           $('#up_price').val(price);
        });



        // update Product
        $(document).on('click', '.update_product', function (event){
            event.preventDefault();

           let id = $('#product_id').val();
           let name = $('#up_name').val();
           let price = $('#up_price').val();

            $.ajax({
                url: "{{route('update.product')}}",
                method: 'post',
                data: {id, name, price},
                success: function (res){
                    if(res.status == 'success'){
                        $('#updateModal').modal('hide');
                        $('#updateProductForm')[0].reset();
                        $('.table').load(location.href+' .table');
                        nitification('success','Update Successfully');
                    }
                },
                error: function (err){
                    let errors = err.responseJSON.errors;
                    $.each(errors, function (key, value){
                        $('.errMassesContainer').append('<span class="text-danger">' + value + '</span>'+'<br>');
                    })
                }
            })
        });


        // delete Product
        $(document).on('click', '.delete_product', function (event){
            event.preventDefault();
            let id = $(this).data('id');

            if(confirm('Are you sure to delete product ?')){

                $.ajax({
                    url: "{{route('delete.product')}}",
                    method: 'post',
                    data: {id},
                    success: function (res){
                        if(res.status == 'success'){
                            $('.table').load(location.href+' .table');
                            nitification('warning','Delete Successfully');
                        }
                    }
                })
            }
        });


        //Pagination
        $(document).on('click', '.pagination a', function (event){
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            $.ajax({
                url: "product/paginate?page="+page,
                success: function (res){
                    $('.table-data').html(res);
                }
            })
        });


        // Searching
        $(document).on('keyup','#search',function (event){
            event.preventDefault();
            let search_keyword = $(this).val();

            $.ajax({
                url: "{{route('product.search')}}",
                method: 'GET',
                data: {search:search_keyword},
                success: function (res){
                    $('.table-data').html(res);

                    if(res.status == 'not_fount'){
                        $('.table-data').html(`<h5 class="text-danger text-center">${'😋 SORRY 😋 Data Not Found'}</h5>`);
                    }
                }
            })
        })






    })
</script>
