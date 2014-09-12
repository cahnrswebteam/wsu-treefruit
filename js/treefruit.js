jQuery(document).ready(function(){
	var treefruit = new init_treefruit();
	});

var init_treefruit = function(){
	var s = this;
	
	s.init_srch_tbs = function(){
		jQuery('#search-filter > ul > li').hover(
			function(){ s.init_srch_tbs.shw_ops( jQuery( this ) ); },
			function(){ s.init_srch_tbs.hd_ops( jQuery( this ) );}
		);
		jQuery('#search-filter > ul > li').on('click','label', function(){
			s.init_srch_tbs.tgl_ops( jQuery( this ) );
			});
		
		s.init_srch_tbs.shw_ops = function( ih ){
			ih.find('li').slideDown('fast');
		}
		s.init_srch_tbs.hd_ops = function( ih ){
			ih.find('li').not('.selected').slideUp('fast');
		}
		s.init_srch_tbs.tgl_ops = function( ic ){
			var li = ic.parent('li');
			if( li.hasClass('selected') ){
				li.removeClass('selected');
				li.css('display','block');
			} else {
				li.addClass('selected');
				if( li.hasClass('input-type-radio') ) li.siblings().removeClass('selected');
			}
		}
	}
	
	s.init_srch = function(){
		jQuery('#site-search input').on('focus',function(){
			if( jQuery( this).val() == 'Search') jQuery(this).val('');
			});
		jQuery('#site-search a').on('click',function(){
			jQuery('#site-search').submit();
			})
	}
	
	s.init_srch_tbs();
	s.init_srch();
}
