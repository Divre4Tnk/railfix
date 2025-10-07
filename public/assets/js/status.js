const form = document.getElementById("searchForm");
const spinner = document.getElementById("loadingSpinner");
const btn = document.getElementById("searchBtn");
const resultBox = document.getElementById("resultBox");

form.addEventListener("submit", function (e) {
    e.preventDefault();

    // sembunyikan hasil lama (apapun isinya)
    if (resultBox) resultBox.style.display = "none";

    // tampilkan spinner
    spinner.classList.remove("d-none");
    btn.disabled = true;

    // kasih delay sebelum submit
    setTimeout(() => {
        form.submit();
    }, 1500);
});