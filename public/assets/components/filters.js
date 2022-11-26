const carTable = document.getElementById('cars-table');
const suvButton = document.querySelector("#SUV")
let hpCarsbySuvCategory = [];

function suvfunction(){
  const loadCarsbyCategories = async () => {
    try {
        const res = await fetch('http://localhost:8000/list');
        hpCars = await res.json();
        displayCarsbyCategories(hpCarsbySuvCategory);
    } catch (err) {
        console.error(err);
    }
  };
}
suvButton.addEventListener('click', suvfunction,false);
  // const suvButtonString = e.target.value.toLowerCase();
  // const filteredCarsbySuvCategory = hpCarsbySuvCategory.filter((car) => {
  //     return (
  //         car.name.toLowerCase().includes(suvButtonString)
  //     ); 
  //   });
  //     displayCarsbyCategories(filteredCarsbySuvCategory);  
});



const displayCarsbyCategories = (cars) => {
  const htmlString = cars
      .map((car) => {
          return `
          <tr>
              <th>${car.name}</th>
              <th>${car.nbreSeats}</th>
              <th>${car.nbreDoors}</th>
              <th>${car.cost}</th>
              <th>${car.category.name}</th>
          <tr>
      `;
      })
      .join('');
  carTable.innerHTML = htmlString;
};

suvfunction();
