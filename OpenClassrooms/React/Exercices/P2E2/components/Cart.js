import "../styles/Cart.css";

function Cart() {
  let monsteraPrice = 8;
  let lierrePrice = 10;
  let bouquetPrice = 15;
  return (
    <div className="lmj-cart">
      <h2>Panier</h2>
      <ul>
        <li>Monstera : {monsteraPrice}</li>
        <li>Lierre : {lierrePrice}</li>
        <li>Bouquet : {bouquetPrice}</li>
      </ul>
      <p>Total : {monsteraPrice + lierrePrice + bouquetPrice} </p>
    </div>
  );
}

export default Cart;
