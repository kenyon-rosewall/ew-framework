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
	    <!-- GET COMPONENTS AND PARTIALS WORKING -->
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
		<h1>Custom Website Design</h1>
		<p><strong>'Small Business' doesn't mean small practice, and today's consumer demands a quality web presence. Explore Wisconsin has you covered.</strong></p>
		<p>Explore Wisconsin can develop an engaging web presence that will maintain your business's feel and your values; the pieces that make you... YOU! There may be millions of sites selling similar products but our skilled team of designers will position your site to be at the top of the search engine, not on page 5 or 6. We listen to your business's story and make it more than text and pictures on a page. We'll create an extension of YOU, a website compatible in mobile and tablet formats so your customers always have access to YOU. It's our mission to create a site that you'll absolutely love the look of and also one that's simple enough that YOU can edit it yourself. We're always here to help, but we want you in the driver's seat.</p>
	    </div>
	    <div class="col-lg-6 col-lg-pull-6 col-md-6 col-md-pull-6 col-sm-12 col-xs-12">
		<img class="img-responsive margin-rl-auto" src="/images2/mobile-web.jpg" />
	    </div>
	</div>
	<hr />
	<div class="row bottom-45">
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h2>Professional Web Design</h2>
		<p>Today more than ever people have access to and use the internet for pretty much everything. That includes looking up and researching their next purchases, vacations, local services, and much much more. So what happens when someone is searching and finds you? They'll land on your website, and this might be their very first interaction with you or your business. What does your website say about you? Is it professional? Does it build confidence in your business? These are important questions and can dramatically effect how successful your business is online.</p>
		<blockquote>
		    <h3>78% of Internet users conduct product research online.</h3>
		    <p>This means that there's a good chance that your website will be your visitors "First Impression".</p>
		</blockquote>
		<img class="img-responsive img-float-right" src="/images2/webdesign.jpg" />
		<p>We all see the ads; "Free Website", "Websites Starting at $9.95/mo.", etc... So why on earth would you pay for professional web design?   The answer is actually pretty simple. In this business you really do get what you pay for. All of these free sites show you pictures of beautiful templates and get you imagining how amazing your new site is going to look. But the reality is these sites are all simple templates with high-end, handpicked stock photography, and perfectly sized blocks of text. Strip away the pictures, and the text and you're left with empty boxes to fill with your own content. Now unless you're a writer, a web designer, and have a professional photographer on hand you have quite an uphill climb to get your new site back to looking like the flashy floor model that originally caught your eye.</p>
		<p>Now to make the case for Professional Web Design (and yes, we're biased). When you hire a professional web designer we spend some time talking with you trying to determine your goals and what value you'd like to get out of a new or redesigned site. We then take that information and craft a totally custom website for you with beautiful hand picked images and make sure everything looks perfect and fits with your vision. Every piece is hand tailored to look good, and all components right down to the code are perfectly structured for good "Search Engine Optimization".</p>
		<p><strong>It's all the little things, and attention to detail that add up to a good successful website.  That's the value of professional design.</strong></p>
	    </div>
	</div>
	<hr />
	<div class="row">
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h2>Mobile Web</h2>
		<p>Today your website visitors are scattered all over the globe connecting to you online with everything from a traditional desktop computer to tablets, smartphones and everything in between. Providing them with information that tailors itself to whatever device they're using at the time creates a more engaging and easier to use web product resulting in better exposure and more sales for your business.</p>
		<img class="img-responsive img-float-left" src="/images2/phones.jpg" />
		<blockquote>
		    <p class="blue-text">If you've never heard of mobile web design before, or maybe you have but just didn't know what all the "hype" was about, let us explain.</p>
		</blockquote>
		<p>Mobile web design is a method of designing a website so that the information will "reconfigure" itself on the screen depending on how large the screen is. This offers the visitor a comfortable viewing experience that doesn't require any zooming in to see tiny text.</p>
		<p>By designing a site in this manner you are putting your visitors experience first, and building trust and credibility in your business. Smartphones and tablets are different than full computers. They aren't as powerful, they have smaller screens, and their online connection isn't as fast. So why would you want to serve them the same website? The fact is you wouldn't.</p>
		<p>Building a mobile friendly website allows all of your visitors to experience your website in the best way possible no matter what is in their hand. The pages load faster, the content is easier to read, and the pictures are the right size. Allowing your visitor to find the information they need on their terms. <strong>Give your site the competitive edge and update to, or take advantage of this amazing new technology today, and put your site right in your customer's hands.</strong></p>
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