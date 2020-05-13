<?php get_header(); ?>

<section class="content latest">
    <h2>Latests 20 posts</h2>
    <ul>
        <?php $the_query = new WP_Query('posts_per_page=20'); ?>

        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

            <!-- catch the ids for those 20 posts, in order to exclude them from the next loop -->
            <?php $excludeID[] = get_the_ID() ?>

            <li>
                <!-- post thumbnail linking to the single post page -->
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                <?php endif; ?>

                <!-- title -->
                <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>

                <!-- date -->
                <p class="date">Posted on: <?php the_time('j F Y'); ?></p>

                <!-- display the post excerpt -->
                <p><?php the_excerpt(__('(more…)')); ?></p>
            </li>

        <?php endwhile;
        wp_reset_postdata();
        ?>
    </ul>
</section>

<!-- <h1><?php print_r($excludeID); ?></h1> -->

<section class="content category__popular">
    <h2>Popular posts</h2>
    <ul>
        <?php
        $args = array(
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 6,
            'category_name' => 'popular',
            'paged' => get_query_var('paged'),
            'post_parent' => $parent,
            // exclude those posts that eppear in the previous loop
            'post__not_in' => $excludeID
        );

        $popularquery = new WP_Query($args); ?>

        <?php while ($popularquery->have_posts()) : $popularquery->the_post(); ?>

            <li>
                <!-- post thumbnail linking to the post -->
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                <?php endif; ?>

                <!-- title -->
                <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>

                <!-- date -->
                <p class="date">Posted on: <?php the_time('j F Y'); ?></p>

                <!-- display the post excerpt -->
                <p><?php the_excerpt(__('(more…)')); ?></p>
            </li>

        <?php endwhile;
        wp_reset_postdata();
        ?>
    </ul>
</section>


<?php get_footer(); ?>