<?php 
global $wsu_treefruit;
$search = $wsu_treefruit->get_search( /*array( 'test' => true )*/ );
get_header(); ?>

<main class="spine-page-default">

<?php get_template_part('parts/headers'); ?>

<section class="row side-right gutter marginalize-ends">
	<h1 class="fs-page-title">Tree Fruit Search</h1>
    <div class="search-subtitle">Your search for <span class="search-term">"<?php echo $_GET['s'];?>"</span> returned <?php echo $search['total'];?> results.</div>
    <?php get_template_part('parts/search','tools');?>  
    <?php include WSUTREEFRUIT14DIR.'/parts/search-results.php';?>
</section>
<section>
    <?php get_template_part('parts/search','tabs');?>  
</section>

</main>

<?php get_footer(); ?>