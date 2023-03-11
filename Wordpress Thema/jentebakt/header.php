<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    wp_head();
    ?>
</head>

<?php

if (function_exists('the_custom_logo')) {
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id);
}

?>

<body>
    <nav>
        <div class="nav-left pc">


            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo $logo[0] ?>" class="nav-logo" alt="logo">
            </a>


            <?php
            wp_nav_menu(
                array(
                    'menu' => 'primary',
                    'container' => 'ul',
                    'theme_location' => 'primary'
                )
            );

            ?>
        </div>
        <div class="nav-right pc">
            <?php
            wp_nav_menu(
                array(
                    'menu' => 'secondary',
                    'container' => 'ul',
                    'theme_location' => 'secondary',
                )
            );

            ?>

        </div>

        <div class="nav-mobile-container mobile">
            <div class="nav-mobile">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo $logo[0] ?>" class="nav-logo" alt="Jente Bakt Logo">
                </a>
                <?php
                wp_nav_menu(
                    array(
                        'menu' => 'primary',
                        'container' => 'ul',
                        'theme_location' => 'primary'
                    )
                );

                wp_nav_menu(
                    array(
                        'menu' => 'secondary',
                        'container' => 'ul',
                        'theme_location' => 'secondary',
                    )
                );

                ?>
            </div>
        </div>
    </nav>