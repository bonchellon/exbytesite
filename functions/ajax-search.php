<?php

// ajax поиск по сайту 
add_action('wp_ajax_nopriv_ajax_search', 'ajax_search');
add_action('wp_ajax_ajax_search', 'ajax_search');

function ajax_search()
{
    $args = array(
        'post_type' => 'es_news',
        'post_status' => 'publish',
        'order' => 'DESC',
        'orderby' => 'date',
        's' => $_POST['term'],
        'posts_per_page' => 10
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <li class="ajax-search__item">
                <a href="<?php the_permalink(); ?>" class="ajax-search__link"><?php the_title(); ?></a>
            </li>
            <?php
        }
    } else {
        ?>
        <li class="ajax-search_not_found">Ничего не найдено</li>
        <?php
    }
    exit;
}
