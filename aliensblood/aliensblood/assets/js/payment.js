document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("payment-form");
    const message = document.getElementById("payment-message");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const data = {
            name: document.getElementById("card-name").value,
            number: document.getElementById("card-number").value.replace(/\s+/g, ''),
            expiry: document.getElementById("expiry").value,
            cvv: document.getElementById("cvv").value
        };

        const res = await fetch("process_payment.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data)
        });

        const result = await res.json();
        message.textContent = result.message;
        message.style.color = result.success ? "green" : "red";

        if (result.success) {
            form.reset();
        }
    });
});
