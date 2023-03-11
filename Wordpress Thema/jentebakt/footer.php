<?php
/*
Template Name: Widgetized Page
*/
?>

<footer>
    <div class="footer-top">
        <div class="footer-top-text">
            <div class="footer-left">
                <span class="footer-title"><?php dynamic_sidebar( 'footer-title-1' ); ?></span>
                <?php dynamic_sidebar('footer-text-1')?>
            </div>
            <div class="footer-right">
                <span class="footer-title"><?php dynamic_sidebar( 'footer-title-2' ); ?></span>
                <?php dynamic_sidebar('footer-text-2')?>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <span><?php dynamic_sidebar("lowest-footer-text") ?></span>
    </div>
</footer>
</body>
<?php
wp_footer();
?>

</html>