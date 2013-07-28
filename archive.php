<?php
/**
 * the template for displaying Archive pages
 *
 * To edit the archive template, do so in a child theme by COPYING
 * and pasting the templates/content-archive.php file into your child
 * folder in the same structural location. Then, WordPress will use 
 * your child theme's content-archive.php file instead. 
 */
?>

<?php get_header(); ?>

<section class="content">

	<?php 
		/** 
		 * The loop is inside of the content-archive.php file because 
		 * of the way archive pages are structured. Also, get main 
		 * template HTML from template file.
		 */
		get_template_part( 'templates/content', 'archive' ); 
	?>
	
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>