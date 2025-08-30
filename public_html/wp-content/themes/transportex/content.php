<?php
/**
 * The template for displaying the content.
 * @package transportex
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="transportex-blog-post-box">

	<?php
		$post_thumbnail_url = get_the_post_thumbnail( get_the_ID(), 'img-fluid' );
		if ( !empty( $post_thumbnail_url ) ) { ?>
		<div class="transportex-blog-thumb"> 
			<div class="transportex-blog-category"> 
				<?php   $cat_list = get_the_category_list();
				if(!empty($cat_list)) { ?>
				<?php the_category(' '); ?>
				<?php } ?>
			</div> 
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
			<?php echo $post_thumbnail_url; ?>		
        </a>
		</div>
		<article class="small"> 
		<?php } else { ?>
		<article class="small"> 
				<div class="transportex-blog-category"> 
					<?php   $cat_list = get_the_category_list();
					if(!empty($cat_list)) { ?>
					<?php the_category(' '); ?>
					<?php } ?>
				</div>
			<?php }?>
			<div class="transportex-blog-meta">
			<span class="transportex-blog-date"><?php echo get_the_date('j'); ?>
				<?php echo get_the_date('M'); ?>
			</span> 
			<a class="transportex-author" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php _e('by','transportex'); ?>
				<?php the_author();?>
			</a>
			<?php
			transportex_edit_link();
			$tag_list = get_the_tag_list();
				if($tag_list){ ?>
					<span class="tag-links"><a href="<?php the_permalink(); ?>"><?php the_tags('', ', ', ''); ?></a></span>
				<?php } ?>
			</div>
			
			<h1 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
			<?php
				$transportex_more = strpos( $post->post_content, '<!--more' );
				if ( $transportex_more ) :
					echo get_the_content();
				else :
					echo get_the_excerpt();
				endif;
			?>
			
				<?php wp_link_pages( array( 'before' => '<div class="link">' . __( 'Pages:', 'transportex' ), 'after' => '</div>' ) ); ?>
		</article>
	</div>
</div>