<?php
    get_header();
?>

<main>
    <div>
    <?php

    get_search_form();
    
    if (have_posts()){
        while (have_posts())
        {
            the_post();
            
            get_template_part('template-parts/content', 'archive');
        }
    }
    else{
        echo "Geen producten gevonden";
    }
    ?>
    <?php
    
    the_posts_pagination(
        array(
            'prev_text' => 'Vorige',
            'next_text' => 'Volgende',
            'screen_reader_text' => ' '
        )
    );
    ?>

    </div>
</main>

<?php
    get_footer();
?>