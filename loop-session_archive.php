<div id="primary" class="site-content">
		<div id="content" role="main">

	<?php
		$args = array(
			'post_type' => 'ona_session',		
			'posts_per_page' => 100,
			'meta_key' => 'start_time',
			'orderby' => 'meta_value',
			'order' => 'asc',
			'no_found_rows' => true,
		);
	
		if ( is_tax() ) {
			$queried_term = get_queried_object();	
			$args['tax_query'] = array(
				array(
					'taxonomy' => $queried_term->taxonomy,
					'field' => 'id',
					'terms' => $queried_term->term_id,
				),
			);
		}
	
		$sessions = new WP_Query( $args );
	
		$session_days = array(
			'09/20/2012',
			'09/21/2012',
			'09/22/2012',
		);

		// Some crafty shit to put the current date at the top
		$today = date( 'm/d/Y', ( time() - 25200 ) );
		if ( in_array( $today, $session_days ) ) {
			if ( 1 == array_search( $today, $session_days ) ) {
				$yesterday = array_shift( $session_days );
				$session_days[] = $yesterday;
			} else if ( 2 == array_search( $today, $session_days ) ) {
				$saturday = array_pop( $session_days );
				array_unshift( $session_days, $saturday );
			}
		}
	
		// Load all of the sessions into an array based on start date and time
		$all_sessions = array(
				$session_days[0] => array(),
				$session_days[1] => array(),
				$session_days[2] => array(),
			);
		while( $sessions->have_posts() ) {
			$sessions->the_post();
			$start_timestamp = get_post_meta( get_the_ID(), 'start_time', true );
			$start_date = date( 'm/d/Y', $start_timestamp );
			$start_time = date( 'g:i a', $start_timestamp );
			$all_sessions[$start_date][$start_time][$post->ID] = $post;
		}
		?>

		<?php if ( is_tax() ): ?>
			<?php $queried_object = get_queried_object(); ?>
			<h2><a href="<?php echo get_site_url( null, '/sessions/' ); ?>"><?php _e( 'All Sessions' ); ?></a>
			<?php
				$term_title_html = ' &rarr; <a href="' . get_term_link( $queried_object ) . '">' . esc_html( $queried_object->name ) . '</a>';
				if ( $queried_object->parent ) {
					$parent_term = get_term_by( 'id', $queried_object->parent, $queried_object->taxonomy );
					$term_title_html = ' &rarr; <a href="' . get_term_link( $parent_term ) . '">' . esc_html( $parent_term->name ) . '</a>' . $term_title_html;
				}
				echo $term_title_html;
			?></h2>
			<?php if ( $queried_object->description ): ?>
			<div class="term-description">
			<?php echo wpautop( $queried_object->description ); ?>	
			</div>
			<?php endif; ?>
		<?php else: ?>
			<div class="left">
            	<header class="entry-header">
                	<h1 class="entry-title">Program Schedule</h1>
                </header>
                <p>Welcome to the first edition of our program. For a complete description of <strong>Listen</strong>, <strong>Solve</strong> and <strong>Make</strong> and details on the conference, take a look at our <a href="http://ona13.journalists.org/2013/07/12/join-us-at-ona13-the-town-hall-for-journalism/" target="_blank">blog post</a>. You can organize your view by clicking on  Day 1, 2 or 3 or the L, S, and M buttons at the top of the schedule. Look for more sessions and speakers in the coming weeks and an interactive version will be rolled out in August.</p>
                <div class="key">
                    <div>
                    	<label class="listen">Listen</label>
                    	<div>Core sessions</div>
                    </div>
                    <div>
                    	<label class="solve">Solve</label>
                        <div>Interactive conversations</div>
                    </div>
                    <div>
                    	<label class="make">Make</label>
                        <div>Workshops</div>
                    </div>
                </div>
            </div>
            <div class="right">
                <p><strong>ONA13 Guiding Principles</strong></p>
            	<p><strong>Engage</strong> with technology, the journalism community and each other.</p>
                <p><strong>Innovate</strong> ideas and approaches to challenges and creating compelling stories.</p>
                <p><strong>Inspire</strong> through conversations with dedicated professionals who remind us why we do what we do.</p>
            </div>
		<?php endif; ?>

<? $i = -1;
foreach( $all_sessions as $session_day => $days_sessions ):
	$day_full_name = date( 'l n.d', strtotime( $session_day ) );
	$i++;
	$day_slugify = sanitize_title( $day_full_name );
?>

<div id="session-day-<?php echo $day_slugify; ?>" class="session-day">
	<div class="sponsors">
    	<p>ONA13 is sponsored in part by:</p>
        <div class="logos">
            <div class="more">Your logo here</div>
            <div class="more">Your logo here</div>
            <div class="more">Your logo here</div>
        </div>
    </div>
    <div class="schedule_nav">
        <div>
            <label>Day 1</label>
            <div class="listen">L</div>
            <div class="solve">S</div>
            <div class="make">M</div>
        </div>
        <div>
            <label>Day 2</label>
            <div class="listen">L</div>
            <div class="solve">S</div>
            <div class="make">M</div>
        </div>
        <div>
            <label>Day 3</label>
            <div class="listen">L</div>
            <div class="solve">S</div>
            <div class="make">M</div>
        </div>
    </div>
    <h3 id="title<?=$i;?>"><span><?=$day_full_name;?></span></h3>
    
	<div class="day-sessions">
	<?php foreach( $days_sessions as $start_time => $posts ): ?>
		<div class="session-time-block">
			<div class="session-start-time"><?php echo $start_time; ?></div>			
			<ul class="session-list session-count-<?php echo count( $posts ); ?>">
			<?php foreach( $posts as $post ): ?>
				<?php setup_postdata( $post ); ?>
				<?php
					$session_details = array();
					//$session_types = get_the_terms( $post->ID, 'ona12_session_types' );
					if ( ! empty( $session_types ) ) {
						$session_type = array_shift( $session_types );
						$session_details[] = '<span class="session-type"><a href="' . get_term_link( $session_type ) . '">' . esc_html( $session_type->name ) . '</a></span>';
					}
					/* if ( $session_location = ONA_Session::get( 'location', get_the_ID(), 'object' ) )
						$session_details[] = '<span class="session-location"><a href="' . get_term_link( $session_location ) . '">' . esc_html( $session_location->name ) . '</a></span>';
					if ( $hashtag = ONA12_Session::get( 'hashtag' ) )
						$session_details[] = '<span class="session-hashtag"><a target="_blank" href="https://twitter.com/i/#!/search/?q=' . urlencode( $hashtag ) . '">' . $hashtag . '</a></span>'; */
				?>
                <a href="<?php the_permalink(); ?>">
				<li class="single-session">
					<h4 class="session-title"><?php the_title(); ?></h4>
					<ul class="session-details"><li><?php echo implode( '</li><li>', $session_details ); ?></li></ul>
					<div class="session-description"><?php the_excerpt(); ?></div>
				</li>
                </a>
			<?php endforeach; ?>
			</ul>
			<div class="clear-left"></div>
		</div>
	<?php endforeach; ?>
	</div>
</div>
<?php endforeach; ?>

	</div><!-- #posts -->
	</div><!-- #posts-container -->