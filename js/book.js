const gridForm = document.getElementById("grid-form");
const clickedBoxInput = document.getElementById("clicked-box");
const gridContainer = document.querySelector(".grid-container");
const paymentButton = document.querySelector(".payment-button");

// Function to handle box click event
function handleBoxClick(event) {
  const target = event.target;
  if (target.classList.contains("grid-item")) {
    const boxId = target.id;
    clickedBoxInput.value = boxId;

    // Change the background color of the clicked box
    target.style.backgroundColor = "lightblue";
    console.log(clickedBoxInput.value);
  }
}

gridContainer.addEventListener("click", handleBoxClick);

for (let row = 1; row <= 8; row++) {
  for (let col = 1; col <= 8; col++) {
    const uniqueId = `${String.fromCharCode(64 + row)}-${col}`;
    const gridItem = document.createElement("div");
    gridItem.className = "grid-item";
    gridItem.id = uniqueId;
    //gridItem.setAttribute("name", uniqueId);

    // Create a text element to display the box ID
    const boxLabel = document.createElement("span");
    boxLabel.className = "box-label";
    boxLabel.textContent = uniqueId;
    gridItem.appendChild(boxLabel);

    gridContainer.appendChild(gridItem);
  }
}

paymentButton.addEventListener("click", function () {
  gridForm.submit(); // Submit the form when the button is clicked
});
