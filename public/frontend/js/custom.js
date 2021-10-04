$(document).ready(function(){

    loadcart();
    loadwishlist();

    function loadcart(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method:"GET",
            url:"/load-cart-data",
            success:function(responce){
                $('.cart-count').html('');
                $('.cart-count').html(responce.count);
            }
        });
    }

    function loadwishlist(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method:"GET",
            url:"/load-wishlist-data",
            success:function(responce){
                $('.wishlist-count').html('');
                $('.wishlist-count').html(responce.count);
            }
        });
    }

    $('.addtocart').click(function(e){
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty-input').val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method:"POST",
            url:"/add-to-cart",
            data:{
                'product_id':product_id,
                'product_qty':product_qty,
            },
            success:function(responce){
                loadcart();
                swal(responce.status);
            }
        });
    });

    $('.addtowishlist').click(function(e){
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method:"POST",
            url:"/add-to-wishlist",
            data:{
                'product_id':product_id,
            },
            success:function(responce){
                loadwishlist();
                swal(responce.status);
            }
        });

    });
    
    $('.increment-btn').click(function(e){
        e.preventDefault();
        var inc_val = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(inc_val,10);
        value == isNaN(value) ? 0 : value;
        if(value < 10)
        {
            value++;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    $('.decrement-btn').click(function(e){
        e.preventDefault();
        var dec_val =  $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(dec_val,10);
        value == isNaN(value) ? 0 : value;
        if(value > 1)
        {
            value--;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    $('.remove-wishlist-item').click(function(e){
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method:"POST",
            url:"/delete-to-wishlist",
            data:{
                'product_id':product_id,
            },
            success:function(responce){
                swal("",responce.status,"success");
                window.location.reload();
            }
        });
    });

    $('.delete-cart-item').click(function(e){
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method:"POST",
            url:"/delete-to-cart",
            data:{
                'product_id':product_id,
            },
            success:function(responce){
                window.location.reload();
                swal("",responce.status,"success");
            }
        });
    });

    $('.change-btn').click(function(e){
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var qty =  $(this).closest('.product_data').find('.qty-input').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method:"POST",
            url:"/update-cart",
            data:{
                'product_id':product_id,
                'product_qty':qty,
            },
            success:function(responce){
                window.location.reload();
            }
        });
    });
});