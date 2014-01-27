<?php
class G7_Twitter_Widget extends G7_Widget {

	function __construct() {

		$this->widget = array(
			'id_base' => 'g7_twitter',
			'name' => G7_NAME . ' - Twitter',
			'description' => __('Latest twitter updates', 'g7theme')
		);

		parent::__construct();
	}

	function set_fields() {
		$fields = array(
			'title' => array(
				'type' => 'text',
				'label' => __('Title', 'g7theme'),
				'std' => __('Latest Tweets', 'g7theme')
			),
			'screen_name' => array(
				'type' => 'text',
				'label' => 'Twitter ID',
				'std' => ''
			),
			'count' => array(
				'type' => 'text',
				'label' => __('Number of updates', 'g7theme'),
				'std' => 2,
				'attributes' => 'size="3"'
			),
			'follow_text' => array(
				'type' => 'text',
				'label' => __('Follow text', 'g7theme'),
				'std' => __('Follow us on Twitter', 'g7theme')
			)
		);
		$this->fields = $fields;
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;

		$title = apply_filters('widget_title', $instance['title']);
		if ( ! empty($title)) {
			echo $before_title . $title . $after_title;
		}

		$username = $instance['screen_name'];
		$number = $instance['count'];

		$transient_name = "twitter_{$username}_{$number}";
		$cache_time = 10;

		if ( ! empty($username)) {
			if (false === ($tweets = get_transient($transient_name))) {
				//$response = wp_remote_get("http://api.twitter.com/1/statuses/user_timeline/{$username}.json?count={$number}");
				$response = wp_remote_get("https://api.twitter.com/1/statuses/user_timeline.json?screen_name={$username}&count={$number}");
				if ( !is_wp_error($response)) {
					$tweets = json_decode($response['body']);
					set_transient($transient_name, $tweets, 60 * $cache_time);
				}
			}
			?>

			<?php if (!empty($tweets) && empty($tweets->error)) : ?>

				<ul>
					<?php
					foreach ($tweets as $tweet) :
					$time = strtotime($tweet->created_at);
					$human_time = human_time_diff($time);
					$tweet_link = "http://twitter.com/{$username}/statuses/{$tweet->id_str}";
					?>
					<li>
						<?php echo $this->twitter_content($tweet->text); ?>
						<span class="date"><a href="<?php echo $tweet_link; ?>"><?php echo $human_time; ?> <?php _e('ago', 'g7theme'); ?></a></span>
					</li>
					<?php endforeach; ?>
				</ul>

			<?php else : ?>

				<ul id="twitter_update_list">
					<li><?php _e('Twitter feed loading...', 'g7theme'); ?></li>
				</ul>
				<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
				<script type="text/javascript" src="https://api.twitter.com/1/statuses/user_timeline/<?php echo $username; ?>.json?callback=twitterCallback2&amp;count=<?php echo $number; ?>"></script>

			<?php endif; ?>

			<?php if ( ! empty($instance['follow_text'])) : ?>
			<a class="follow-us" href="http://twitter.com/<?php echo $username; ?>">
				<?php echo $instance['follow_text']; ?>
			</a>
			<?php endif; ?>

			<?php
		}

		echo $after_widget;
	}

	function twitter_content($content) {
		//create general link
		$content = make_clickable($content);

		//create link for @username
		$content = preg_replace("/[@]+([A-Za-z0-9-_]+)/", "<a href=\"http://twitter.com/\\1\">\\0</a>", $content);

		//create link for #hashtag
		$content = preg_replace("/[#]+([A-Za-z0-9-_]+)/", "<a href=\"http://twitter.com/search?q=%23\\1\">\\0</a>", $content);

		return $content;
	}

}
