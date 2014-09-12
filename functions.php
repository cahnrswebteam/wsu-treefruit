<?php
class wsu_treefruit {
	
	
	public function __construct(){
		$this->define_constants();
	}
	
	private function define_constants() {
		define( 'WSUTREEFRUIT14DIR', get_stylesheet_directory() ); // CONSTANT FOR THEME DIRECTORY - DB
		define( 'WSUTREEFRUIT14URI', get_stylesheet_directory_uri() ); // CONSTANT FOR THEM URI - DB
	}
	
	public function add_scripts(){
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