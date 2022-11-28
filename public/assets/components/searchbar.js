const carList = document.getElementById('cars-table');
const searchBar = document.getElementById('search');
let hpCars = [];

searchBar.addEventListener('keyup', (e) => {
    const searchString = e.target.value.toLowerCase();

    const filteredCars = hpCars.filter((car) => {
        return (
            car.name.toLowerCase().includes(searchString)
        );
    });
    displayCars(filteredCars);
});


const loadCars = async () => {
    try {
        const res = await fetch('/list');
        hpCars = await res.json();
        displayCars(hpCars);
    } catch (err) {
        console.error(err);
    }
};

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
