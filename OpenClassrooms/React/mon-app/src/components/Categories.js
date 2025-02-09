import { plantList } from "../datas/plantList";

function Categories({ updateCategory }) {
  let categories = ["Pas de filtre"];
  for (let plant of plantList) {
    if (!categories.includes(plant.category)) {
      categories.push(plant.category);
    }
  }
  return (
    <div>
      <h3>Filtrer par catégorie</h3>
      <select onChange={(e) => updateCategory(e.target.value)}>
        {categories.map((category) => (
          <option key={category} value={category}>
            {category}
          </option>
        ))}
      </select>
    </div>
  );
}

export default Categories;
