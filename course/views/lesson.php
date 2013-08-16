<div class="row-fluid">
	<h2><?php echo $lesson['title']; ?></h2>
	<p><?php echo $lesson['description']; ?></p>
</div> 
<div class="row-fluid">
<?php if(is_array($articles)):
	foreach($articles as $key => $article):
 ?>
<div class="media">
  <div class="media-body">
  <h4 class="media-heading">
  	<?php
  		if($article['type'] == 'article')
  		{
  			$link = site_url('courses/article/'.$article['slug']);
  			$target = '_self';
  		}
  		else{
  			$link = $article['redirect'];
  			$target = '_blank';
  		}
  	?>
		<a href="<?php echo $link; ?>" target="<?php echo $target; ?>"><?php echo '<span class="badge">'.($key + 1).'</span> ' . $article['title']; ?></a>
	</h4>

  <div class="col-lg-2">
  <br />
   <?php echo strtoupper($article['type']); ?>
  </div>
  <div class="col-lg-10">
    <?php echo $article['description']; ?>
  </div>
</div>

<?php 
endforeach;
endif; ?>
</div>