const searchInput = document.getElementById("searchInput");
const cards = document.querySelectorAll(".card");

searchInput.addEventListener("input", function () {
  const filter = searchInput.value.toLowerCase();

  cards.forEach((card) => {
    const title = card.querySelector(".card-title").textContent.toLowerCase();

    if (title.includes(filter)) {
      card.parentElement.style.display = "";
    } else {
      card.parentElement.style.display = "none";
    }
  });
});
