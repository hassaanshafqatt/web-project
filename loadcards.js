document.addEventListener('DOMContentLoaded', () => {
  fetchCards();

  document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const searchTerm = document.getElementById('searchInput').value;

    fetchCards(searchTerm);
  });
});

function fetchCards(search = '') {
  fetch(`fetch_cards.php?search=${encodeURIComponent(search)}`)
    .then(response => response.json())
    .then(cards => {
      const cardContainer = document.getElementById('cardContainer');
      cardContainer.innerHTML = '';

      if (cards.length === 0) {
        cardContainer.innerHTML = '<p>No results found</p>';
        return;
      }

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
