document.addEventListener("DOMContentLoaded", function() {
    const ubahButton = document.getElementById("ubahButton");
    const ubahPopup = document.getElementById("ubahPopup");
    const ubahOverlay = document.getElementById("ubah-popup-overlay");
    const closeUbahPopup = document.getElementById("closeUbahPopup");

    ubahButton.addEventListener("click", function() {
        ubahPopup.style.display = "block";
        ubahOverlay.style.display = "block";
    });

    closeUbahPopup.addEventListener("click", function() {
        ubahPopup.style.display = "none";
        ubahOverlay.style.display = "none";
    });

    ubahOverlay.addEventListener("click", function() {
        ubahPopup.style.display = "none";
        ubahOverlay.style.display = "none";
    });
});

function ubahsaiz(gandaan) {
    var table = document.querySelector("#saiz");
    var elements = table.querySelectorAll("*");

    // Include the table element itself in the list
    elements = Array.from(elements);
    elements.push(table);

    elements.forEach(function (element) {
        var currentSize = parseFloat(window.getComputedStyle(element).fontSize);

        // Check if the reset button is clicked
        if (gandaan == 2) {
            element.style.fontSize = "16px"; // Reset to original size in pixels
        } else {
            // Adjust the font size based on the button clicked
            element.style.fontSize = (currentSize + (gandaan)) + "px"; // Update the font size in pixels
        }
    });
}
