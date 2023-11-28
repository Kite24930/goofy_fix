const header_logo = document.getElementById("price_img");
const updateImg = document.getElementById("updateImg");

header_logo.addEventListener("change", () => {
    const file = header_logo.files[0];
    if (file) {
        const reader = new FileReader();
        reader.addEventListener("load", () => {
            updateImg.setAttribute("src", reader.result);
        });
        reader.readAsDataURL(file);
    }
});
