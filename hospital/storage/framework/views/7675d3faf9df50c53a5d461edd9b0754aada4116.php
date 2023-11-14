 
<ol class="breadcrumb">
	<?php foreach($breadcrumbs as $breadcrumb){ ?>

		<?php if( $breadcrumb['active'] ): ?>
			<li class="active" >
	        	<?php echo e($breadcrumb['text']); ?>

	        </li>
		<?php else: ?>
			<li>
				<a href="<?php echo e($breadcrumb['href']); ?>"><?php echo e($breadcrumb['text']); ?></a>
	        </li>
		<?php endif; ?>

    <?php } ?>
</ol>


 