import { plantList } from "../datas/plantList";
import "../styles/ShoppingList.css";

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

function ShoppingList() {
  return (
    <div className="lmj-shopping-list">
      {categories.map((category) => (
        <ul key={category}>
          {category.toUpperCase()}
          {groupedList[category].map((plant) => (
            <li key={plant.id}>{plant.name}</li>
          ))}
        </ul>
      ))}
    </div>
  );
}

export default ShoppingList;
