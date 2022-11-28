const suvList = document.getElementById('cars-table');
const suvBtn = document.getElementById('SUV');
const fullElectricBtn = document.getElementById('Full_Electric');
const sportbackBtn = document.getElementById('Sportback');
const allBtn = document.getElementById('All');
let hpSuvCar = [];

//Data recovery
const loadCarsbySuvCategory = async () => {
  try {
      const res = await fetch('index.php/list');
      hpSuvCar = await res.json();
      displayCarsbySuvCategory(hpSuvCar);
  } catch (err) {
      console.error(err);
  }
};

// Setting up a listening event
suvBtn.addEventListener('click', suvFilter)
fullElectricBtn.addEventListener('click', fullElectricFilter)
sportbackBtn.addEventListener('click', sportbackFilter)
allBtn.addEventListener('click', allFilter)

// Setting up filters by button
function suvFilter (){
    const filteredCarsbyCategory = hpSuvCar.filter((car) => {
      if (car.category.name === "SUV") { 
        return car.name
      }
    });
    displayCarsbySuvCategory(filteredCarsbyCategory);
};

function fullElectricFilter (){
  const filteredCarsbyCategory = hpSuvCar.filter((car) => {
    if (car.category.name === "Full Electric") { 
      return car.name
    }
  });
  displayCarsbySuvCategory(filteredCarsbyCategory);
};

function sportbackFilter (){
  const filteredCarsbyCategory = hpSuvCar.filter((car) => {
    if (car.category.name === "Sportback") { 
      return car.name
    }
  });
  displayCarsbySuvCategory(filteredCarsbyCategory);
};

function allFilter (){
  const filteredCarsbyCategory = hpSuvCar.filter((car) => {
      return car.name
  });
  displayCarsbySuvCategory(filteredCarsbyCategory);
};

// Dissemination of modified data in the DOM
const displayCarsbySuvCategory = (cars) => {
    const htmlString = cars
        .map((car) => {
            return `
            <tr>
                <th>${car.name}</th>
                <th>${car.nbreSeats}</th>
                <th>${car.nbreDoors}</th>
                <th>${car.cost}€</th>
                <th>${car.category.name}</th>
            <tr>
        `;
        })
        .join('');
    suvList.innerHTML = htmlString;
};

loadCarsbySuvCategory();
