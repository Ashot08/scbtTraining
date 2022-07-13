<?php wpm_render_partial('head', 'base', array('post' => null)) ?>
<?php mblp_render_partial('partials/js'); ?>
<?php wpm_render_partial('navbar') ?>
<div class="site-content mblp-site-content">
	<?php wpm_render_partial('header-cover'); ?>
	<?php mkk_render_partial('partials/breadcrumbs'); ?>
	
	<section class="lesson-row clearfix">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="lesson-tabs bordered-tabs white-tabs tabs-count-1">
						<!-- Tab panes -->
						<div class="tab-content">
							<div class="post">
								
								<?php
									$id = get_queried_object()->term_id;
									$meta = get_option("taxonomy_term_$id");
									$noAccessContent = wpautop(stripslashes($meta['no_access_content']));
									$noAccessContent = apply_filters('the_content', $noAccessContent);
									//echo $id;
								?>
								
								
								<div class="ps_content mbl-no-access">
									<?php echo $noAccessContent; ?>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
</div>
<?php wpm_render_partial('footer') ?>
<?php wpm_render_partial('footer-scripts') ?>

