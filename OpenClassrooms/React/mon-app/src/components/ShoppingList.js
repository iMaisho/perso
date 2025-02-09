import { plantList } from "../datas/plantList";
import "../styles/ShoppingList.css";
import PlantItem from "./PlantItem";
import monstera from "../assets/monstera.jpg";

function groupBy(list, property) {
  return list.reduce(function (acc, val) {
    var cle = val[property];
    if (!acc[cle]) {
      acc[cle] = [];
    }
    acc[cle].push(val);
    return acc;
  }, {});
}
let groupedList = groupBy(plantList, "category");
let categories = Object.keys(groupedList);

function ShoppingList({ cart, updateCart, categorySelected }) {
  function addToCart(name, price, id) {
    const currentPlantAdded = cart.find((plant) => plant.name === name);
    if (currentPlantAdded) {
      const cardFilteredCurrentPlant = cart.filter(
        (plant) => plant.name !== name
      );
      updateCart([
        ...cardFilteredCurrentPlant,
        { name, price, id, amount: currentPlantAdded.amount + 1 },
      ]);
    } else {
      updateCart([...cart, { name, price, id, amount: 1 }]);
    }
  }

  function filter(categorySelected) {
    return categorySelected === "Pas de filtre"
      ? categories
      : categories.filter((category) => category === categorySelected);
  }

  let filteredCategories = filter(categorySelected);

  return (
    <div className="lmj-shopping-list">
      {filteredCategories.map((category) => (
        <ul key={category}>
          {category.toUpperCase()}
          {groupedList[category].map(
            ({ id, name, water, light, isSpecialOffer, price }) => (
              <li key={id}>
                <PlantItem
                  name={name}
                  cover={monstera}
                  id={id}
                  light={light}
                  water={water}
                  isSpecialOffer={isSpecialOffer}
                  price={price}
                />
                <button onClick={() => addToCart(name, price, id)}>
                  Ajouter au panier
                </button>
              </li>
            )
          )}
        </ul>
      ))}
    </div>
  );
}

export default ShoppingList;
