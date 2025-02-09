import CareScale from "./CareScale";
import "../styles/PlantItem.css";

function handleClick(plantName) {
  alert(`Vous voulez acheter 1 ${plantName} ? Très bon choix 🌱✨`);
}

function PlantItem({ name, cover, id, light, water, isSpecialOffer }) {
  return (
    <div className="lmj-plant-item" onClick={() => handleClick(name)}>
      {isSpecialOffer ? <div className="lmj-sales"> En soldes !</div> : null}
      <img src={cover} alt={name} className="lmj-plant-item-cover" />
      <p>{name}</p>
      <CareScale careType="light" scaleValue={light} />
      <CareScale careType="water" scaleValue={water} />
    </div>
  );
}

export default PlantItem;
