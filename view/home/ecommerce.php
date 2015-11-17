
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
	    <!-- NEED TO IMPLEMENT COMPONENTS AND PARTIALS -->
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
		<h1>E-Commerce</h1>
		<p><strong>E-commerce sites have changed the way we shop. Businesses can be open 24 hours a day with no geographic limitations.</strong></p>
		<p>Anyone can make a purchase - even from home in their pajamas. It is also possible for almost anyone to create a website; but true value comes in professional design, accessibility, and-most important for a consumer- credibility. Visitors who buy a product want to feel sure they can trust a site that they give personal information to. At Explore Wisconsin we understand this concern and the increasing potential of e-commerce for all small businesses. </p>
		<p>When your business provides customers a trusted source for products larger retailers who might otherwise get business with their stores lose. It's a win-win! Our e-commerce experience is extensive. Features like social media platforms are essential and are infinite- especially in non-physical products like classes and tours. It's up you- the possibilities are endless, and we promise we've got the potential to help you reap great rewards.</p>
	    </div>
	    <div class="col-lg-6 col-lg-pull-6 col-md-6 col-md-pull-6 col-sm-12 col-xs-12">
		<img class="img-responsive margin-rl-auto" style="padding-top: 29px;" src="/images2/shopping.jpg" />
	    </div>
	</div>
	<hr />
	<div class="row">
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h2>E-Commerce Online Shopping</h2>
		<p>While some might argue that there is no replacement for going out to a store and physically holding a product in your hand before buying it, those same people generally acknowledge that they started the research for that product online.</p>
		<blockquote>
		    <h3>Online sales are predicted to increase by 62% over the next few years</h3>
		    <p>As of 2011 202 billion dollars worth of goods and services are exchanged online and that number is expected to rise to 327 billion by 2016.</p>
		</blockquote>
		<img class="img-responsive img-float-right" src="/images2/money.jpg" />
		<p>The major difference between a regular website and an e-commerce site is the ability to buy products on the e-commerce site. Otherwise for the most part they function the same. Both types of sites have a secure backend you can log into and update information. Both allow you to easily add pictures, graphics, and other style elements. So what's the difference and why is an e-commerce site more?</p>
		<p>The major difference is in the backend and how it handles products, categories, and security. Anytime credit card and bank account information are involved there needs to be an extra layer of security to insure that everyones information remains safe and secure.</p>
		<p>Some of the other differences are in the experience. An E-Commerce platform makes it a lot easier to add catagories and products, and has a whole suite of tools to manage your sales, inventory, and customers. These tools are secure and specific to online shopping, so you wouldn't find them in a regular web package.</p>
		<p>If you're looking to sell your products or services online <strong>an E-Commerce package is the right tool for the job</strong></p>
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
	    <p>Great. Discover what's new or to get in touch with us today.</p>
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