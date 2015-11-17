<div class="blue">
    <div class="container">
	<h3 class="local_directory_search cntr">Local Business Directory Search</h3>
	
	    <?php //include_component('directory','advancedSearch') ?>

    </div>
</div>

<div class="site_content">
    <?php partial('directory','list', array('businesses' => $businesses, 'pager' => $pager, 'path' => $path)) ?>
</div>


<div class="container">
    <div class="row">
	<div class="col-md-1 cta-icon">
	    <button class="explore-icon" role="button">Explore Icon</button>
	</div>
	<div class="col-md-6">
	    <h3 class="blue-text">Questions? Comments? More Information?</h3>
	    <p>Great. Discover what's new or get in touch with us today.</p>
	</div>
	<div style="margin-top: 25px;">
	    <div class="col-md-2 col-md-offset-1">
		<p><a class="btn btn-primary btn-block btn-lg" href="/contact_us" role="button" onClick="_gaq.push(['_trackEvent', 'CTA', 'Click', 'Learn More']);">Learn more</a></p>
	    </div>
	    <div class="col-md-2">
		<p><a class="btn btn-primary btn-block btn-lg" href="/contact_us" role="button" onClick="_gaq.push(['_trackEvent', 'CTA', 'Click', 'Contact Me']);">Contact Me</a></p>
	    </div>
	</div>
    </div>
</div>