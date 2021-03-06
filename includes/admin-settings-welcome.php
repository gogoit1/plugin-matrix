<div id="fl-welcome-form" class="fl-settings-form">

	<h3 class="fl-settings-form-header"><?php _e('Welcome to Tesseract Plus Plugin!', 'fl-builder'); ?></h3>

	<div class="fl-settings-form-content fl-welcome-page-content">

		<p><?php _e('Thank you for choosing Tesseract Plus Plugin and welcome to the colony! Find some helpful information below. Also, to the left are the Page Builder settings options.', 'fl-builder'); ?>

			<?php if (true === FL_BUILDER_LITE) : ?>
			<?php printf( __('For more time-saving features and access to our expert support team, <a href="%s" target="_blank">upgrade today</a>.', 'fl-builder'), FLBuilderModel::get_upgrade_url( array( 'utm_medium' => 'bb-lite', 'utm_source' => 'welcome-settings-page', 'utm_campaign' => 'settings-welcome-support' ) ) ); ?>
			<?php else: ?>
			<?php _e('Be sure to add your license key for access to updates and new features.', 'fl-builder'); ?>
			<?php endif; ?>

		</p>

		<h4><?php _e('Getting Started - Building your first page.', 'fl-builder'); ?></h4>

		<div class="fl-welcome-col-wrap">

			<div class="fl-welcome-col">

				<p><a href="<?php echo admin_url(); ?>post-new.php?post_type=page" class="fl-welcome-big-link"><?php _e('Pages → Add New', 'fl-builder'); ?></a></p>

				<p><?php _e('Ready to start building? Add a new page and jump into Tesseract Plus Plugin by clicking the Page Builder tab shown on the image.', 'fl-builder'); ?></p>

				<h4><?php _e('Join the Community', 'fl-builder'); ?></h4>

				<p><?php _e('There\'s a wonderful community of "Tesseract Plus Plugin" out there and we\'d love it if <em>you</em> joined us!', 'fl-builder'); ?></p>

			</div>

			<div class="fl-welcome-col">
				<img class="fl-welcome-img" src="<?php echo FL_BUILDER_URL; ?>img/screenshot-getting-started.jpg" alt="">
			</div>

		</div>

		<hr>

		<div class="fl-welcome-col-wrap">

			<div class="fl-welcome-col">

				<h4><?php _e('What\'s New in Tesseract Plus Plugin Gordon', 'fl-builder'); ?></h4>

				<p><?php _e('Tesseract Plus Plugin is out and it\'s has some epic new features:', 'fl-builder'); ?></p>

				<ul>
					<li><?php _e('16 new landing page templates are available in the template selector.', 'fl-builder'); ?></li>
					<li><?php _e('Overhauled Import/Export options and the ability to export single templates.', 'fl-builder'); ?></li>
					<li><?php _e('Hide rows and modules depending on whether a user is logged in or out.', 'fl-builder'); ?></li>
					<li><?php _e('Ability to expand settings panels.', 'fl-builder'); ?></li>
				</ul>

			</div>

			<div class="fl-welcome-col">

				<h4><?php _e('Need Some Help?', 'fl-builder');  ?></h4>

				<p><?php _e('We take pride in offering outstanding support.', 'fl-builder');  ?></p>

				<p><?php _e('The fastest way to find an answer to a question is to see if someone\'s already answered it!', 'fl-builder');  ?></p>

				<p><?php _e('For that, check our <a href="https://www.tesseracttheme.com/knowledge-base/" target="_blank">Knowledge Base</a>, <a href="https://www.tesseractthemecom/frequently-asked-questions/" target="_blank">FAQ page</a>, or search our legacy <a href="http://www.tesseracttheme.com/support/" target="_blank">support forum.</a>', 'fl-builder');  ?></p>

				<?php if (true === FL_BUILDER_LITE) : ?>
				<p><?php printf( __('If you can\'t find an answer, consider upgrading to a premium version of Tesseract Plus Plugin. Our expert support team is waiting to answer your questions and help you build your website. <a href="%s" target="_blank">Learn More</a>.', 'fl-builder'), FLBuilderModel::get_upgrade_url( array( 'utm_medium' => 'bb-lite', 'utm_source' => 'welcome-settings-page', 'utm_campaign' => 'settings-welcome-support' ) ) ); ?></p>
				<?php else: ?>
				<p><?php _e('If you can\'t find an answer, feel free to <a href="https://www.tesseracttheme.com/" target="_blank">send us a message with your question.</a>', 'fl-builder'); ?></p>
				<?php endif; ?>
			</div>

		</div>

	</div>
</div>
