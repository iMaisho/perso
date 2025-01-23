var products = [
    {
        label: "souris",
        unitPrice: 30,
        quantity: 200
    },
    {
        label: "clavier",
        unitPrice: 20,
        quantity: 300
    },
    {
        label: "ordinateur",
        unitPrice: 699,
        quantity: 100
    }
]

function addProduct (lb, price, qty) {
    products.push({ label: lb, unitPrice: price, quantity: qty })
};

addProduct("tapis de souris", 10, 500);
console.log(products);
function getStockValue (list) {
    return list.map(function (item) {
        return (item.unitPrice) * (item.quantity);
    })
        .reduce(function (acc, value) {
            return acc + value;
        })

}

var stockValue = getStockValue(products)
console.log(stockValue);