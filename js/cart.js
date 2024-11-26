//on page load, update cart count
window.addEventListener("load", function(){
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    document.getElementById("cart-count").innerText = cart.length;
});