<?php
$content = get_the_content();
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('box mb20'); ?>>

	<header class="entry-header">
		<?php g7_breadcrumbs(); ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php edit_post_link('Edit', '<div class="entry-meta">(', ')</div>'); ?>
	</header>

	<?php if (!empty($content)) : ?>
		<div class="entry-content clearfix mt20">
			<?php the_content(); ?>
		</div>
		<?php wp_link_pages(array('before' => '<footer class="entry-footer mt20"><p><strong>Pages:</strong> ', 'after' => '</p></footer>', 'next_or_number' => 'number')); ?>
	<?php endif; ?>

</article>