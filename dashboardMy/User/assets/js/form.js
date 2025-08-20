// Open Modal
document.getElementById('openModalBtn').onclick = function () {
    document.getElementById('bookingModal').style.display = 'block';
};

// Close Modal
document.querySelector('.close-btn').onclick = function () {
    document.getElementById('bookingModal').style.display = 'none';
};

// Close Modal on outside click
window.onclick = function (event) {
    if (event.target == document.getElementById('bookingModal')) {
        document.getElementById('bookingModal').style.display = 'none';
    }
};
