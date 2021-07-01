const API_KEY = 'api_key=7432355f4f5f5ce12ec85408a877ac57&';
const API_URL = 'https://api.themoviedb.org/3';
const imgbase = 'https://image.tmdb.org/t/p/w500';
const searchURL = API_URL + '/search/movie?'+API_KEY;
const query = document.getElementById('query');
const main = document.getElementById('results');
const form = document.getElementById('form');
const search = document.getElementById('search');

function getMovies(url){
    fetch(url).then(res => res.json()).then(data =>
        {   console.log(data.results)
            showMovies(data.results);
        })}

function showMovies(data){
    main.innerHTML= '';
    data.forEach(movie => {
        const {title, poster_path, vote_average, id, release_date} = movie;
        const movieE1  = document.createElement('div');
        movieE1.classList.add('search-card');
        movieE1.innerHTML = `        
        <a href="movie.php?q1=${id}">
                    <div class="movie-img">



                        <img src="${imgbase + poster_path}" alt="${title}"  onerror="this.onerror=null;this.src='img/default_poster.jpg';">
                        <div class="card-rate">

                            <div class="card-ratings  ">
                                <img src="img/IMDB.svg" alt="IMDB">
                                <span>
                                    <b>${vote_average}</b>/10</span>

                            </div>


                        </div>
                        <button role="button" href="#" class="card-button card-watched">
                            <i class="fa fa-check" aria-hidden="true"></i><span> Seen it</span>
                        </button>
                        <button role="button" href="#" class="card-button card-add"><i class="fa fa-plus"
                                aria-hidden="true"></i><span> Add to
                                List</span>
                        </button>


                    </div>
                    <span class="card-name">
                    ${title} (${release_date.slice(0,4)})
                    </span>
                </a>      
        
        
        `        
        
        main.appendChild(movieE1);
    });
}        

form.addEventListener('submit', (e) =>{
e.preventDefault();
const searchTerm = search.value;
if(searchTerm){
    query.innerHTML = `Movies Found for: &nbsp  '${searchTerm}'`
    getMovies(searchURL+'&query='+searchTerm);
}

})