<!-- Да простит меня бог за такие издевательства -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<style type="text/css">
	.Super-widget-the-best-of-the-best {
		background: #fff;
		color: #000!important;
		list-style: none!important;
		border-radius: 5px;

	}
</style>
<div class="Super-widget-the-best-of-the-best">
	<b><?php echo $instance[ 'title' ]; ?></b>
	<ul class="container">
		<?php $loop = new WP_Query( array( 'post_type' => 'post-type-template', '3' => -1 ) ); ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<li class="col-md-2">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<span>Post Meta b:<?php echo get_post_meta(the_id(), 'meta_b', true); ?>meta_b</span>
		</li>	
		<?php endwhile; wp_reset_query(); ?>
	</ul>
</div>