<?php 
global $wsu_treefruit;
$s = ( isset( $_GET['s']) )? $_GET['s'] : '';?>
<nav class="treefruit-tabs-nav">
	<ul>
    	<li class="first-child selected">
        	<a href="/?s=<?php echo $s;?>&site=related" >
            	Related Websites 
            </a>
        </li><li>
        	<a href="/?s=<?php echo $s;?>&site=wtfrcreports" >
            	WTFRC Reports  
            </a>
        </li>
    </ul>
</nav>
<div class="treefruit-tabs-content">
	<div class="first-child selected">
		<?php $search = $wsu_treefruit->get_search( array( 's' => $_GET['s'] , 'site' => 'goodfruit' ) );?>
        <?php include WSUTREEFRUIT14DIR.'/parts/search-results.php';?>
    </div>
    <div>
		<?php $search = $wsu_treefruit->get_search( array( 'test' => true ) );?>
        <?php include WSUTREEFRUIT14DIR.'/parts/search-results.php';?>
    </div>
</div>
 