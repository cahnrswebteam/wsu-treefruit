<?php if( isset( $search ) && $search ): // Has search declared ?>
	<?php
	$i = 1; 
	foreach( $search['results'] as $result ):
		if( $i > $search['count'] && $search['truncate'] ) break;
		$clss = ( $i <= $search['count'] )? ' active': '';?>
        <!-- Start Result -->
        <article class="search-article<?php echo $clss;?>">
        	<h4>
            	<a href="<?php echo $result->link;?>">
					<?php echo $result->title;?>
                </a>
            </h4>
            <div class="link">
            	<a href="<?php echo $result->link;?>">
					<?php echo $result->link;?>
                </a>
			</div>
            <div class="snippet">
				<?php echo $result->snippet;?>
			</div>
        </article>
        <!-- End Result -->
        <?php $i++;?>
    <?php endforeach;?>
<?php elseif( !isset( $search ) || !$search['total'] ): // No search or no results ?>
	No Results Found...
<?php endif;?>