let opencartBtn = document.querySelector('.opencartBtn');
let closeCart = document.querySelector('.close');
let body = document.querySelector('body');
let listProductHTML = document.querySelector('.listProduct');

let listProducts = [];

opencartBtn.addEventListener('click', () => {
    body.classList.toggle('showCart')
})
closeCart.addEventListener('click', () => {
    body.classList.toggle('showCart')
})
const addDatatoHTML = () => {
    listProductHTML.innerHTML = '';
    if (listProducts.length > 0) {
        listProducts.forEach(product => {
            let newProduct = document.createElement('div');
            newProduct.classList.add('item');
            newProduct.innerHTML = `
            <img id="menupic" src=${product.image}>
            <p><b>${product.name}</b></p>
            <p id="price"><i>₱${product.price}</i></p>
            <button type="" id="b2" class="cartbutton">
                <img id="cart" src="menu/shopping-cart.png">Add to Cart</button>
            `;
            listProductHTML.appendChild(newProduct);

        })
    }
}

const initApp = () => {
    // get data product
    fetch('products.json')
        .then(response => response.json())
        .then(data => {
            listProducts = data;
            addDatatoHTML();

        })
}
initApp();