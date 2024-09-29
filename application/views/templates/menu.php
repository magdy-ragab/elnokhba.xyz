<?php foreach ($this->core_model->menu(["parent_id"=>$parent_id]) as $menu) { ?>
	<li>
		<a href="<?php echo str_replace("**",base_url(),$menu->url);?>">
			<?php if ( !isset($get_subs) )  {
				if ( $menu->has_subs =='Y'){
					echo '<span class="fa fa-chevron-down"></span>';
				}
			}?>
			<?=$menu->title ?>
		</a>
		<?php
		if ( !isset($get_subs) )  {
			if ( $menu->has_subs === 'Y' && $menu->parent_id == 0) {
				echo '<ul>';
				$this->load->view("templates/menu", ["parent_id"=>$menu->ID]);
				echo '</ul>';
			}
		}?>
	</li>
<?php }
?>