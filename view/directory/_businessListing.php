  <?php $spotlight = $business->getSpotlight() ?>
  <?php $website = $business->getSite() ?>

    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="spotlight-inner">
	<div class="row side-padding-15">
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> <!-- IMAGE -->
	    <a onClick="_gaq.push(['_trackEvent', 'Directory', 'Click', 'Listing - Linked via Logo']);" href="<?php echo $business->getPrimaryWebsite() ?>">
	      <?php $imagePath = THUMBNAIL_PATH.'/'.$business->logo ?>
	      <?php  if (!file_exists($imagePath) || trim($business->logo) == ''): ?>
		<?php $imagePath = '/images/logo.png' ?>
	      <?php endif ?>
	      <img class="business-thumbnail" alt="<?php echo $business->name ?> logo" src="<?php echo ewUtils::get_base_url() . str_replace(BASE_PATH . '/web','',$imagePath) ?>" />
	    </a>
	  </div>
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> <!-- ICONS -->
	    <div class="bottom-5">
	      <a href="/browse/map/<?php echo $business->id ?>"><button class="map-button-icon" role="button" onClick="_gaq.push(['_trackEvent', 'Directory', 'Click', 'Listing - View Map Button']);">View Map</button></a>
	      <?php if ($spotlight && $spotlight->isLive()): ?>
		<a <?php include_component('directory','getUrl', array('website' => $spotlight)) ?>><button class="spotlight-button-icon" role="button" onClick="_gaq.push(['_trackEvent', 'Directory', 'Click', 'Listing - Spotlight Button']);">Spotlight Page</button></a>
	      <?php endif ?>
	      <?php if ($website && $website->isLive()): ?>
		<a <?php include_component('directory','getUrl', array('website' => $website)) ?>><button class="web-button-icon" role="button" onClick="_gaq.push(['_trackEvent', 'Directory', 'Click', 'Listing - Website Button']);">Website</button></a>
	      <?php endif ?>
	    </div>
	    <?php $addresses = $business->getAddresses() ?> <!-- ADDRESS & PHONE -->
	    <p><strong><span style="color: #2b7aaa;"><?php echo $business->city . '</span></strong><br />' . $business->phone ?><br /><?php if (count($addresses) > 0) {echo $addresses[0]->city . '<br />' . $addresses[0]->phone;} ?></p>
	  </div>
	</div> <!-- END ROW -->
	<div class="row side-padding-15">
	  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <!-- DESCRIPTION -->
	    <h2 style="margin-top: 25px;"><?php echo $business->name ?></h2>
	    <?php $description = $business->description ?>
      <p class="bottom-0"><?php echo ewUtils::shorten_text($description,120) ?><br /><a style="cursor: pointer;" data-toggle="modal" data-target="#moreInfo-<?php echo $business->id ?>" onClick="_gaq.push(['_trackEvent', 'Directory', 'Click', 'Read More - Modal Trigger']);">Read more...</a></p> 
	  </div>
	  <div class="clearfix"></div>
	</div> <!-- END ROW -->
      </div>
    </div>

    <div class="modal fade" id="moreInfo-<?php echo $business->id ?>" tabindex="-1" role="dialog" aria-labelledby="moreInfoLabel" aria-hidden="true">
      <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="_gaq.push(['_trackEvent', 'Directory', 'Click', 'Modal - Top Close Button']);">&times;</button>
	    <h4 class="modal-title" id="moreInfoLabel"><?php echo $business->name ?></h4>
	  </div>
	  <div class="modal-body">
	    <div id="<?php echo $business->id ?>">
	      <div class="spotlight_image">
		<a onClick="_gaq.push(['_trackEvent', 'Directory', 'Click', 'Modal - Linked via Logo']);" <?php echo $business->getPrimaryWebsite() ?>>
		  <?php $imagePath = THUMBNAIL_PATH.'/'.$business->logo ?>
		  <?php  if (!file_exists($imagePath) || trim($business->logo) == ''): ?>
		    <?php $imagePath = '/images/logo.png' ?>
		  <?php endif ?>
		  <img class="bottom-35" alt="<?php echo $business->name ?> logo" src="<?php echo str_replace(BASE_PATH . '/web','',$imagePath) ?>" />
		</a>
	      </div>
	      <div>
		<h2><?php echo $business->name ?></h2>
		<p class="bottom-35"><?php echo $business->description ?></p>
	      </div>
	      <div class="bottom-35">
		<a href="/browse/map/<?php echo $business->id ?>"><button class="map-button-icon" role="button" onClick="_gaq.push(['_trackEvent', 'Directory', 'Click', 'Modal - View Map Button']);">View Map</button></a>
		<?php if ($spotlight && $spotlight->isLive()): ?>
		  <a <?php include_component('directory','getUrl', array('website' => $spotlight)) ?>><button class="spotlight-button-icon" role="button" onClick="_gaq.push(['_trackEvent', 'Directory', 'Click', 'Modal - Spotlight Button']);">Spotlight Page</button></a>
		<?php endif ?>
		<?php if ($website && $website->isLive()): ?>
		  <a <?php include_component('directory','getUrl', array('website' => $website)) ?>><button class="web-button-icon" role="button" onClick="_gaq.push(['_trackEvent', 'Directory', 'Click', 'Modal - Website Button']);">Website</button></a>
		<?php endif ?>
	      </div>
	      <div>
		<h3>Categories</h3>
		<p>
		  <?php foreach ($business->getCategories() as $i => $category): ?>
		  <a href="/browse/<?php echo $category->slug ?>/-/-"><?php echo $category->name ?></a><br />
		  <?php endforeach ?><br />
		</p>
		<h3>Counties</h3>
		<p>
		  <?php foreach ($business->getCounties() as $i => $county): ?>
		  <a href="/browse/-/<?php echo ewUtils::slugify($county->name) ?>/-"><?php echo $county->name ?></a>
		  <?php endforeach ?><br />
		</p>
	      </div>
	    </div>
	  </div> <!-- END ".modal-body" -->
	  <div class="modal-footer">
	    <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="_gaq.push(['_trackEvent', 'Directory', 'Click', 'Modal - Bottom Close Button']);">Close</button>
	  </div>
	</div>
      </div>
    </div>
