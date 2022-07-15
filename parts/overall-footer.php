<?php
$copy = get_field('copy', 'options');
?>

<footer class="site-footer">
    <div class="container">
		<?php if($copy) : ?>
			<p><?php echo $copy; ?></p>
		<?php endif; ?>
    </div>
</footer>
</div><?php // end mm-page ?>