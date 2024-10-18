document.addEventListener('DOMContentLoaded', () => {
  // Fetch initial data (first 20 cards)
  fetchCards();

  // Handle the search form submission
  document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission

    // Get the search term from the input field
    const searchTerm = document.getElementById('searchInput').value;

    // Fetch data based on the search term
    fetchCards(searchTerm);
  });
});

// Function to fetch and display cards
function fetchCards(search = '') {
  // Fetch card data from the server, passing the search term if present
  fetch(`fetch_cards.php?search=${encodeURIComponent(search)}`)
    .then(response => response.json())
    .then(cards => {
      const cardContainer = document.getElementById('cardContainer');
      cardContainer.innerHTML = ''; // Clear the container

      if (cards.length === 0) {
        cardContainer.innerHTML = '<p>No results found</p>'; // Show message if no results
        return;
      }

      // Loop through the fetched card data and create HTML
      cards.forEach(card => {
        const cardElement = `
          <div class="col-md-3">
            <div class="card">
              <img src="${card.image_url}" class="card-img-top" alt="${card.title}" />
              <div class="card-body">
                <h5 class="card-title">${card.title}</h5>
                <p class="card-text">${card.description}</p>
                <a href="open.php?link=${card.link}" class="btn btn-primary">Stream Now</a>
              </div>
            </div>
          </div>
        `;
        cardContainer.innerHTML += cardElement;
      });
    })
    .catch(error => console.error('Error fetching card data:', error));
}


