function toggleDropdown(id) {
    console.log(id);
    const theDrop = document.querySelector(".drop-div-" + id);
    const theIcon = document.querySelector(".drop-icon-" + id);

    if (theDrop) {
        theDrop.classList.toggle("hidden");
    }

    if (theIcon) {
        theIcon.classList.toggle("fa-chevron-down");
        theIcon.classList.toggle("fa-chevron-up");
    }
}
