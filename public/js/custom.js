let quantitys = document.getElementsByName('quantity');
let alerts = document.getElementsByClassName('alert')[0];
let token = document.getElementsByName('csrf-token')[0].getAttribute('content');

quantitys.forEach((quantity) => {
    const min_quantity = quantity.min;
    quantity.addEventListener('input', (e) => {
        let route = e.target.dataset.route;
        let material = e.target.dataset.material;
        
        let quantity = e.target.value;

        if(quantity < min_quantity){
            quantity = min_quantity;
            e.target.value = min_quantity;
        }

        let inputPrice = e.target.parentNode.nextElementSibling;
        let inputDiscount = e.target.parentNode.nextElementSibling.nextElementSibling;
        let inputAmount = e.target.parentNode.nextElementSibling.nextElementSibling.nextElementSibling;

        // Generate the price list
        let productPrice = inputPrice.innerText.replace('$','');
        let productDiscount = inputDiscount.innerText.replace('%','');
        let discount = productDiscount / 100;
        let discountAmount = productPrice - (productPrice * discount);

        price = quantity * discountAmount;
        price = Number.parseFloat(price).toFixed(2);
        inputAmount.innerHTML = `$${price}`;

        fetch(route, {
            method: "post",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                "X-CSRF-TOKEN": token
            },
        
            body: JSON.stringify({
                material: material,
                price: price,
                quantity: quantity,
            })
        })
        .then(function(response) {
            console.log(response);
        })
        .catch((error) => {
            console.log(error);
        })
        
    });
});

if(typeof(alerts) != 'undefined' && alerts != null){
    setTimeout(() => {
        alerts.parentNode.style.display = 'none';
    }, 5000);
}

//Generate Productos