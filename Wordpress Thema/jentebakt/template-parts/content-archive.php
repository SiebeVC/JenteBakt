
<?php 
$meta = get_post_meta(get_the_ID(), 'price');

if (count($meta) == 0) {
    $pricearr = 'n.a.';
}
else{
    $pricearr = $meta[0];
}
?>

<a class="card-link" href="<?php the_permalink(); ?>">
    <div class="shop-card">
        <?php if(has_post_thumbnail()) : ?>
            <img src="<?php  the_post_thumbnail_url(); ?>" alt="cupcakes">
        <?php endif; ?>
        <div class="shop-card-text">
            <div class="shop-card-text-top">
                <span class="shop-card-title"><?php the_title(); ?></span>
                <span class="shop-card-price" id="price-<?php echo the_ID() ?>"></span>
            </div>
            <div class="shop-card-text-bottom">
                <?php the_excerpt(); ?>
            </div>
        </div>
    </div>
</a>

<script>
    function calculate_price(){
        priceEL = document.getElementById('price-<?php echo the_ID() ?>')

        let pricearr = <?php echo json_encode($pricearr); ?>;
        console.log(pricearr)

        if (pricearr == "n.a."){
            priceEL.innerHTML = pricearr
        }
        else if(pricearr.split('|').length == 1){
            console.log(pricearr)
            priceEL.innerHTML = "€ " + parseInt(pricearr).toFixed(2)
        }
        else{
            pricearr = pricearr.split('|')
            pricearr = pricearr.map(item => {return {amount: item.split(':')[0], price: item.split(':')[1]}})
            // order pricearr by amount
            pricearr.sort((a, b) => (a.amount - b.amount))
            console.log(pricearr)
            priceEL.innerHTML = "€ " + parseInt(pricearr[0].price).toFixed(2) + " / " + pricearr[0].amount + "p"
        }
    }

    calculate_price()
</script>