function refresh(){
    showCart();
    count_item();
    itemCheck();
}
function itemCheck(){
    var cart=localStorage.getItem("cart");
    if(cart){
        var cartobj=JSON.parse(cart);
        var total=0;
        $.each(cartobj.itemlist,function(i,v){
        total+=parseInt(v.qty);               
        });
        if(total==0){
            $('#checkout').addClass('disabled');

        }
    }
}
function showCart(){
    var cart = localStorage.getItem('cart');
    if(cart){
        var cartobj = JSON.parse(cart);
        var totl_qty = 0;
        var total = 0;
        var html= '';
        var qty='';
        $.each(cartobj.itemlist,function(i,v){
            var id = v.id;
            var name = v.name;
            var price = v.price;
            var image = v.image;
            qty = v.qty;
            totl_qty += parseInt(qty);
            var rmk = v.rmk;
            var subtotal = qty*price;
            total += subtotal;
            html +=
            `<div class="row mt-4 mb-5">
                <div class="col-xl-5 col-xxl-5 col-12">
                    <img src="${image}" alt="food_image" class="rounded food-image">
                </div>
                <div class="col-xl-7 col-xxl-7 col-12">
                    <div>
                        <div class="row justify-content-between">
                            <div class="col-xxl-4 col-xl-4 col-12 detail">
                                <p class="text-uppercase small">Name: ${name}</p>
                                <p class="text-uppercase small">Price: ${price} Kyats</p>
                            </div>
                            <div class="col-xxl-8 col-xl-8 col-12">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-danger btn-sm px-3" id="qtyMinus" data-index="${i}" onclick="this.parentNode.querySelector('input[type=number]').stepDown();">
                                        <i class="text-light fas fa-minus"></i>
                                    </button>
                                    <input class="form-control border-2 mx-2 qtyInput" data-index="${i}" id="qty" min="1" name="qty" value="${qty}" autocomplete="off" type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                                    <button class="btn btn-success btn-sm px-3" id="qtyPlus" data-index="${i}" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>  
                        </div>
                        <div class="d-flex justify-content-between align-items-center removeTotal">
                            <div>
                                <button  data-index="${i}" class="removeItem btn btn-primary btn-sm card-link-secondary small text-uppercase mr-3">
                                    <i class="fas fa-trash-alt mr-1"></i>
                                    Remove item
                                </button>
                            </div>
                            <span class="ttl text-uppercase d-inline-block">Total - ${subtotal} Kyats</span>
                        </div>`
            if(rmk){
                html+=  
                    `<div id="rmk_place">
                        <div class="row d-flex justify-content-between align-items-center mt-3">
                            <div class="col-xl-2 col-xxl-2 col-12">
                                <div class="text-center">
                                    <p class="text-uppercase small">Remark:</p>
                                </div>
                                <div class="edit">
                                    <button class="add_rmk form-control btn-warning d-inline-block" data-id="${id}" data-bs-toggle="modal" data-bs-target="#rmkModal" aria-hidden="true">Edit</button>
                                </div>
                            </div>  
                            <div class="col-xl-10 col-xxl-10 col-12">
                                <fieldset disabled>
                                    <textarea class="rmk form-control text-white border-dark text-center pt-5" id="remark" name="rmk">${rmk}</textarea>  
                            </div>
                        </div>
                    </div>`}else{
                        html+= 
                        `<div id="rmk_place">
                            <div class="row d-flex justify-content-between align-items-center mt-3">
                                <div class="col-6">
                                    <div class="text-center">
                                        <p class="text-uppercase small" style="float:right;">Remark:</p>
                                    </div><br>
                                </div>  
                                <div class="col-6">
                                    <div class="text-center">
                                        <p class="text-uppercase small" style="float:left;">No Remark</p>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="d-flex justify-content-center">
                            <button class="add_rmk btn btn-warning d-inline-block" data-id="${id}" data-bs-toggle="modal" data-bs-target="#rmkModal" aria-hidden="true">Add Remark</button>
                        </div>
                        `
                    }
                html+=
                `</div>
            </div>
        </div>
    <hr style="color:white;">`
        })
        $('.cartData').html(html);
        $('.totl_amt').html(`${total} Kyats`);
        if(total==0){
            $('.totl_amt').html(`0 Kyat`);
        }
        if(total){
        var famt = total+2500;
        $('.final_amt').html(`${famt} Kyats`);
        }else{
            $('.final_amt').html(`0 Kyat`);
        }
        if(qty){
        count_html = `<p class="text-success"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;You have <strong>${totl_qty}</strong> items in your cart.</p>`
        $('.itemCount').html(count_html);
        }else{
            count_html = `<p class="text-danger"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;You have no item in your cart.</p>`;
            $('.itemCount').html(count_html);
        }
    }
}

function scrollToTop() {
    window.scrollTo(0, 0);
}

$('.removeAll').click(function(){
    if(confirm('Are you sure to remove all?')){
    cart = '{"itemlist":[]}';
    cartobj = JSON.parse(cart);
    localStorage.setItem('cart',JSON.stringify(cartobj));
    refresh();
    }else{
        refresh();
    }
})
$('.cartData').on("click",".removeItem",function(){
    if(confirm('Are you sure to delete this item?')){
    var index = $(this).data('index');
    var cart = localStorage.getItem('cart');
    var cartobj = JSON.parse(cart);
    cartobj.itemlist.splice(index,1);
    localStorage.setItem('cart',JSON.stringify(cartobj));
    refresh();
    }
})

$('.cartData').on("click",'.add_rmk',function(){
    var id = $(this).data('id');
    var cart = localStorage.getItem('cart');
    var cartobj = JSON.parse(cart);
    var name,price,rmk;
    $.each(cartobj.itemlist,function(i,v){
        if(id==v.id){
            name = v.name;
            price = v.price;
            rmk = v.rmk;
        }
    })
    html = 
    `<div class="modal-header">
        <h6 class="modal-title" id="rmkModalLabel">${name} - ${price} Kyats</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-2">
            <label for="remark" class="form-label"></label>
            <textarea id="rmk" class="form-control" id="remark" name="rmk" rows="3" placeholder="Remark for your foods">${rmk}</textarea>
        </div>
    </div>
    <div class="modal-footer mb-1 justify-content-between">
        <button type="button" class="btn btn-dark mr-auto" data-bs-dismiss="modal">Close</button>
        <button type="button" id="modal-done" class="btn btn-success" data-bs-dismiss="modal" data-id="${id}">Done</button>
    </div>`;
    $('#rmkModal .modal-content').html(html);
    if(rmk){
        $('#modal-done').html(`Update`);
    }
})

$('#rmkModal').on("click",'#modal-done',function(){
    var id = $(this).data('id');
    var rmk = $("#rmk").val();
    var cart = localStorage.getItem('cart');
    var cartobj = JSON.parse(cart);
    $.each(cartobj.itemlist,function(i,v){
        if( v.id == id){
            v.rmk = rmk;
        }
    })
    localStorage.setItem('cart',JSON.stringify(cartobj));
    showCart();
})
$('.cartData').on('keyup change','#qty',function(){
    var index = $(this).data('index');
    var qty = $(this).val();
    var cart = localStorage.getItem('cart');
    var cartobj = JSON.parse(cart);
    if(qty==0){
        cartobj.itemlist[index].qty = 1
    }else{
    cartobj.itemlist[index].qty = qty}
    localStorage.setItem('cart',JSON.stringify(cartobj));
    refresh();
})
function count_item(){      
    var cart=localStorage.getItem("cart");
    if(cart){
        var cartobj=JSON.parse(cart);
        var total=0;
        $.each(cartobj.itemlist,function(i,v){
        total+=parseInt(v.qty);               
        });
        $("#cart-badge").html(total);
    }
}

$('.cartData').on("click","#qtyMinus",function(){
    var index = $(this).data('index');
    var qty = $('#qty').val();
    var cart = localStorage.getItem('cart');
    var cartobj = JSON.parse(cart);
    if(qty<2){
        cartobj.itemlist[index].qty= 1;
        refresh();
    }else{
    cartobj.itemlist[index].qty--;
}
    localStorage.setItem('cart',JSON.stringify(cartobj));
    refresh();
})

$('.cartData').on("click","#qtyPlus",function(){
    var index = $(this).data('index');
    var qty = $('#qty').val();
    var cart = localStorage.getItem('cart');
    var cartobj = JSON.parse(cart);
    cartobj.itemlist[index].qty++;
    localStorage.setItem('cart',JSON.stringify(cartobj));
    refresh();
})

$('#checkout').click(function(){
    if(confirm('Are you sure to order all?')){
        var user_id = $(this).data('user');
        if(user_id==''){
            alert("You must login first!");
            window.location="http://localhost:8000/login"
        }else{
            var cart=localStorage.getItem('cart');     
            var cartobj=JSON.parse(cart);
            if($('#c_add').attr('checked')){
                var location = $('#location').val();
                if(location==''){
                    var a = prompt("Enter your location:");
                    if(a==''){
                        die();
                    }
                    location = a;
                }
            }else if($('#d_add').attr('checked')){
                var location = $('#d_location').val();
            }
            var newdata = {};
            newdata['data'] = {"location":location};
            $.extend(true,cartobj,newdata);
            $.ajax({
                url:'http://localhost:8000/gotocheck',
                type:'POST',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: cartobj,
                success:function(data){
                    if(data){
                        var cart = '{"itemlist":[]}';
                        cartobj = JSON.parse(cart);
                        localStorage.setItem('cart',JSON.stringify(cartobj));
                        window.location="http://localhost:8000/orders#orders";
                    }
                },
                error:function(data){
                    alert("Enter your location please!")
                }
            })
        }
    }
})

$('#c_add').click(function(){
    if($('#d_add').attr('checked')){
        $('#d_add').removeAttr('checked');
    }
    $('#c_add').attr('checked',true);
    $('#location').removeAttr('disabled');
})

$('#d_add').click(function(){
    if($('#c_add').attr('checked')){
        $('#c_add').removeAttr('checked');
    }
    $('#d_add').attr('checked',true);
    $('#location').attr('disabled',true);
})