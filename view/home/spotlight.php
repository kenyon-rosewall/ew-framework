<!-- SLOTS -->

<div class="blue">
    <div class="container">
	<h3 class="local_directory_search cntr">Local Business Directory Search</h3>
	<?php if ($_SERVER['REQUEST_URI'] == '/'): ?>
	<div id="filter"></div>
	<script type="text/javascript">
	    $("#filter").html("<div style='text-align: center;'><span style='color: #fff; text-transform: uppercase;'>Loading...</span>&nbsp;&nbsp;<img style='height:19px;width:auto;position:relative;top:-4px;' src='/images/loader_bar.gif' /></div>");
	    x = $.ajax({
		url: "/ajax/getAdvancedSearch",
		type: "GET",
		dataType: "html",
		success: function(a,b,c){
		    $("#filter").html(a);
		},
		error: function(a,b,c){
		//alert(a+' '+b+' '+c);
		}
	    });
	</script>
	<?php else: ?>
	    <!-- PARTIALS AND COMPONENTS -->
	<?php endif ?>
    </div>
</div>

<div class="container products">
    <div class="row">
	<div class="col-md-3 cntr">
	    <a href="/spotlight-page" onClick="_gaq.push(['_trackEvent', 'Product Link', 'Click', 'Spotlight Pages']);">
		<button class="spotlight-icon">Spotlight Page Icon</button>
		<h3>Spotlight Pages</h3>
		<p>A cost effective, simple, and easy way to highlight your business and drive traffic right to your front door.</p>
	    </a>
	</div>
	<div class="col-md-3 cntr">
	    <a href="/website-design" onClick="_gaq.push(['_trackEvent', 'Product Link', 'Click', 'Custom Web Design']);">
		<button class="web-icon">Web Design Icon</button>
		<h3>Custom Web Design</h3>
		<p>Award winning design for your business that's easy to edit, mobile friendly, and created just for you.</p>
	    </a>
	</div>
	<div class="col-md-3 cntr">
	    <a href="/e-commerce" onClick="_gaq.push(['_trackEvent', 'Product Link', 'Click', 'E-Commerce']);">
		<button class="ecom-icon">E-Commerce Icon</button>
		<h3>E-Commerce</h3>
		<p>Reach your customers on their terms with robust and reliable online shopping tools that are fun and easy.</p>
	    </a>
	</div>
	<div class="col-md-3 cntr">
	    <a href="#" onClick="_gaq.push(['_trackEvent', 'Product Link', 'Click', 'Managed Solutions']);">
		<button class="managed-icon">Managed Solution Icon</button>
		<h3>Managed Solutions</h3>
		<p>The pinnacle of effective online marketing and strategy.<br />Is coming soon.</p>
		<!--p>The pinnacle of effective online marketing and strategy. Fully managed solutions designed to get results.</p-->
	    </a>
	</div>
    </div>
</div>

<div class="site_content">
    <div class="container">
	<div class="row bottom-45">
	    <div class="col-lg-6 col-lg-push-6 col-md-6 col-md-push-6 col-sm-12 col-xs-12">
		<h1>Spotlight Pages</h1>
		<p><strong>Spotlight pages are a simple, easy, and affordable way Explore Wisconsin can highlight your business.</strong></p>
		<p>These are cost effective and personal 1 page sites that are a perfect starting point for a web presence but also work as an additional resource beyond your website for consumers to find you as well.</p>
		<p>We've found these pages to be great for weary first-time internet users who still want to reap all of the benefits of the web- the world's largest business listing! For Explore customers who want that extra boost in search recognition, spotlight pages are like an extra vote for your site, basically doubling the likelihood of visitors. Just like our websites, these pages are personalized to feature your business needs with maps, contact info, and product listings. From beginner to expert, a spotlight page is something all customers can value from.</p>
	    </div>
	    <div class="col-lg-6 col-lg-pull-6 col-md-6 col-md-pull-6 col-sm-12 col-xs-12">
		<img style="padding-top: 40px;" class="img-responsive margin-rl-auto" src="/images2/map-search.jpg" />
	    </div>
	</div>
	<hr />
	<div class="row">
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<blockquote class="bottom-45">
		    <h3>The "Good Old Days" are gone</h3>
		    <p>Not that long ago Search Engine Optimization (SEO) used to be a matter of creating your content, selecting some good keywords, and then you'd set it and forget it. Sadly those days are gone, and today search engines like Google<sup>&reg;</sup>, Bing<sup>&reg;</sup>, Yahoo<sup>&reg;</sup> and others expect new and constantly changing dynamic content paired with engaging social media integration, blogging and more..</p>
		</blockquote>
		<h2>Search Engine Optimization</h2>
		<img class="img-responsive img-float-right" src="/images2/seo.jpg" />
		<p>SEO stands for "Search Engine Optimization", and it's the process of creating and organizing content, descriptions, keywords, and more on your site so when someone is searching for something your site comes up in the search results, and hopefully they click on it.</p>
		<p>It's obviously a little more complicated and gets more so everyday, but Explore Wisconsin has over 14 years of experience navigating the constantly changing waters of SEO and its best practices.</p>
		<p>Combining solid keyword research with good regularly updated content and a sustainable social media strategy can help your website work it's way toward page one. We can help you develop a strategy and schedule that if held to will provide your site and business with the quality content and increased exposure required today to be considered relevant by the major search engines.</p>
		<p><strong>It is more work than it used to be, and requires far more commitment on your part, but the rewards of being on the front page are also much more than they used to be.</strong></p>
	    </div>
	</div>
    </div>
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