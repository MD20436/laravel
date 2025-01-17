// Funkcja do zmiany tła strony
function changeBackground(imagePath) {
    document.documentElement.style.setProperty('--background-image', `url(${imagePath})`);
    localStorage.setItem('background-image', imagePath); // Zapisz wybór w localStorage
}

// Funkcja do załadowania zapisanej konfiguracji tła
function loadSavedBackground() {
    const savedBackground = localStorage.getItem('background-image');
    if (savedBackground) {
        document.documentElement.style.setProperty('--background-image', `url(${savedBackground})`);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Załaduj zapisane tło przy ładowaniu strony
    loadSavedBackground();

    // Dodaj event listener do przycisków
    const defaultButton = document.getElementById('background-default');
    const alternateButton = document.getElementById('background-alternate');

    if (defaultButton) {
        defaultButton.addEventListener('click', function () {
            changeBackground('/images/tlo.png'); // Ścieżka do domyślnego tła
        });
    }

    if (alternateButton) {
        alternateButton.addEventListener('click', function () {
            changeBackground('/images/alternate-background.png'); // Ścieżka do alternatywnego tła
        });
    }
});
