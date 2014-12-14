<div>
	<b><?php echo $instance[ 'title' ]; ?></b>
	<ul>
		<?php $loop = new WP_Query( array( 'post_type' => 'post-type-template', '3' => -1 ) ); ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<li>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<span>Post Meta b:<?php echo get_post_meta(the_id(), 'meta_b', true); ?>meta_b</span>
		</li>	
		<?php endwhile; wp_reset_query(); ?>
	</ul>
</div>