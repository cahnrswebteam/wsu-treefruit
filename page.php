<?php get_header(); ?>

<main class="spine-page-default">

<?php get_template_part('parts/headers'); ?>
<?php get_template_part('parts/featured-images'); ?>

<section class="row side-right gutter marginalize-ends">
	<h1 class="fs-page-title"><?php the_title(); ?></h1>
	<?php the_content(); ?>
</section>

</main>

<?php get_footer(); ?>