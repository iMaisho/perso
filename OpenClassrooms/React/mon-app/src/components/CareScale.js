function CareScale({ scaleValue, careType }) {
  const range = [1, 2, 3];
  const scaleType = careType === "light" ? "☀️" : "💧";

  return (
    <div onClick={() => showCareScale(scaleValue, careType)}>
      {range.map((rangeElem) =>
        scaleValue >= rangeElem ? (
          <span key={rangeElem.toString()}>{scaleType}</span>
        ) : null
      )}
    </div>
  );
}

function showCareScale(scaleValue, careType) {
  let quantity = "";
  switch (scaleValue) {
    case 1:
      quantity = "peu";
      break;
    case 2:
      quantity = "modérement";
      break;
    case 3:
      quantity = "beaucoup";
  }

  let quality = "";
  switch (careType) {
    case "light":
      quality = "de lumière";
      break;
    case "water":
      quality = "d'arrosage";
      break;
  }

  alert(`Cette plante requiert ${quantity} ${quality}.`);
}

export default CareScale;
