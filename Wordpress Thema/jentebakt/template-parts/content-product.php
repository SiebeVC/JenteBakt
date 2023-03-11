<?php

$meta = get_post_meta(get_the_ID(), 'price');
if (count($meta) == 0) {
    $price = 'n.a.';
} else {
    $pricearr = $meta[0];
}

$meta = get_post_meta(get_the_ID(), 'min');
if (count($meta) == 0) {
    $min = "1";
} else {
    $min = $meta[0];
}

$meta = get_post_meta(get_the_ID(), 'step');
if (count($meta) == 0) {
    $step = "1";
} else {
    $step = $meta[0];
}
?>

<div class="single">
    <?php if (has_post_thumbnail()) : ?>
        <div class="single-image rounded">
            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" />
            <span class="tags"><?php the_tags(); ?></span>
            <div class="single-add">
                <form method="get" id="add_to_bask">
                    <span id="price"><?php echo "€ 2" ?></span>
                    <input id="aantal" name="aantal" type="number" min="<?php echo $min ?>" value="<?php echo $min ?>" step="<?php echo $step ?>">
                    <button type="submit" name="add_to_basket" , class="form-control">
                        <span class="material-symbols-rounded">
                            add_shopping_cart
                        </span>
                    </button>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <div class="single-text">
        <h2><?php the_title(); ?></h2>
        <div class="description">
            <p>
                <?php the_content(); ?>
            </p>
        </div>
        <?php if (!has_post_thumbnail()) : ?>
            <span class="tags" style="text-align: left;"><?php the_tags(); ?></span>
        <?php endif; ?>
    </div>
    <script>
        g_price = 0;

        function add_to_basket() {
            let basket = document.cookie.split(";").filter(item => item.trim().startsWith('basket='))
            basket = basket.length ? JSON.parse(basket[0].split('=')[1]) : []

            const form = document.forms.add_to_bask
            const formData = new FormData(form)

            amount = parseInt(formData.get("aantal"))
            name = "<?php the_title(); ?>"
            price = g_price
            const obj = {name, amount, price}

            let item = basket.find(item => item.name === name)

            if (item) {
                item.amount = parseInt(item.amount) + parseInt(amount)
                item.price = parseInt(item.price) + parseInt(g_price)
                basket = basket.filter(item => item.name !== name)
                basket.push(item)
            } else {
                basket.push(obj)
            }

            document.cookie = "basket=" + JSON.stringify(basket) + ";path=/"
        }

        document.getElementById("add_to_bask").addEventListener("submit", add_to_basket);
        function handleForm(event) { event.preventDefault(); }
        document.getElementById("add_to_bask").addEventListener("submit", handleForm);

        function calculate_price(amount){
            const priceEL = document.getElementById("price");
            let pricearr = <?php echo json_encode($pricearr); ?>;

            if (pricearr == "n.a."){
                priceEL.innerHTML = "n.a."
                g_price = 0
                return
            }

            /* Price is single number */
            if (pricearr.split("|").length == 1){
                price = parseInt(pricearr) * amount
                priceEL.innerHTML = "€ " + price.toFixed(2)
                g_price = price
                return
            }

            /* Price is key value array: a1:p1|a2:p2|a3:p3 */
            
            let arr = []
            for (let p of pricearr.split("|")){
                const obj = {amount: p.split(":")[0], price: p.split(":")[1]}
                arr.push(obj)
            }
            
            price = 0
            while (amount > 0){
                item = arr.find(item => item.amount == amount)

                price += item ? parseInt(item.price) : parseInt(arr[arr.length - 1].price)
                amount -= item ? item.amount : arr[arr.length - 1].amount
            }
            console.log(price)
            if (!isNaN(price)){
                priceEL.innerHTML = "€ " + price.toFixed(2)
            }
            else{
                priceEL.innerHTML = "n.a."
            }

            g_price = price
        }

        document.onload = calculate_price(<?php echo $min ?>);
        const amountEL = document.getElementById("aantal");
        amountEL.addEventListener("change", () => calculate_price(amountEL.value));

    </script>
</div>
