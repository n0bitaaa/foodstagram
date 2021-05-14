$('.orderData').on('click','#reorder',function(){
    if(confirm('Are you sure to reorder this?')){
        var order = $(this).data('info');
        var id,name,price,qty,rmk,image;
        var cart = '{"itemlist":[]}';
        var cartobj = JSON.parse(cart);
        $.each(order.foods,function(i,v){
            id = v.id;
            name = v.food_name;
            price = v.price;
            image = v.image;
            qty = v.pivot.qty;
            rmk = v.pivot.rmk;
            var item = {
                id:id,
                name:name,
                price:price,
                image:image,
                qty:qty,
                rmk:rmk
            }
            cartobj.itemlist.push(item);
        })
        localStorage.setItem('cart',JSON.stringify(cartobj));
        window.location = "http://localhost:8000/cart";
        
    }
})