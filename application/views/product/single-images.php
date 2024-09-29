<?php $pics= [];
$pics[]= '{src  : "'.$single['pic_path'].'"}' ;?><div id="product-image" class="product-image">
	<div class="product-image-inner">
		<div class="slider-main-image">
			<div class="slick-list draggable">
				<div class="slick-track">
					<div class="slick-slide slick-current slick-active" data-slick-index="0"
						aria-hidden="false">
						<div>
							<div class="slick-item slick-zoom">
								<div class="prod-zoom openFancyBtn" href="<?= $single['pic_path'] ?>"
									tabindex="0">
									<img class="image-zoom" src="<?= $sinlge['thumnail_path'] ?>" alt="<?= $single['title'] ?>">
								</div>
							</div>
						</div>
					</div>
					<?php
					$i = 0;
					if (isset($single['pics']) && count($single['pics'])) {
						foreach ($single['pics'] as $pic) {
							$i++; ?>
							<div class="slick-slide" data-slick-index="<?= $i ?>" aria-hidden="true">
								<div>
									<div class="slick-item slick-zoom">
										<div class="prod-zoom openFancyBtn" href="<?= $pic['pic_path'] ?>"
											tabindex="-1">
											<img class="image-zoom" src="<?= $pic['thumbnail_path'] ?>"
												alt="<?= $single['title'] ?>">
										</div>
									</div>
								</div>
							</div>
					<?php }
					} ?>
				</div>
			</div>
		</div>
		<div class="slick-btn-03">
			<span class="btn-prev slick-arrow"></span>
			<span class="btn-next slick-arrow"></span>
		</div>
	</div>
	<div class="slider-thumbs-03 slick-initialized slick-slider">
		<div class="slick-list draggable">
			<div class="slick-track">
				<div class="slick-slide" data-slick-index="0" aria-hidden="false">
					<div>
						<div class="slick-item openFancyBtn">
						<div href="<?= $pic['pic_path'] ?>" rel="gallery1">
							<img src="<?= $single['pic_path'] ?>" alt="<?= $single['title'] ?>" rel="gallery2">
						</div>
						</div>
					</div>
				</div>
				<?php
				$i = 0;
				if (isset($single['pics']) && count($single['pics'])) {
					foreach ($single['pics'] as $pic) {
						$pics[]= '{src  : "'.$pic['pic_path'].'"}' ;
						$i++; ?>
						<div class="slick-slide small-thumbs openFancyBtn" data-slick-index="<?= $i?>" aria-hidden="false">
							<div>
								<div class="slick-item">
									<div href="<?= $pic['pic_path'] ?>" rel="gallery1">
										<img src="<?= $pic['pic_path'] ?>" alt="<?= $single['title'] ?>"  rel="gallery2">
									</div>
								</div>
							</div>
						</div>
				<?php }
				} ?>
			</div>
		</div>
	</div>
</div>


<script>
	function openFancy () {
			$.fancybox.open([<?=implode(",", $pics)?>], {
			loop : true
		});

	}
    jQuery(document).ready(function($) {
      if($('.alert-pre-order').hasClass('success')){
        $('.pre-order-success').removeClass('hide');
      }
    });

		$( ".openFancyBtn" ) . click ( function () {
			openFancy();
			return false;
		});


  </script>
