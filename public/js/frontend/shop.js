$(".plus").on("click",function(){
    var food = $(this).data('info');
    var id = food.id;
    var name = food.food_name;
    var image = food.image;
    var price = food.price;
    var rmk = '';
    var item = {
        id:id,
        name:name,
        image:image,
        price:price,
        qty:1,
        rmk:rmk
    }
    console.table(item);
    var cart = localStorage.getItem("cart");
    if(!cart){
        cart = '{"itemlist":[]}';
    }
    var cartobj = JSON.parse(cart);
    var hasid = false;

    $.each(cartobj.itemlist,function(i,v){
        if(v.id==id){
            hasid=true;
            v.qty++;
        }
    });
    if(!hasid){
        cartobj.itemlist.push(item);
    }
    localStorage.setItem("cart",JSON.stringify(cartobj));
    console.log(cartobj);
    refresh();
});
function cart_bill(){
    var cart = localStorage.getItem("cart");
    if(cart){
        var cartobj = JSON.parse(cart);
        var total = 0
        var html= '';
        $.each(cartobj.itemlist,function(i,v){
            var id = v.id;
            var name = v.name;
            var image = v.image;
            var price = v.price;
            var qty = v.qty;
            var rmk = v.rmk;
            var subtotal = qty*price;
            total += subtotal;
            html += 
                `<tr>
                    <td id="showModal" data-id="${id}" data-name="${name}" data-price="${price}" data-qty="${qty}" data-rmk="${rmk}" data-image="${image}" data-bs-toggle="modal" data-bs-target="#viewModal" aria-hidden="true">${name}</td>
                    <td style="user-select:none;">
                        <a data-id="${id}" data-index="${i}" class="remove text-white" style="cursor:pointer;"><i class="fas fa-minus"></i></a>
                        <span>${qty}</span>
                        <a data-id="${id}" class="add text-white" style="cursor:pointer;"><i class="fas fa-plus"></i></a>  
                    </td>
                    <td>
                        ${price} Kyats
                        <a data-index="${i}" class="delete text-danger ml-2" style="cursor:pointer;"><i class="far fa-trash-alt"></i></a>
                    </td>
                                
                </tr>`
        });
        $("#bill-data").html(html);
        ttl = `${total} Kyats`;
        $("#bill-total").html(ttl);
    }
}
$("#bill-data").on("click",".delete",function(){
    var index = $(this).data('index');
    var cart = localStorage.getItem("cart");
    var cartobj = JSON.parse(cart);
    cartobj.itemlist.splice(index,1);
    localStorage.setItem("cart",JSON.stringify(cartobj));
    refresh();
})
$("#bill-data").on("click",".add",function(){
    var id = $(this).data("id");
    console.log(id);
    var cart = localStorage.getItem("cart");
    var cartobj = JSON.parse(cart);
    $.each(cartobj.itemlist,function(i,v){
        if(v.id==id){
            v.qty++;
        }
    })
    localStorage.setItem("cart",JSON.stringify(cartobj));
    refresh();
})
$("#bill-data").on("click",".remove",function(){
    var id = $(this).data("id");
    console.log(id);
    var cart = localStorage.getItem("cart");
    var cartobj = JSON.parse(cart);
    $.each(cartobj.itemlist,function(i,v){
        if(v.id==id){
            if(v.qty>1){
                v.qty--;
            }else{
                var index = $(this).data('index');
                cartobj.itemlist.splice(index,1);
            }
        }
    })
    localStorage.setItem("cart",JSON.stringify(cartobj));
    refresh();
});

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


function refresh(){
    count_item();
    cart_bill(); 
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
        if(total!==0){
            $('#gtc').removeClass('disabled');
        }else{
            $('#gtc').addClass('disabled');
        }
    }
}


$(".card").on("click",".view",function(){
    var food = $(this).data('info');
    var id = food.id;
    var name = food.food_name;
    var price = food.price;
    var image = food.image;
    var ingredients = food.ingredients;
    var qty ='';
    var rmk = '';
    var hasid = false;
    var cart = localStorage.getItem('cart');
    var cartobj = JSON.parse(cart);
    $.each(cartobj.itemlist,function(i,v){
        if(v.id==id){
            rmk = v.rmk;
            qty = v.qty;
            hasid = true;
        }
    });
    if(id){
        html=
        `<div class="modal-header">
        <h6 class="modal-title" id="viewModalLabel">${name} - ${price} Kyats</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
            <img src="${image}" alt="food_image" height="300px" width="444px" style="display:block;margin:0 auto;">
            <div class="row mt-3">
                <div class="col-12">`
    if(ingredients){
        html+=
        `<div class="mb-3 form-control border-1">
            <a class="d-flex justify-content-between" style="text-decoration:none;color:black;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Ingredients
                <i class="fas fa-chevron-down pt-1"></i>
            </a>    
        </div>
        <div class="collapse mb-3" id="collapseExample">
            <div class="card card-body">
                <textarea style="user-select:none;resize:none;" class="form-control" rows="3"disabled>${ingredients}</textarea>
            </div>
        </div>`}
                
        html+=
        `<div class="d-flex justify-content-between" id="qty-box">
                        <button class="btn btn-danger btn-sm px-3" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                        ><i class="text-light fas fa-minus"></i></button>
                        <input class="form-control border-2" id="qty" min="0" name="qty" value="${qty}" placeholder="0" autocomplete="off" type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                        <button class="btn btn-primary btn-sm px-3" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                        ><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <p class="text-muted text-uppercase small text-center mt-2">*Do not forget to add quantity.</p>
            </div>
            <div class="mb-2">
                <label for="remark" class="form-label"></label>
                <textarea class="rmk form-control" id="remark" name="rmk" rows="3" placeholder="Remark for your foods">${rmk}</textarea>
            </div>
    </div>
    <div class="modal-footer mb-1 justify-content-between">
        <button type="button" class="btn btn-dark mr-auto" data-bs-dismiss="modal">Close</button>
        <button type="button" id="modal-click" class="btn btn-success" data-bs-dismiss="modal">Add To Cart</button>
    </div>`
    }
    $('.modal-content').html(html);
    if(hasid){
        $('#modal-click').html(`Update Cart`);
    }
    var cart = '{"item":[]}';
    var cartobj = JSON.parse(cart);
    localStorage.setItem('modal',JSON.stringify(cartobj));
    var item = {
        id:id,
        name:name,
        image:image,
        price:price,
        qty:1,
        rmk:rmk
    }
    cartobj.item.push(item);
    localStorage.setItem('modal',JSON.stringify(cartobj));
})
$("#viewModal").on("click","#modal-click",function(){
    var cart = localStorage.getItem("modal");
    var cartobj = JSON.parse(cart);
    var id,name,price,image;
    var qty = $("#qty").val();
    if(qty==0){
        alert("Quantity cannot be zero");
        die();
    }
    var rmk = $(".rmk").val();
    $.each(cartobj.item,function(i,v){
        id = v.id,
        name = v.name,
        price = v.price,
        image = v.image
    })
    var item = {
        id:id,
        name:name,
        price:price,
        image:image,
        qty:qty,
        rmk:rmk
    }
    var cart = localStorage.getItem("cart");
    if(!cart){
        cart = '{"itemlist":[]}';
    }
    var cartobj = JSON.parse(cart);
    var hasid = false;
    $.each(cartobj.itemlist,function(i,v){
        if(v.id==id){
            hasid =  true,
            v.qty = qty,
            v.rmk = rmk
        }
    });
    if(!hasid){
        cartobj.itemlist.push(item);
    }
    localStorage.setItem("cart",JSON.stringify(cartobj));
    refresh();
})
$("tbody#bill-data").on("click","#showModal",function(){
    var id = $(this).data('id');
    var name = $(this).data('name');
    var price = $(this).data('price');
    var qty = $(this).data('qty');
    var rmk = $(this).data('rmk');
    var image = $(this).data('image');
    if(id){
        html=
            `<div class="modal-header">
            <h6 class="modal-title" id="viewModalLabel">${name} - ${price} Kyats</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <img src="${image}" alt="food_image" height="300px" width="444px" style="display:block;margin:0 auto;">
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="d-flex justify-content-between" id="qty-box">
                            <button class="btn btn-danger btn-sm px-3" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                            ><i class="text-light fas fa-minus"></i></button>
                            <input class="form-control border-2" id="qty" min="0" name="qty" value="${qty}" placeholder="0" autocomplete="off" type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                            <button class="btn btn-primary btn-sm px-3" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                            ><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <p class="text-muted text-uppercase small text-center mt-2">*Do not forget to add quantity.</p>
                <div class="mb-2">
                    <label for="remark" class="form-label"></label>
                    <textarea class="rmk form-control" id="remark" name="rmk" rows="3" placeholder="Remark for your foods">${rmk}</textarea>
                </div>
        </div>
        <div class="modal-footer mb-1 justify-content-between">
            <button type="button" class="btn btn-dark mr-auto" data-bs-dismiss="modal">Close</button>
            <button type="button" id="modal-click" class="btn btn-success" data-bs-dismiss="modal">Update Cart</button>
        </div>`
    }
    $(".modal-content").html(html);
    var cart = '{"item":[]}';
    var cartobj = JSON.parse(cart);
    var item = {
        id:id,
        name:name,
        price:price,
        qty:qty,
        rmk:rmk
    }
    cartobj.item.push(item);
    localStorage.setItem('modal',JSON.stringify(cartobj));

})