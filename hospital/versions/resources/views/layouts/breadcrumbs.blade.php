 
<ol class="breadcrumb">
	<?php foreach($breadcrumbs as $breadcrumb){ ?>

		@if ( $breadcrumb['active'] )
			<li class="active" >
	        	{{{ $breadcrumb['text'] }}}
	        </li>
		@else
			<li>
				<a href="{{{ $breadcrumb['href'] }}}">{{{ $breadcrumb['text'] }}}</a>
	        </li>
		@endif

    <?php } ?>
</ol>


 