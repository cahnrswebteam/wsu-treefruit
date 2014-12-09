<?php
global $wsu_treefruit;
$st['s'] = ( isset( $_GET['s'] ) )? $_GET['s'] : '';
$st['sort'] = ( isset( $_GET['sort'] ) )? $_GET['sort'] : 'relevance';
$st['type'] = ( isset( $_GET['type'] ) )? $_GET['type'] : 'all';
$st['site'] = ( isset( $_GET['site'] ) )? $_GET['site'] : 'wsu';
$f = array(
	'sort' => array(
		'title' => 'Sort By',
		'class' => 'radio',
		'options' => array(
			'relevance' => 'Relevance',
			'date' => 'Date',
		),
	),
	'type' => array(
		'title' => 'Content Type',
		'class' => 'multi',
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
		'class' => 'multi',
		'options' => array(
			'wsu' => 'WSU Websites',
			'treefruit' => 'Tree Fruit',
			'goodfruit' => 'Good Fruit Grower',
		),
	),
);?>
<form id="search-filter">
	<div class="search-bar">
    	<input type="text" value="<?php echo $st['s'];?>" name="s" />
        <a class="form-submit" href="#">Go</a> 
    </div>
    <ul>
    <?php foreach( $f as $fk => $fv ):
		?><li>
            <a href="#"><?php echo $fv['title'];?></a>
            <ul>
            <?php foreach( $fv['options'] as $k => $v ):
				$selected = ( $k == $st[$fk] )? ' selected':'';
				?>
                <li class="<?php echo $selected;?> input-type-<?php echo $fv['class'];?>">
                    <input type="checkbox" name="<?php echo $fk;?>[<?php echo $k;?>][]" id="search-<?php echo $fk;?>-<?php echo $k;?>" value="1" />
                    <label for="search-<?php echo $fk;?>-<?php echo $k;?>"><?php echo $v;?></label>
                    
                </li>
            <?php endforeach;?>
            </ul>
        </li><?php 
	endforeach;?>
    </ul>
</form>