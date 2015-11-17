<div class="blue">
    <div class="container">
	<h3 class="local_directory_search cntr">Local Business Directory Search</h3>
	
	    <?php //include_component('directory','advancedSearch') ?>

    </div>
</div>

<div class="site_content">
    <div class="container">
	<div class="row">
	    <?php if (isset($spellResults)) :?>
		<?php //include_partial('directory/searchList', array('searchResults' => $searchResults, 'spellResults' => $spellResults)) ?>
		<?php else: ?>
		<?php //include_partial('directory/searchList', array('searchResults' => $searchResults, 'spellResults' => null)) ?>
	    <?php endif ?>
	</div>
    </div>
</div>
<div class="clearfix"></div>