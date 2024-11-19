// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};

//Filtar
function sortTable(column, sort_asc) {
  [...table_rows].sort((a, b) => {
      let first_row = a.querySelectorAll('td')[column].textContent.toLowerCase(),
          second_row = b.querySelectorAll('td')[column].textContent.toLowerCase();

      return sort_asc ? (first_row < second_row ? 1 : -1) : (first_row < second_row ? -1 : 1);
  })
      .map(sorted_row => document.querySelector('table').appendChild(sorted_row));
}