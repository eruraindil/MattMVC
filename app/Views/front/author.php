<?php
use MattMVC\Helpers\DateTime;
?>
<!--/stories-->
<?php if(count($data["articles"])>0):?>
  <?php foreach($data["articles"] as $article):?>
    <div class="row">
      <br>
      <div class="col-md-9 col-sm-12">
        <h3>
          <a href="/article/<?php echo $article->getId();?>">
            <?php echo $article->getTitle();?>
          </a>
        </h3>
        <div class="row">
          <div class="col-xs-12">
            <p>
              <?php echo $article->viewTeaser();?>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-9">
            <h4>
              <a href="http://<?php echo $article->getAuthorObj()->getWebsite();?>">
                <span class="label label-default">
                  <?php echo $article->getAuthorObj()->getWebsite();?>
                </span>
              </a>
            </h4>
            <h4>
              <small style="font-family:courier,'new courier';" class="text-muted">
                <span title="<?php echo $article->getTimeStampPrecise();?>">
                  <?php echo $article->getTimestampGeneral();?>
                </span>
                &middot;
                <a href="/article/<?php echo $article->getId();?>" class="text-muted">Read More</a>
              </small>
            </h4>
          </div>
          <div class="col-xs-3"></div>
        </div>
        <br><br>
      </div>
      <div class="col-md-3 col-sm-12">
        <div class="well">
          <div class="row">
            <div class="col-md-12 col-md-push-0 col-sm-4 col-sm-push-8 text-center">
              <img src="<?php echo $article->getAuthorObj()->viewImage();?>" class="img-rounded">
            </div>
            <div class="col-md-12 col-md-pull-0 col-sm-8 col-sm-pull-4">
              <p><?php echo $article->getAuthorObj()->getBio();?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>
  <?php endforeach;?>
<?php else:?>
  <p>No posts found</p>
<?php endif;?>
<!--<div class="row">
  <br>
  <div class="col-md-2 col-sm-3 text-center">
    <a class="story-title" href="#"><img alt="" src="http://api.randomuser.me/portraits/thumb/women/56.jpg" style="width:100px;height:100px" class="img-circle"></a>
  </div>
  <div class="col-md-10 col-sm-9">
    <h3>14 Useful Sites for Designers</h3>
    <div class="row">
      <div class="col-xs-9">
        <h4><span class="label label-default">devgarage.com</span></h4><h4>
        <small style="font-family:courier,'new courier';" class="text-muted">Yesterday • <a href="#" class="text-muted">Read More</a></small>
        </h4></div>
      <div class="col-xs-3"></div>
    </div>
    <br><br>
  </div>
</div>
<hr>

<div class="row">
  <br>
  <div class="col-md-2 col-sm-3 text-center">
    <a class="story-title" href="#"><img alt="" src="http://api.randomuser.me/portraits/thumb/men/29.jpg" style="width:100px;height:100px" class="img-circle"></a>
  </div>
  <div class="col-md-10 col-sm-9">
    <h3>Measuring Your Link Building with Google Analytics</h3>
    <div class="row">
      <div class="col-xs-9">
        <h4><span class="label label-default">searchenginewatch.com</span></h4><h4>
        <small style="font-family:courier,'new courier';" class="text-muted">Yesterday • <a href="#" class="text-muted">Read More</a></small>
        </h4></div>
      <div class="col-xs-3"></div>
    </div>
    <br><br>
  </div>
</div>
<hr>

<div class="row">
  <br>
  <div class="col-md-2 col-sm-3 text-center">
    <a class="story-title" href="#"><img alt="" src="http://api.randomuser.me/portraits/thumb/women/56.jpg" style="width:100px;height:100px" class="img-circle"></a>
  </div>
  <div class="col-md-10 col-sm-9">
    <h3>Dramatically Raise the Value of Any Piece of Content with These 27 Tactics</h3>
    <div class="row">
      <div class="col-xs-9">
        <h4><span class="label label-default">searchenginewatch.com</span></h4><h4>
        <small style="font-family:courier,'new courier';" class="text-muted">2 days ago • <a href="#" class="text-muted">Read More</a></small>
        </h4></div>
      <div class="col-xs-3"></div>
    </div>
    <br><br>
  </div>
</div>
<hr>

<div class="row">
  <br>
  <div class="col-md-2 col-sm-3 text-center">
    <a class="story-title" href="#"><img alt="" src="http://api.randomuser.me/portraits/thumb/men/29.jpg" style="width:100px;height:100px" class="img-circle"></a>
  </div>
  <div class="col-md-10 col-sm-9">
    <h3>TrendPaper - What's Trending in the World</h3>
    <div class="row">
      <div class="col-xs-9">
        <h4><span class="label label-default">betali.st</span></h4><h4>
        <small style="font-family:courier,'new courier';" class="text-muted">Last week • <a href="#" class="text-muted">Read More</a></small>
        </h4></div>
      <div class="col-xs-3"></div>
    </div>
    <br><br>
  </div>
</div>
<hr>
<!-/stories-->


<a href="/" class="btn btn-primary pull-right btnNext">More <i class="glyphicon glyphicon-chevron-right"></i></a>
