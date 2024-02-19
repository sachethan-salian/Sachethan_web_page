document.addEventListener('DOMContentLoaded', (event) => {
    const toggleThemeBtn = document.getElementById('toggle-theme');
    const themeStyle = document.getElementById('theme-style');

    function updateButtonText() {
        const isDarkMode = document.body.classList.contains('dark-mode');
        toggleThemeBtn.querySelector('span').textContent = isDarkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode';
        themeStyle.setAttribute('href', isDarkMode ? 'css/dark-mode.css' : 'css/style.css');
    }

    toggleThemeBtn.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        updateButtonText();
    });

    // Initial update in case the dark mode is the default or based on user preference
    updateButtonText();
});
