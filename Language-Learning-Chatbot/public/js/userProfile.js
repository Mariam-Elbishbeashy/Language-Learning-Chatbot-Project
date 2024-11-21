// function handleCancel() {
//     if (confirm("Are you sure you want to cancel? All changes will be discarded.")) {
//         window.location.href = "userProfile.php";
//     }
// }
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
function handleCancel() {
    event.preventDefault(); 

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-primary swal-confirm-btn", 
            cancelButton: "btn btn-secondary swal-cancel-btn mr-2"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, cancel it!",
        cancelButtonText: "No, close!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire({
                title: "Canceled!",
                text: "Your changes have been discarded.",
                icon: "success"
            }).then(() => {
                window.location.href = "userProfile.php";
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Closed",
                text: "Your changes are safe :)",
                icon: "error"
            });
        }
    });
}