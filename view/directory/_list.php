<div class="container">
  <div class="row"> 
 
  <?php $i = 0 ?>
  <?php foreach ($businesses as $i => $business): ?>
  <?php $idx = $i ?>
  
   <?php partial('directory','businessListing',array('business' => $business)) ?>

  <?php $i++ ?>
  <?php endforeach ?>
  <?php if ($i==0): ?>
    <h2 style="padding:10px;">Your search returned no results</h2>
  <?php endif ?>
  
  </div> <!-- END ROW -->
  
  
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php if ($pager->needsPagination()): ?>
      <div class="pagination">
	<ul class="pagination">
	  <li><a href="<?php echo $path ?>page=1">|&laquo;</a></li>
	  <li><a href="<?php echo $path ?>page=<?php echo $pager->getPreviousPage() ?>">&laquo;</a></li>
	  <?php foreach ($pager->getPages() as $page): ?>
	    <?php if ($page == $pager->page): ?>
	      <li class="active"><a href="#"><?php echo $page ?></a></li>
	      <?php else: ?>
	      <li><a href="<?php echo $path ?><?php echo $page ?>"><?php echo $page ?></a></li>
	    <?php endif; ?>
	  <?php endforeach; ?>
	  <li><a href="<?php echo $path ?><?php echo $pager->getNextPage() ?>">&raquo;</a></li>
	  <li><a href="<?php echo $path ?><?php echo $pager->getLastPage() ?>">&raquo;|</a></li>
	</ul>
      </div>
    <?php endif; ?>
    </div>
  </div> <!-- END ROW -->
</div> <!-- END CONTAINER -->
  