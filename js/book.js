const gridForm = document.getElementById("grid-form");
const selectedSeatInput = document.getElementById("selected-seat");
const selectedTimeInput = document.getElementById("selected-time");
const gridContainer = document.querySelector(".grid-container");
const paymentButton = document.querySelector(".payment-button");
const timeTable = document.querySelector(".time-schedule-container");
const displaySeat = document.getElementById("display-seat");
const displayTime = document.getElementById("display-time");

// Function to handle seat click event
function handleSeatClick(event) {
  const target = event.target;
  if (target.classList.contains("grid-item")) {
    const boxId = target.id;
    selectedSeatInput.value = boxId;
    // Change the background color of the clicked box
    if (target.style.backgroundColor == "lightgray") {
      target.style.backgroundColor = "lightblue";
    } else {
      target.style.backgroundColor = "lightgray";
    }
    // update display seat
    displaySeat.textContent = "Seat: " + boxId;
    console.log(selectedSeatInput.value);
  }
}

// Function to handle time click event
function handleTimeClick(event) {
  const target = event.target;
  const timeId = target.id;
  if (target.style.backgroundColor == "lightgray") {
    target.style.backgroundColor = "lightgreen";
  } else {
    target.style.backgroundColor = "lightgray";
  }
  selectedTimeInput.value = timeId;
  // update display time
  displayTime.textContent = "Time: " + timeId;
  console.log(selectedTimeInput.value);
}

gridContainer.addEventListener("click", handleSeatClick);
timeTable.addEventListener("click", handleTimeClick);

for (let row = 1; row <= 8; row++) {
  for (let col = 1; col <= 8; col++) {
    const uniqueId = `${String.fromCharCode(64 + row)}-${col}`;
    const gridItem = document.createElement("div");
    gridItem.className = "grid-item";
    gridItem.id = uniqueId;
    gridItem.style = "background-color: lightgray";
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
