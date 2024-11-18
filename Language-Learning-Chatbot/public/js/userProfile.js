function handleCancel() {
    if (confirm("Are you sure you want to cancel? All changes will be discarded.")) {
        window.location.href = "userProfile.php";
    }
}
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('profileImage');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
// Close the popup when the close button is clicked
document.addEventListener('DOMContentLoaded', function () {
    const closePopupBtn = document.getElementById('closePopup');
    const popupAlert = document.getElementById('popupAlert');

    if (closePopupBtn && popupAlert) {
        closePopupBtn.addEventListener('click', function () {
            popupAlert.style.display = 'none';
        });

        // Optional: Auto-close popup after 5 seconds
        setTimeout(() => {
            popupAlert.style.display = 'none';
        }, 5000);
    }
});
