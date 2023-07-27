
let beneficiaryCount = 1;

function addBeneficiary() {
    const inpContainer = document.getElementById("inpContainer");
    const benCount = document.getElementById("benCount");
    const benDiv = document.getElementById(`benecifiary[${beneficiaryCount}]`);

    const beneficiaryDiv = document.createElement("div");
    beneficiaryDiv.innerHTML = `<div id="benecifiary[${beneficiaryCount + 1}]">
        <label for="name${beneficiaryCount}">Nome:</label>
        <input class="input" type="text" name="beneficiaries[${beneficiaryCount}][name]" id="name${beneficiaryCount}" required>
        <label for="age${beneficiaryCount}">Idade:</label>
        <input class="input" type="number" name="beneficiaries[${beneficiaryCount}][age]" id="age${beneficiaryCount}" required></div>
    `;

    inpContainer.appendChild(beneficiaryDiv);
    benDiv.style.display = "none";

    benCount.innerHTML = `${beneficiaryCount} Beneficiários adicionados`;

    beneficiaryCount++;
}

document.getElementById("planForm").addEventListener("submit", function (event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    fetch("https://project.fernandolucas8.repl.co", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {

        const resultContainer = document.getElementById("resultContainer");
        const totalValue = document.getElementById("total_value");

        if (data.error) {
            const errorMessage = document.createElement("p");
            errorMessage.textContent = data.error;
            resultContainer.appendChild(errorMessage);
        } else {

            const individualPrices = data.individual_prices;
            const totalPrice = data.total_price;

            individualPrices.forEach(individual => {
                resultContainer.innerHTML += `
                <div class='card'>
                    <h4>Nome: </h4> ${individual.name} <br><br>
                    <h4>Idade: </h4> ${atob(individual.age)} <br><br>
                    <h4>Preço Individual: </h4> R$${individual.price},00 <br><br>
                </div>
                `
            });
            totalValue.innerHTML = `Valor total: <span style="color: green">R$${totalPrice},00</span>`;
        }
    })
    .catch(error => {
        console.error("Ocorreu um erro ao calcular os preços:", error);
    });
});