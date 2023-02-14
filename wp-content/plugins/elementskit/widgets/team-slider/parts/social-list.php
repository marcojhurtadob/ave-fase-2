<div class="profile-footer">
	<ul class="ekit-team-social-list">
		<?php 
		for ($i=0;$i<5;$i++) : 
			if(!empty($ekit_team_member['link_'.$i]['url'])) {
				$this->add_link_attributes( 'social_link_'.$i.$index, $ekit_team_member['link_'.$i] ); 
			}

			if(!empty($ekit_team_member['icon_'.$i]['value'])) : ?>
				<li>
					<a <?php $this->print_render_attribute_string('social_link_'.$i.$index); ?>>
						<?php \Elementor\Icons_Manager::render_icon( $ekit_team_member['icon_'.$i], [ 'aria-hidden' => 'true' ] ); ?>
					</a>
				</li>			
			<?php endif;
		endfor; ?>
	</ul>
</div>
