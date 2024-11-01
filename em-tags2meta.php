<?php
/*
Plugin Name: Tags 2 Meta Generator
Version: 0.1
Plugin URI: http://www.axdimensions.com/pixelnotes/category/wordpress/tags-2-meta-generator/
Description: Generates META tags automatically from your post tags!
Author: Em
Author URI: http://www.axdimensions.com/
*/

	function em_tags2meta() {
		if(is_single())
			getposttags();
		else 
			getpagetags();			
	}
	
	function getposttags()
	{
		if ( have_posts() ) : while ( have_posts() ) : the_post();
		
			echo "\n";
		
			echo '<meta name="description" content="';
			bloginfo('name'); echo " - "; the_title();
			echo '" />';
				
			echo "\n";
				
			$posttags = get_the_tags();
			$tags = array();
			if ($posttags) {
				foreach($posttags as $tag) 
					$tags[] = $tag->name; 
			}
			$tags = array_unique($tags);
			if($tags) {
				echo '<meta name="keywords" content="';
				echo implode(', ',$tags);
				echo '" />';
					
				echo "\n";
			}
				
		endwhile; endif;		
	}
	
	function getpagetags()
	{
		echo "\n";
		
		echo '<meta name="description" content="';
		bloginfo('name'); 
		if(is_home()) {
			echo " - "; bloginfo('description');
		}
		else
			wp_title('-');

		echo '" />';
			
		echo "\n";
			
		$categories = get_categories('hide_empty=0'); 
		$cats = array();
		if($categories) {
			foreach ($categories as $cat)
				$cats[] = $cat->cat_name;
		}
  		$cats = array_unique($cats);
		if($cats) {
			echo '<meta name="keywords" content="';	
			echo implode(', ',$cats);
			echo '" />';
  				
			echo "\n";
		}		
	}
	
	add_action('wp_head', 'em_tags2meta');
	
?>