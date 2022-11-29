//retrieve HTML elements
const carList = document.getElementById('cars-table');
const searchBar = document.getElementById('search');
let hpCars = [];
// Setting up a listening event
searchBar.addEventListener('keyup', (e) => {
    const searchString = e.target.value.toLowerCase();

    const filteredCars = hpCars.filter((car) => {
        return (
            car.name.toLowerCase().includes(searchString)
        );
    });
    displayCars(filteredCars);
});

//Data recovery
const loadCars = async () => {
    try {
        const res = await fetch('index.php/list');
        hpCars = await res.json();
        displayCars(hpCars);
    } catch (err) {
        console.error(err);
    }
};
// Dissemination of modified data in the DOM
const displayCars = (cars) => {
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
    carList.innerHTML = htmlString;
};

loadCars();
