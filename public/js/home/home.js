document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll('.card');
    let currentCardIndex = 0;

    function showCard(index) {
        cards.forEach((card, i) => {
            if (i === index) {
                card.style.width = "600px";
                card.querySelector('.description').style.opacity = "1";
                card.querySelector('.description').style.transform = "translateY(0)";
            } else {
                card.style.width = "70px";
                card.querySelector('.description').style.opacity = "0";
                card.querySelector('.description').style.transform = "translateY(30px)";
            }
        });
    }

    function nextCard() {
        currentCardIndex = (currentCardIndex + 1) % cards.length;
        showCard(currentCardIndex);
    }

    setInterval(nextCard, 2000); // Change card every 5 seconds
});

document.addEventListener("DOMContentLoaded", function () {
    // JavaScript code if needed
});
