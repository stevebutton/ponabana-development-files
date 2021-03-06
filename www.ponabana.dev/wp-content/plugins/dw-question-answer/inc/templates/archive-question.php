<?php  
/**
 *  Template use for display list of question 
 *
 *  @since  DW Question Answer 1.0
 */

get_header('dwqa'); ?>

<?php do_action( 'dwqa_before_page' ) ?>

<div id="archive-question" class="dw-question">
<?php  do_action('dwqa-prepare-archive-posts');?>
<?php if ( have_posts() ) : ?>
	<div class="questions-wrap">
    <h2>Posez-nous vos Questions !</h2>
    <p>Vous avez une question concernant la situation des enfants en RDCongo ou le travail de l'UNICEF?</p>

<p>N'hésitez pas, un specialiste de l'UNICEF répondra aux questions sélectionnées dans les plus brefs délais!</p>

<p>Note: Afin de faciliter le bon fonctionnement de ce service, nous vous invitons à vérifier que votre question n'a pas déjà été posée.</p>
		<div class="loading"></div>
			<div class="dw-search">
		    	<form action="" class="dwqa-search-form">
		     		<input class="dwqa-search-input" placeholder="<?php _e('Search','dwqa') ?>">
		            <span class="dwqa-search-submit icon-search show"></span>
		            <span class="dwqa-search-loading hide"></span>
		            <span class="dwqa-search-clear icon-remove hide"></span>
	          	</form>
		   	</div>
			<div class="filter-bar">
				<?php wp_nonce_field( '_dwqa_filter_nonce', '_filter_wpnonce', false ); ?>
				<input type="hidden" id="dwqa_filter_posts_per_page" name="posts_per_page" value="<?php echo get_query_var( 'posts_per_page' ); ?>">
				<?php  
					global $dwqa_options;
					$submit_question_link = get_permalink( $dwqa_options['pages']['submit-question'] );
				?>
				<?php if( $dwqa_options['pages']['submit-question'] && $submit_question_link ) { ?>
				<a href="<?php echo $submit_question_link ?>" class="btn btn-success"><?php _e('Ask a question','dwqa') ?></a>
				<?php } ?>
				<div class="filter">
					<li class="status">
						<?php  
							$selected = isset($_GET['status']) ? $_GET['status'] : 'all';
						?>
						<ul>
							<li><?php _e('Status:') ?></li>
							<li class="<?php echo $selected == 'all' ? 'active' : ''; ?> status-all" data-type="all">
								<a href="#"><?php _e( 'All','dwqa' ); ?></a>
							</li>

							<li class="<?php echo $selected == 'open' ? 'active' : ''; ?> status-open" data-type="open">
								<a href="#"><?php echo current_user_can( 'edit_posts' ) ? __( 'Need Answer','dwqa' ) : __( 'Open','dwqa' ); ?></a>
							</li>
							<li class="<?php echo $selected == 'replied' ? 'active' : ''; ?> status-replied" data-type="replied">
								<a href="#"><?php _e( 'Answered','dwqa' ); ?></a>
							</li>
							<li class="<?php echo $selected == 'resolved' ? 'active' : ''; ?> status-resolved" data-type="resolved">
								<a href="#"><?php _e( 'Resolved','dwqa' ); ?></a>
							</li>
							<li class="<?php echo $selected == 'closed' ? 'active' : ''; ?> status-closed" data-type="closed">
								<a href="#"><?php _e( 'Closed','dwqa' ); ?></a>
							</li>
							<?php if( current_user_can( 'edit_published_posts' ) ) : ?>
							<li class="<?php echo $selected == 'overdue' ? 'active' : ''; ?> status-overdue" data-type="overdue"><a href="#"><?php _e('Overdue','dwqa') ?></a></li>
							<li class="<?php echo $selected == 'pending-review' ? 'active' : ''; ?> status-pending-review" data-type="pending-review"><a href="#"><?php _e('Queue','dwqa') ?></a></li>
	
							<?php endif; ?>
						</ul>
					</li>
				</div>
				<div class="filter sort-by">
					<?php  
						
					?>
						<div class="filter-by-category select">
							<?php 
								$selected = false;
								$taxonomy = get_query_var( 'taxonomy' );
								if( $taxonomy && 'dwqa-question_category' == $taxonomy ) {
									$term_name = get_query_var( $taxonomy );
									$term = get_term_by( 'slug', $term, $taxonomy );
									$selected = $term->term_id;
								} elseif( 'dwqa-question_category' == $taxonomy ) {
									$selected =  isset($_GET['dwqa-category']) ? $_GET['dwqa-category'] : 'all'; 
								}
								$selected_label = __('Select a category','dwqa');
								if( $selected  && $selected != 'all' ) {
									$selected_term = get_term_by( 'id', $selected, 'dwqa-question_category' );
									$selected_label = $selected_term->name;
								}
							?>
							<span class="current-select"><?php echo $selected_label; ?></span>
							<ul id="dwqa-filter-by-category" class="category-list" data-selected="<?php echo $selected; ?>">
							<?php  
								wp_list_categories( array(
									'show_option_all'	=>	__('All','dwqa'),
									'show_option_none'  => __('Empty','dwqa'),
									'taxonomy'			=> 'dwqa-question_category',
									'hide_empty'        => 0,
									'show_count'		=> 0,
									'title_li'			=> '',
									'walker'			=> new Walker_Category_DWQA
								) );
							?>	
							</ul>
						</div>
					<?php if( $taxonomy == 'dwqa-question_tag' ) { ?>
						<?php
							$selected = false;
							if( $taxonomy ) {
								$term_name = get_query_var( $taxonomy );
								$term = get_term_by( 'slug', $term_name, $taxonomy );
								$selected = $term->term_id;
							} elseif( 'dwqa-question_category' == $taxonomy ) {
								$selected =  isset($_GET['dwqa-tag']) ? $_GET['dwqa-tag'] : 'all'; 
							}
							if( isset( $selected )  &&  $selected != 'all' ) {
								?>
								<input type="hidden" name="dwqa-filter-by-tags" id="dwqa-filter-by-tags" value="<?php echo $selected ?>" >
								<?php
							}
						?>
					<?php } ?>
					<ul class="order">
						<li class="most-reads" data-type="views" >
							<span><?php _e('View', 'dwqa') ?></span> <i class="sort icon-sort"></i>
						</li>
						<li class="most-answers" data-type="answers" >
							<span href="#"><?php _e('Answer', 'dwqa') ?></span> <i class="sort icon-sort"></i>
						</li>
						<li class="most-votes" data-type="votes" >
							<span><?php _e('Vote', 'dwqa') ?></span> <i class="sort icon-sort"></i>
						</li>
					</ul>
				</div>
			</div>
			<div class="questions-list">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php dwqa_load_template( 'content', 'question' ); ?>
			<?php endwhile; ?>
			</div>
		<div class="archive-question-footer">
		<?php 
			if( $taxonomy == 'dwqa-question_category' ) { 
				$args = array(
					'post_type' => 'dwqa-question',
					'posts_per_page'	=>	-1,
					'tax_query' => array(
						array(
							'taxonomy' => $taxonomy,
							'field' => 'slug',
							'terms' => $term_name
						)
					)
				);
				$query = new WP_Query( $args );
				$total = $query->post_count;
			} else if( 'dwqa-question_tag' == $taxonomy ) {

				$args = array(
					'post_type' => 'dwqa-question',
					'posts_per_page'	=>	-1,
					'tax_query' => array(
						array(
							'taxonomy' => $taxonomy,
							'field' => 'slug',
							'terms' => $term_name
						)
					)
				);
				$query = new WP_Query( $args );
				$total = $query->post_count;
			} else {
				$total = wp_count_posts( 'dwqa-question' );
				$total = $total->publish;
			}

			$number_questions = $total;

			$number = get_query_var( 'posts_per_page' );

			$pages = ceil( $number_questions / $number );
			
			if( $pages > 1 ) {

		?>
		
			<div class="pagination">
				<ul data-pages="<?php echo $pages; ?>" >
					<?php  
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$i = 0;
						echo '<li class="prev';
						if( $i == 0 ) {
							echo ' hide';
						}
						echo '"><a href="javascript:void()">'.__('Prev', 'dwqa').'</a></li>';
						$link = get_post_type_archive_link( 'dwqa-question' );
						$start = $paged - 2;
						$end = $paged + 2;

			            if( $end > $pages ) {
			                $end = $pages;
			                $start = $pages -  5;
			            }

			            if( $start < 1 ) {
			                $start = 1;
			                $end = 5;
			                if( $end > $pages ) {
			                	$end = $pages;
			                }
			            }
						for ($i=$start; $i <= $end; $i++) { 
							$current = $i == $paged ? 'class="active"' : '';
							if( $i == 1 ) {
								echo '<li '.$current.'><a href="'.$link.'">'.$i.'</a></li>';
							}else{
								echo '<li '.$current.'><a href="'.add_query_arg('paged', $i, $link).'">'.$i.'</a></li>';
							}
						}
						echo '<li class="next';
						if( $paged == $pages ) {
							echo ' hide';
						}
						echo '"><a href="javascript:void()">'.__('Next', 'dwqa') .'</a></li>';

					?>
				</ul>
			</div>
			<?php } ?>
			<?php if( $dwqa_options['pages']['submit-question'] && $submit_question_link ) { ?>
			<a href="<?php echo $submit_question_link ?>" class="btn btn-success"><?php _e('Ask a question','dwqa') ?></a>
			<?php } ?>
		</div>
	</div>

<?php else: ?>
	<?php
        echo '<p class="not-found">';
         _e('Sorry, but nothing matched your filter.', 'dwqa' );
         if( is_user_logged_in() ) {
            global $dwqa_options;
            if( isset($dwqa_options['pages']['submit-question']) ) {
                
                $submit_link = get_permalink( $dwqa_options['pages']['submit-question'] );
                if( $submit_link ) {
                    _e('You can ask question <a href="'.$submit_link.'">here</a>', 'dwqa' );
                }
            }
         } else {
            _e('Please <a href="'.wp_login_url( get_post_type_archive_link( 'dwqa-question' ) ).'">Login</a>', 'dwqa' );

            $register_link = wp_register('', '',false);
            if( ! empty($register_link) && $register_link  ) {
                echo __(' or','dwqa').' '.$register_link;
            }
            _e(' to submit question.','dwqa');
            wp_login_form();
         }

        echo  '</p>';
	?>
<?php endif; ?>

</div>
<?php do_action( 'dwqa_after_page' ) ?>
<?php get_footer('dwqa'); ?>