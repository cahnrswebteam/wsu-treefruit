<?php
class wsu_treefruit {
	
	
	public function __construct(){
		$this->define_constants();
		add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts' ), 20 );
	}
	
	private function define_constants() {
		define( 'WSUTREEFRUIT14DIR', get_stylesheet_directory() ); // CONSTANT FOR THEME DIRECTORY - DB
		define( 'WSUTREEFRUIT14URI', get_stylesheet_directory_uri() ); // CONSTANT FOR THEM URI - DB
	}
	
	public function add_scripts(){
		wp_enqueue_script( 'treefruit-js', WSUTREEFRUIT14URI . '/js/treefruit.js' , false, '1.1.0', false );
	}
	
	public function get_search( $custom = false ){
		/***************************************
		** For testing and site build **
		***************************************/
		if( isset( $custom['test'] ) && $custom['test'] ) {
			$s = file_get_contents( WSUTREEFRUIT14DIR.'/json/cse-test.json' );
			$s = ( $s )? json_decode( $s ) : false;
			$search['total'] = ( $s )? $s->queries->request[0]->totalResults : 0;
			$search['results'] = ( $s )? $s->items : array();
			$search['count'] = 5;
			$search['truncate'] = false;
			return $search;
		}
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
		
		/* https://www.googleapis.com/customsearch/v1?q=apples&cx=004797236515831676218%
		3Ajjbaaricka8&key=AIzaSyB7d9IJ6IVhch-VZ-cIPak08Lvq5XqWd34&num=10 */
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