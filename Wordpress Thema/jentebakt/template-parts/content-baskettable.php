<div>
    <table class="basket-table">
        <thead>
            <tr>
                <th></th>
                <th>Product</th>
                <th>Aantal</th>
                <th>Prijs</th>
            </tr>
        </thead>
        <tbody id="product-table">
            <tr>
                <td>
                    <span class="material-symbols-rounded">
                        close
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
    <form class="bestellen-button" onsubmit="send_mail()" id="bestel-form">
        <label>Naam:</label>
        <input type="text" id="name" name="name" required="true">
        <label for="date">Datum:</label>
        <input type="date" id="date" name="date" required="true">
        <button type="submit">
            <span>Bestellen</span>
        </button>
    </form>
    <script>
        g_basket = []

        function get_basket() {
            let basket = document.cookie.split(";").filter(item => item.trim().startsWith('basket='))
            console.log(basket)
            basket = basket.length ? JSON.parse(basket[0].split('=')[1]) : []
            g_basket = basket
            load_basket()
        }

        function load_basket() {

            let table = document.getElementById("product-table")
            table.innerHTML = ""
            g_basket.forEach(item => {
                let row = document.createElement("tr")
                let name = document.createElement("td")
                name.innerHTML = item.name
                let amount = document.createElement("td")
                amount.innerHTML = item.amount
                let price = document.createElement("td")
                price.innerHTML = "€ " + item.price?.toFixed(2)

                let remove = document.createElement("td")
                remove.classList.add("icon")
                remove.onclick = () => {
                    g_basket = g_basket.filter(basket_item => basket_item.name != item.name)
                    document.cookie = "basket=" + JSON.stringify(g_basket) + ";path=/"
                    get_basket()
                }
                remove.innerHTML = '<span class="material-symbols-rounded">close</span>'

                row.appendChild(remove)
                row.appendChild(name)
                row.appendChild(amount)
                row.appendChild(price)

                table.appendChild(row)

            })

            if (g_basket.length == 0) {
                let row = document.createElement("tr")
                let name = document.createElement("td")
                name.innerHTML = "Geen producten in winkelmandje"
                name.setAttribute("colspan", "3")
                name.setAttribute("style", "text-align: center;")
                row.appendChild(name)
                table.appendChild(row)
            } else {
                row = document.createElement("tr")
                let total = document.createElement("td")
                total.innerHTML = "Totaal"
                total.setAttribute("colspan", "3")
                total.setAttribute("style", "text-align: right;")
                let total_price = document.createElement("td")
                total_price
                total_price.innerHTML = "€ " + g_basket.reduce((total, item) => total + item.price, 0).toFixed(2)
                row.appendChild(total)
                row.appendChild(total_price)
                table.appendChild(row)
            }
        }

        function send_mail() {
            const form = document.getElementById("bestel-form");
            const formData = new FormData(form);
            const date = formData.get("date");
            const name = formData.get("name");


            email = "<?php dynamic_sidebar("email"); ?>";
            let mail = "mailto:" + email;
            mail += "?subject=Bestelling voor " + new Date(date).toLocaleDateString("nl-NL") + " van " + name;
            mail += "&body=";

            let body = "Bestelling voor " + new Date(date).toLocaleDateString("nl-NL") + " van " + name + "%0D%0A%0D%0A";
            g_basket.forEach(item => {
                body += item.name + " - " + item.amount + "x - " + item.price + "%0D%0A";
            })

            mail += body;
            mail += "%0D%0ADeze mail is automatisch gegenereerd."

            window.location.href = mail;
        }

        window.onload = get_basket();

        function handleForm(event) {
            event.preventDefault();
        }
        var form = document.getElementById('bestel-form');
        form.addEventListener('submit', handleForm);
    </script>
</div>