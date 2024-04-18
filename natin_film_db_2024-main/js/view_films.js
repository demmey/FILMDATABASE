document.addEventListener('DOMContentLoaded', function() {
    // Get the search input and button elements
    const searchInput = document.getElementById("searchInput");
    const searchButton = document.getElementById("searchButton");
    const movieGrid = document.getElementById("movieGrid");
  
    // Add event listener to the search button
    searchButton.addEventListener("click", () => {
      const searchTerm = searchInput.value.trim();
      fetchMovies(searchTerm);
    });
  
    // Function to fetch movies based on search term
    function fetchMovies(searchTerm) {
      // Make an AJAX request to fetch movies from PHP script
      const xhr = new XMLHttpRequest();
      xhr.open('GET', `fetch_movies.php?searchTerm=${searchTerm}`, true);
      xhr.onload = function() {
        if (xhr.status === 200) {
          const movies = JSON.parse(xhr.responseText);
          displayMovies(movies);
        } else {
          console.error('Error fetching movies:', xhr.statusText);
        }
      };
      xhr.onerror = function() {
        console.error('Error fetching movies:', xhr.statusText);
      };
      xhr.send();
    }
  
    // Function to display movies on the page
    function displayMovies(movies) {
      movieGrid.innerHTML = ""; // Clear previous movies
      if (movies.length === 0) {
        movieGrid.innerHTML = "<p>No movies found.</p>";
      } else {
        movies.forEach(movie => {
          const movieCard = createMovieCard(movie);
          movieGrid.appendChild(movieCard);
        });
      }
    }
  
    // Function to create and append movie card
    function createMovieCard(movie) {
      // Create elements
      const movieCard = document.createElement("div");
      movieCard.classList.add("movie-card");
      const moviePoster = document.createElement("img");
      moviePoster.src = movie.poster;
      moviePoster.alt = movie.title + " Poster";
      const movieTitle = document.createElement("h3");
      movieTitle.textContent = movie.title;
      const movieDirector = document.createElement("p");
      movieDirector.textContent = "Director: " + movie.director;
      const movieGenre = document.createElement("p");
      movieGenre.textContent = "Genre: " + movie.genre;
  
      // Append elements to movie card
      movieCard.appendChild(moviePoster);
      movieCard.appendChild(movieTitle);
      movieCard.appendChild(movieDirector);
      movieCard.appendChild(movieGenre);
  
      return movieCard;
    }
  });