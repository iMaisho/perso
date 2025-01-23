class Cart {

    constructor() {
        this.items = [];
    }
    addProduct (product) {
        const existingProduct = this.items.find(item => item.id === product.id);
        if (existingProduct) {
            existingProduct.quantity++;
        }
        else {
            this.items.push({ id: product.id, price: product.price, quantity: 1 });
        }
    }
    getTotalValue () {
        return this.items
            .map(item => item.price * item.quantity)
            .reduce((sum, price) => sum + price);
    }
}

newCart = new Cart();
// On peut imaginer que ces données seraient récupérées en JSON, grâce à un API
newCart.addProduct({ id: "clavier", price: 500 })
newCart.addProduct({ id: "clavier", price: 500 })
console.log(newCart.getTotalValue())