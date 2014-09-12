<?php
global $wsu_treefruit;
//https://www.googleapis.com/customsearch/v1?q=apples&cx=004797236515831676218%3Ajjbaaricka8&key=AIzaSyB7d9IJ6IVhch-VZ-cIPak08Lvq5XqWd34&num=10
$s = file_get_contents( WSUTREEFRUIT14DIR.'/json/cse-test.json' );
$s = ( $s )? json_decode( $s ) : false;
$sd = array();
$sd['results'] = ( $s )? $s->queries->request[0]->totalResults : 0;
$sd['items'] = ( $s )? $s->items : array();
$f = array(
	'sort' => array(
		'title' => 'Sort Options',
		'options' => array(
			'relevance' => 'Relevance',
			'date' => 'Date',
		),
	),
	'type' => array(
		'title' => 'Content Type',
		'options' => array(
			'all' => 'All',
			'web' => 'Web Pages',
			'pdf' => 'PDFs',
			'image' => 'Images',
			'ppt' => 'PowerPoint'
		),
	),
	'site' => array(
		'title' => 'Site',
		'options' => array(
			'wsu' => 'WSU Websites',
			'treefruit' => 'Tree Fruit',
			'goodfruit' => 'Good Fruit Grower',
		),
	),
);



?>

<?php get_header(); ?>

<main class="spine-page-default">

<?php get_template_part('parts/headers'); ?>
<?php get_template_part('parts/featured-images'); ?>

<section class="row side-right gutter marginalize-ends">
	<h1 class="fs-page-title">Tree Fruit Search</h1>
    <div class="search-subtitle">Your search for <span class="search-term">"Apples"</span> returned <?php echo $sd['results'];?> results.</div>
    <form id="search-filter">
    	<div>Advanced Search</div>
        <input type="text" value="" name="s" /> 
        <ul>
        <?php foreach( $f as $fk => $fv ):?>
			<li>
				<a href="#"><?php echo $fv['title'];?></a>
                <ul>
				<?php foreach( $fv['options'] as $k => $v ):?>
                	<li>
                    	<label for="search-<?php echo $fk;?>-<?php echo $k;?>"><?php echo $v;?></label>
                     	<input type="checkbox" name="<?php echo $fk;?>[<?php echo $k;?>][]" id="search-<?php echo $fk;?>-<?php echo $k;?>" value="1" />
                    </li>
                <?php endforeach;?>
                </ul>
            </li>
		<?php endforeach;?>
		
        </ul>
    </form>
    <?php var_dump( $s->queries->request[0]->totalResults );?>
    <?php 
	if( $sd['items'] ){ 
		$wsu_treefruit->get_results( $sd['items'] );
	};// End if ?>
	test
</section>

</main>

<?php get_footer(); ?>