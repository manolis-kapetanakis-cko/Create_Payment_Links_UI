var $ = window.jQuery;

function createLink() {
    let currency = document.getElementById("currency").value;
    let amount = document.getElementById("amount").value;
    let reference = document.getElementById("reference").value;
    let customer_name = document.getElementById("customer_name").value;
    let customer_email = document.getElementById("customer_email").value;
    let billing_country = document.getElementById("billing_country").value;

    let product_name, product_quantity, product_price
    if (document.getElementById("product_name"))
        product_name = document.getElementById("product_name").value;
    else product_name = ""
    if (document.getElementById("product_quantity"))
        product_quantity = document.getElementById("product_quantity").value;
    else product_quantity = ""
    if (document.getElementById("product_price"))
        product_price = document.getElementById("product_price").value;
    else product_price = ""

    let expires_in = document.getElementById("expires_in").value;
    let return_url = document.getElementById("return_url").value;


    $.post(
        "server/payment.php",
        {
            currency: currency,
            amount: amount,
            reference: reference,
            customer_name: customer_name,
            customer_email: customer_email,
            billing_country: billing_country,
            product_name: product_name,
            product_quantity: product_quantity,
            product_price: product_price,
            expires_in: expires_in,
            return_url: return_url,
        },
        function (data, status) {
            console.log(data);
            document.getElementById("new_link").innerHTML = data
        }
    );
}