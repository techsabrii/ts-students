// search-box open close js code
let navbar = document.querySelector(".navbar");
let searchBox = document.querySelector(".search-box .bx-search");
// let searchBoxCancel = document.querySelector(".search-box .bx-x");





// sidebar submenu open close js code





// scripts.js

document.addEventListener('DOMContentLoaded', function () {
    // Check if the welcome popup should be displayed
    const popup = document.getElementById('welcome-popup');
    if (popup) {
        // Show the popup
        popup.classList.add('show');

        // Add event listener to close button
        const closeButton = document.getElementById('close-popup');
        closeButton.addEventListener('click', function () {
            popup.classList.remove('show');
        });

        // Optional: Close the popup if clicked outside
        window.addEventListener('click', function (event) {
            if (event.target === popup) {
                popup.classList.remove('show');
            }
        });
    }
});




// scripts.js
// index page welcome for updates
document.addEventListener('DOMContentLoaded', function () {
    // Check if the popup has already been shown in this session
    if (!sessionStorage.getItem('popupShown')) {
        // Set a timeout to show the popup after 1 minute
        setTimeout(function () {
            const delayedPopup = document.getElementById('delayed-popup');
            if (delayedPopup) {
                delayedPopup.classList.add('show');

                // Mark the popup as shown in session storage
                sessionStorage.setItem('popupShown', 'true');

                // Add event listener to close button
                const closeButton = document.getElementById('close-delayed-popup');
                closeButton.addEventListener('click', function () {
                    delayedPopup.classList.remove('show');
                });

                // Optional: Close the popup if clicked outside
                window.addEventListener('click', function (event) {
                    if (event.target === delayedPopup) {
                        delayedPopup.classList.remove('show');
                    }
                });
            }
        }, 60000); // 60000 milliseconds = 1 minute
    }
});



// for shop welcome

document.addEventListener('DOMContentLoaded', function () {
    // Function to show the popup
    function showPopup(popupId) {
        const popup = document.getElementById(popupId);
        if (popup) {
            popup.classList.add('show');

            // Add event listener to close button
            const closeButton = popup.querySelector('.close');
            closeButton.addEventListener('click', function () {
                popup.classList.remove('show');
            });

            // Optional: Close the popup if clicked outside
            window.addEventListener('click', function (event) {
                if (event.target === popup) {
                    popup.classList.remove('show');
                }
            });
        }
    }

    // Check if the "Explore Shops" popup has already been shown in this session
    if (!sessionStorage.getItem('exploreShopsPopupShown')) {
        // Set a timeout to show the popup after 1 minute
        setTimeout(function () {
            showPopup('explore-shops-popup');
            // Mark the popup as shown for this page load
            sessionStorage.setItem('exploreShopsPopupShown', 'true');
        }, 60000); // 60000 milliseconds = 1 minute
    }

    // Clear the session storage on page unload to allow showing the popup on next page load
    window.addEventListener('beforeunload', function () {
        sessionStorage.removeItem('exploreShopsPopupShown');
    });
});





// weather page welcome popup



document.addEventListener('DOMContentLoaded', function () {
    // Function to show the popup
    function showPopup() {
        const popup = document.getElementById('welcome-popup');
        const countdownElement = document.getElementById('countdown');
        const closeButton = document.getElementById('close-welcome-popup');

        if (popup && countdownElement) {
            popup.classList.add('show');

            // Countdown timer logic
            let duration = 5; // Countdown duration in seconds
            const endTime = Date.now() + duration * 1000;

            function updateCountdown() {
                const remainingTime = Math.max(0, Math.floor((endTime - Date.now()) / 1000));
                countdownElement.textContent = String(remainingTime).padStart(2, '0');

                if (remainingTime <= 0) {
                    popup.classList.remove('show');
                    clearInterval(countdownInterval);
                }
            }

            // Update the countdown every second
            const countdownInterval = setInterval(updateCountdown, 1000);

            // Initial countdown update
            updateCountdown();

            // Add event listener to close button
            closeButton.addEventListener('click', function () {
                popup.classList.remove('show');
                clearInterval(countdownInterval);
            });

            // Optional: Close the popup if clicked outside
            window.addEventListener('click', function (event) {
                if (event.target === popup) {
                    popup.classList.remove('show');
                    clearInterval(countdownInterval);
                }
            });
        }
    }

    // Set a timeout to show the popup after 5 seconds
    setTimeout(function () {
        showPopup();
    }, 5000); // 5000 milliseconds = 5 seconds
});




// add things , articals,shops,tourist-points


document.addEventListener('DOMContentLoaded', function () {
    const showPopupButton = document.getElementById('show-popup');
    const popup = document.getElementById('options-popup');
    const closeButton = document.getElementById('close-options-popup');

    // Function to toggle the popup
    function togglePopup() {
        popup.classList.toggle('show');
    }

    // Show the popup when the floating action button is clicked
    showPopupButton.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default link behavior
        togglePopup();
    });

    // Close the popup when the close button is clicked
    closeButton.addEventListener('click', function () {
        togglePopup();
    });

    // Optional: Close the popup if clicked outside
    window.addEventListener('click', function (event) {
        if (event.target === popup) {
            togglePopup();
        }
    });
});


// notification script success

document.addEventListener('DOMContentLoaded', function() {
    // Get all floating alerts
    const alerts = document.querySelectorAll('.floating-alert');

    alerts.forEach(alert => {
        // Auto hide after 5 seconds
        setTimeout(() => {
            alert.style.display = 'none';
        }, 5000); // Alert disappears after 5 seconds

        // Allow user to close alert manually
        alert.addEventListener('click', function() {
            alert.style.display = 'none';
        });
    });
});
