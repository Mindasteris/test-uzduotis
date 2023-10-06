function filterProducts()
{
    const kategorijos_filtras = document.getElementById("kategorijos_filtras").value;
    const modelio_filtras = document.getElementById("modelio_filtras").value;
    const gamintojo_filtras = document.getElementById("gamintojo_filtras").value;
    const sandelyje_filtras = document.getElementById("sandelyje_filtras").value;
    const tableRows = document.querySelectorAll(".product-table tbody tr");

    // console.log("Pasirinkti filtrai:");
    // console.log("Kategorija: " + kategorijos_filtras);
    // console.log("Modelis: " + modelio_filtras);
    // console.log("Gamintojas: " + gamintojo_filtras);
    // console.log("Sandėlyje: " + sandelyje_filtras);
    
    tableRows.forEach((row) => {
        const category = row.querySelector(".category-column").textContent;
        const model = row.querySelector(".model-column").textContent;
        const manufacturer = row.querySelector(".manufacturer-column").textContent;
        const stock = row.querySelector(".stock-column").textContent;

        const kategorija = (kategorijos_filtras === "" || category === kategorijos_filtras);
        const modelis = (modelio_filtras === "" || model === modelio_filtras);
        const gamintojas = (gamintojo_filtras === "" || manufacturer === gamintojo_filtras);
        const sandelyje = (sandelyje_filtras === "" || stock === sandelyje_filtras);

        if (kategorija && modelis && gamintojas && sandelyje) {
            row.style.display = "table-row";
        } else {
            row.style.display = "none";
        }
    });
}

function resetFilters() 
{
    document.getElementById("kategorijos_filtras").value = "";
    document.getElementById("modelio_filtras").value = "";
    document.getElementById("gamintojo_filtras").value = "";
    document.getElementById("sandelyje_filtras").value = "";

    // Call the filter function to show all products
    filterProducts();
}