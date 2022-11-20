const url = 'http://localhost:8000/display'
const content = document.querySelector('#cars-table')
const filterBtns = document.querySelectorAll('.btn')

const fetchData = async () => {
  try {
    const response = await fetch(url)
    const data = await response.json();
    

    let data_results = [];
    
    if (response.status === 200) {
    filterBtns.forEach((btn) => {
        btn.addEventListener('click', (e) => {
        let id = e.target.dataset.id.toUpperCase()
        data_results = data.filter((car) => {
            let res = car
            
            
            if (res.name.includes(id)) {
            return res
            }
          })
          
         
          output = filterResults(data_results);
          content.innerHTML = output;
        })
      })
    }
  } catch (error) {
    console.log(error)
  }
}

fetchData()

{
  /* <h3>${result.videos[0].embed}</h3> */
}

// Take results, map them to our cards and return them.
function filterResults(data_results) {
  let output = data_results.map((result) => {
        return `<article class="card">
        <div class="info">
        <h2><i class="fas fa-spinner fa-pulse"></i> Match: ${car.category.name}</h2>
        <div class="details">
        <p>${car.name}</p>
        <p>${car.nbreSeats}</p>
        <p>${car.nbreDoors}</p>
        <p>${car.cost}</p>
        <p>${car.category.name}</p>
        </div>
        </div>
        </article>
        `
      });
  output = output.join(' ')
  return output;
}
