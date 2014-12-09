<?php 
$fruits = array('apple','pear','cherry', 'stone-fruit' );

get_header(); ?>

<main class="spine-page-default">

<?php get_template_part('parts/headers'); ?>

<section class="row side-right gutter marginalize-ends">
	<article>
	<h1 class="fs-page-title"><?php the_title(); ?>
    	<?php if( !is_front_page() ) :?>
			<?php foreach( $fruits as $fruit ):?>
                <a class="fruit-icon <?php echo $fruit;?>-icon" href="#<?php echo $fruit;?>-section" data-section="<?php echo $fruit;?>-section"></a>
            <?php endforeach;?><?php endif;?></h1>
        
	<?php the_content(); ?>
    </article>
</section>

</main>

<?php get_footer(); ?>