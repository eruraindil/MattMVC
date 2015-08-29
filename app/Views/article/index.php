<h2><small><?php echo $data["article"]->getTimestampPrecise();?></small></h2>
<?php echo $data["article"]->getBody();?>
<hr>
<div class="well container-fluid">
  <div class="row">
    <div class="col-sm-9">
      <p><?php echo $data["article"]->getAuthorObj()->getBio();?></p>
    </div>
    <div class="col-sm-3 text-center">
      <img src="<?php echo $data["article"]->getAuthorObj()->viewImage();?>" class="img-rounded">
    </div>
  </div>
</div>
