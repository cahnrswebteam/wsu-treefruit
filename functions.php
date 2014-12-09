<?php
global $pagebuilder_layout_override;
$pagebuilder_layout_override = array(
					'row-100' => array(
						'id' => 'row-100',
						'name' => 'Header',
						),
					'row-1' => array(
						'id' => 'row-1',
						'name' => 'Content Row',
						'layout' => 'pagbuilder-layout-aside',
						'columns' => array(
							'column-1' => array(
								'items' => array(
									'page_content-1' => array(
										'id' => 'page_content',
										'instance' => 1,
										'type' => 'native',
									),
								),
							),
						),
					),
					'row-2' => array(
						'id' => 'row-2',
						'name' => 'Apple',
						'layout' => 'pagbuilder-layout-aside',
						'bgimage' => 387,
						'category' => 'apple-section',
						'titletag' => 'h2',
					),
					'row-3' => array(
						'id' => 'row-3',
						'name' => 'Pear',
						'layout' => 'pagbuilder-layout-aside',
						'bgimage' => 702,
						'category' => 'pear-section',
						'titletag' => 'h2',
					),
					'row-4' => array(
						'id' => 'row-4',
						'name' => 'Cherry',
						'layout' => 'pagbuilder-layout-aside',
						'bgimage' => 388,
						'category' => 'cherry-section',
						'titletag' => 'h2',
					),
					'row-5' => array(
						'id' => 'row-5',
						'name' => 'Stone Fruit',
						'layout' => 'pagbuilder-layout-aside',
						'category' => 'stone-fruit-section',
						'titletag' => 'h2',
					),
					'row-200' => array(
						'id' => 'row-200',
						'name' => 'Footer',
						),
				);
class wsu_treefruit {
	
	public $crops = array( 'Apple' , 'Cherry' , 'Pear' , 'Stone Fruit' );
	
	public function __construct(){
		/*******************************
		* Define Theme Constants *
		**********************************/
		define( 'WSUTREEFRUIT14DIR', get_stylesheet_directory() ); // CONSTANT FOR THEME DIRECTORY - DB
		define( 'WSUTREEFRUIT14URI', get_stylesheet_directory_uri() ); // CONSTANT FOR THEM URI - DB
		
		add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts' ), 20 );
		
		add_action( 'admin_init' , array( $this , 'tf_admin_init' ) );
		
		add_action( 'cahnrs_pagebuilder_before_render_import', array( $this , 'cahnrs_pagebuilder_before_render_import' ), 10 , 2 );
		
		if( is_admin() ){
			$this->init_admin();
		} else {
			$this->init_public();
		}
	}
	
	public function cahnrs_pagebuilder_before_render_import( $row , $post_id ) {
		
		$image = 'http://devsite.wpdev.cahnrs.wsu.edu/treefruit/wp-content/uploads/sites/2/2014/10/apples-no-copyright-do-not-use.jpg';
		
		if( isset( $row['bgfull'] ) && $row['bgfull'] ) {
			
			$categories = get_the_category( $post_id );
			
			$crops = array();
			
			foreach( $categories as $category ){
				
				if( in_array( $category->name , $this->crops  ) ) {
				
					$crops[] = $category;
				
				}
				
			}
			
			if( count( $crops ) == 1 ) {
				
				switch( $crops[0]->name ){
					
					case 'Apple':
						$image = 'http://devsite.wpdev.cahnrs.wsu.edu/treefruit/wp-content/uploads/sites/2/2014/10/apples-no-copyright-do-not-use.jpg';
						$anchor = 'apple-section';
						break;
					case 'Cherry':
						$image = 'http://devsite.wpdev.cahnrs.wsu.edu/treefruit/wp-content/uploads/sites/2/2014/10/cherry-no-copyright-do-no-use.jpg';
						$anchor = 'cherry-section';
						break;
				}
				
			} 
		
			include WSUTREEFRUIT14DIR . '/inc/inc-background-banner.php';
		
		}
		
	}
	
	public function add_scripts(){
		wp_enqueue_script( 'treefruit-js', WSUTREEFRUIT14URI . '/js/treefruit.js' , false, '1.1.0', false );
	}
	
	public function tf_admin_init(){
		/** Register default taxonomies for pages **/
		\register_taxonomy_for_object_type('post_tag', 'page');
		\register_taxonomy_for_object_type('category', 'page'); 
	}
	
	private function init_public(){
	}
	
	private function init_admin(){
		
	}
	
	
	public function get_search( $custom = false ){
		/***************************************
		** For testing and site build **
		***************************************/
		/*if( isset( $custom['test'] ) && $custom['test'] ) {
			$s = file_get_contents( WSUTREEFRUIT14DIR.'/json/cse-test.json' );
			$s = ( $s )? json_decode( $s ) : false;
			$search['total'] = ( $s )? $s->queries->request[0]->totalResults : 0;
			$search['results'] = ( $s )? $s->items : array();
			$search['count'] = 5;
			$search['truncate'] = false;
			return $search;
		}*/
		/** End Testing **********************/
		$args = array();
		if( $custom ){
			$args['s'] = ( isset( $custom['s'] ) )? $_GET['s'] : '';
			$args['sort'] = ( isset( $custom['sort'] ) )? $custom['sort'] : 'relevance';
			$args['type'] = ( isset( $custom['type'] ) )? $custom['type'] : 'all';
			$args['site'] = ( isset( $custom['site'] ) )? $custom['site'] : 'wsu';
			$args['count'] = ( isset( $custom['count'] ) )? $custom['count'] : 5;
			$args['truncate'] = ( isset( $custom['truncate'] ) )? $custom['truncate'] : false;
		} else {
			$args['s'] = ( isset( $_GET['s'] ) )? $_GET['s'] : '';
			$args['sort'] = ( isset( $_GET['sort'] ) )? $_GET['sort'] : 'relevance';
			$args['type'] = ( isset( $_GET['type'] ) )? $_GET['type'] : 'all';
			$args['site'] = ( isset( $_GET['site'] ) )? $_GET['site'] : 'wsu';
			$args['count'] = ( isset( $_GET['count'] ) )? $_GET['count'] : 5;
			$args['truncate'] = ( isset( $_GET['truncate'] ) )? $_GET['truncate'] : false;
			
		}
		$s = file_get_contents( 'https://www.googleapis.com/customsearch/v1?q='.$args['s'].'&cx='.$this->get_sid($args['site'] ).'&key=AIzaSyB7d9IJ6IVhch-VZ-cIPak08Lvq5XqWd34&num=10' );
		$s = ( $s )? json_decode( $s ) : false;
		$search['total'] = ( $s )? $s->queries->request[0]->totalResults : 0;
		$search['results'] = ( $s )? $s->items : array();
		$search['count'] = 5;
		$search['truncate'] = false;
		return $search;
	}
	
	public function get_sid( $site ){
		$sites = array(
			'goodfruit' => '004797236515831676218:novnblhgf8k',
			'wsu' => '004797236515831676218%3Ajjbaaricka8',
			);
		if( array_key_exists( $site , $sites ) ) return $sites[$site];
		return '004797236515831676218%3Ajjbaaricka8';
	}
	
	public function get_results( $s , $c = 5 , $h = false ){
		$i = 1;
		foreach ( $s as $item ){
			$show_class = ( $i <= $c )? ' active': '';
			if( $i > $c && $h ) break;
			$lk = $item->link;
			$lks = '<a href="'.$item->link.'">';
			$lke = '</a>';
			echo '<article class="search-article'.$show_class.'">';
				echo '<h3>'.$lks.$item->title.$lke.'</h3>';
				echo '<div class="link">'.$lks.$lk.$lke.'</div>';
				echo '<div class="snippet">'.$item->snippet.'</div>';
			echo '</article>';
			$i++;
		}
		
	}
	
}
$wsu_treefruit = new wsu_treefruit();