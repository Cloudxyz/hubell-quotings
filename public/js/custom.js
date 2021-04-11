let quantitys = document.getElementsByName('quantity');
let alerts = document.getElementsByClassName('alert')[0];
let totals = document.getElementsByName('total');
let token = document.getElementsByName('csrf-token')[0].getAttribute('content');

quantitys.forEach((quantity) => {
    const min_quantity = quantity.min;
    quantity.addEventListener('input', (e) => {
        var sumTotalUSD = 0;
        var sumTotalMXN = 0;
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
        
        totals.forEach((total) => {
            let unit = total.nextElementSibling.innerText;
            if(unit == 'USD'){
                totalUSD = total.innerText.replace('$','');
                sumTotalUSD += parseFloat(totalUSD);
                let containerTotalUSD = document.getElementsByClassName('total-usd')[0];
                containerTotalUSD.innerHTML = Number.parseFloat(sumTotalUSD).toFixed(2);
            }

            if(unit == 'MXN'){
                totalMXN = total.innerText.replace('$','');
                sumTotalMXN += parseFloat(totalMXN);
                let containerTotalMXN = document.getElementsByClassName('total-mxn')[0];
                containerTotalMXN.innerHTML = Number.parseFloat(sumTotalMXN).toFixed(2);
            }
        });

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
                totalUSD: sumTotalUSD,
                totalMXN: sumTotalMXN,
            })
        })
        .then(function(response) {
            console.log('success');
        })
        .catch((error) => {
            console.log(error);
        })
        valueQuantity = e.target.value;
    });
});

if(typeof(alerts) != 'undefined' && alerts != null){
    setTimeout(() => {
        alerts.parentNode.style.display = 'none';
    }, 5000);
}

//Generate Productos