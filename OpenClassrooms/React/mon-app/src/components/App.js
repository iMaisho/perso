import { useState } from "react";
import Banner from "./Banner";
import Cart from "./Cart";
import ShoppingList from "./ShoppingList";
import Footer from "./Footer";
import Categories from "./Categories";

function App() {
  let isCartEmpty = localStorage.getItem("cart");
  const [cart, updateCart] = useState(() =>
    isCartEmpty !== null ? JSON.parse(isCartEmpty) : []
  );
  const [categorySelected, updateCategory] = useState("");

  return (
    <div>
      <Banner />
      <div className="lmj-layout-inner">
        <Cart cart={cart} updateCart={updateCart} />
        <Categories updateCategory={updateCategory} />
        <ShoppingList
          cart={cart}
          updateCart={updateCart}
          categorySelected={categorySelected}
        />
      </div>
      <Footer />
    </div>
  );
}

export default App;
