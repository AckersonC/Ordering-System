document.addEventListener("DOMContentLoaded", function() {
    // Kategori Menu Popup
    const kategoriButton = document.getElementById("kategoriButton");
    const kategoriPopup = document.getElementById("kategoriPopup");
    const kategoriOverlay = document.getElementById("kategori-popup-overlay");
    const closeKategoriPopup = document.getElementById("closeKategoriPopup");

    kategoriButton.addEventListener("click", function() {
        kategoriPopup.style.display = "block";
        kategoriOverlay.style.display = "block";
    });

    closeKategoriPopup.addEventListener("click", function() {
        kategoriPopup.style.display = "none";
        kategoriOverlay.style.display = "none";
    });

    kategoriOverlay.addEventListener("click", function() {
        kategoriPopup.style.display = "none";
        kategoriOverlay.style.display = "none";
    });

    // Font Size Adjustment Popup
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
            element.style.fontSize = (currentSize + (gandaan * 2)) + "px"; // Update the font size in pixels
        }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    const searchButton = document.getElementById("searchButton");
    const popup = document.getElementById("popup");
    const overlay = document.getElementById("popup-overlay");
    const closePopup = document.getElementById("closePopup");

    searchButton.addEventListener("click", function() {
        popup.style.display = "block";
        overlay.style.display = "block";
    });

    closePopup.addEventListener("click", function() {
        popup.style.display = "none";
        overlay.style.display = "none";
    });

    overlay.addEventListener("click", function() {
        popup.style.display = "none";
        overlay.style.display = "none";
    });
});
