<div class="content-header-left col-md-9 col-12 mb-2">
  <div class="row breadcrumbs-top">
    <div class="col-12">
      <h2 class="content-header-title float-start mb-0">{{ $config['titulo'] }}</h2>
      <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
          <?php foreach($config['breadcrumbs'] as $breadcrumb){ ?>
        		@if ( $breadcrumb['active'] )
        			<li class="breadcrumb-item active">{{{ $breadcrumb['text'] }}}</li>
        		@else
        			<li class="breadcrumb-item">
        				<a href="{{{ $breadcrumb['href'] }}}">{{{ $breadcrumb['text'] }}}</a>
        	    </li>
        		@endif
            <?php } ?>
        </ol>
      </div>
    </div>
  </div>
</div>
