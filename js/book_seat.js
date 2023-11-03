const seats = document.querySelectorAll(".row .seat");
const seatContainer = document.querySelector(".row-container");
const count = document.getElementById("count");
const total = document.getElementById("total");
const timeSelect = document.getElementById("selected-time");
const gridForm = document.getElementById("grid-form");
const paymentButton = document.querySelector(".payment-button");
const seatForm = document.getElementById("seat-form");
const timeForm = document.getElementById("time-form");
const totalPrice = document.getElementById("total-price");
const seatMapping = {
  0: "A1",
  1: "A2",
  2: "A3",
  3: "A4",
  4: "A5",
  5: "A6",
  6: "A7",
  7: "A8",
  8: "B1",
  9: "B2",
  10: "B3",
  11: "B4",
  12: "B5",
  13: "B6",
  14: "B7",
  15: "B8",
  16: "C1",
  17: "C2",
  18: "C3",
  19: "C4",
  20: "C5",
  21: "C6",
  22: "C7",
  23: "C8",
  24: "D1",
  25: "D2",
  26: "D3",
  27: "D4",
  28: "D5",
  29: "D6",
  30: "D7",
  31: "D8",
  32: "E1",
  33: "E2",
  34: "E3",
  35: "E4",
  36: "E5",
  37: "E6",
  38: "E7",
  39: "E8",
  40: "F1",
  41: "F2",
  42: "F3",
  43: "F4",
  44: "F5",
  45: "F6",
  46: "F7",
  47: "F8",
  48: "G1",
  49: "G2",
  50: "G3",
  51: "G4",
  52: "G5",
  53: "G6",
  54: "G7",
  55: "G8",
  56: "H1",
  57: "H2",
  58: "H3",
  59: "H4",
  60: "H5",
  61: "H6",
  62: "H7",
  63: "H8",
};

let ticketPrice = "";
let movieTime = "";
let occupiedSeats = "";

if (timeSelect.value) {
  ticketPrice = +timeSelect.value.split("%")[0];
  movieTime = timeSelect.value.split("%")[1];
  occupiedSeats = timeSelect.value
    .split("%")[2]
    .split(",")
    .map((str) => str.trim())
    .filter((str) => str !== "");

  console.log(occupiedSeats);
}

populateUI();

// Save selected movie index and price
function setMovieData(movieIndex, moviePrice) {
  localStorage.setItem("selectedMovieIndex", movieIndex);
  localStorage.setItem("selectedMoviePrice", moviePrice);
}

function mapIndex(indices) {
  var seats = [];
  for (let i = 0; i < indices.length; i++) {
    seats.push(seatMapping[indices[i]]);
  }
  return seats.join(", ");
}

function updateSelectedCount() {
  const selectedSeats = document.querySelectorAll(".container .selected");
  seatsIndex = [...selectedSeats].map(function (seat) {
    return [...seats].indexOf(seat);
  });

  localStorage.setItem("selectedSeats", JSON.stringify(seatsIndex));

  let selectedSeatsCount = selectedSeats.length;
  count.textContent = mapIndex(seatsIndex);
  total.textContent = selectedSeatsCount * ticketPrice;
  //insert form
  totalPrice.value = selectedSeatsCount * ticketPrice;
  seatForm.value = mapIndex(seatsIndex);
  timeForm.value = movieTime;
}

// Get data from localstorage and populate
function populateUI() {
  const selectedSeats = JSON.parse(localStorage.getItem("selectedSeats"));
  seats.forEach(function (seat, index) {
    seat.classList.remove("occupied");
  });
  if (selectedSeats !== null && selectedSeats.length > 0) {
    seats.forEach(function (seat, index) {
      if (selectedSeats.indexOf(index) > -1) {
        seat.classList.add("selected");
      }
    });
  }
  if (occupiedSeats !== null && occupiedSeats.length > 0) {
    seats.forEach(function (seat, index) {
      if (occupiedSeats.indexOf(seatMapping[index]) > -1) {
        seat.classList.add("occupied");
      }
    });
  }

  const selectedMovieIndex = localStorage.getItem("selectedMovieIndex");

  if (selectedMovieIndex !== null) {
    timeSelect.selectedIndex = selectedMovieIndex;
  }
}

// Movie select event

timeSelect.addEventListener("change", function (e) {
  ticketPrice = +timeSelect.value.split("%")[0];
  movieTime = timeSelect.value.split("%")[1];
  occupiedSeats = timeSelect.value
    .split("%")[2]
    .split(",")
    .map((str) => str.trim())
    .filter((str) => str !== "");
  setMovieData(e.target.selectedIndex, e.target.value);
  populateUI();
  updateSelectedCount();
});

// Adding selected class to only non-occupied seats on 'click'

seatContainer.addEventListener("click", function (e) {
  if (
    e.target.classList.contains("seat") &&
    !e.target.classList.contains("occupied")
  ) {
    e.target.classList.toggle("selected");
    updateSelectedCount();
  }
});

paymentButton.addEventListener("click", function () {
  gridForm.submit(); // Submit the form when the button is clicked
  localStorage.removeItem("selectedSeats");
});

// Initial count and total rendering
updateSelectedCount();
