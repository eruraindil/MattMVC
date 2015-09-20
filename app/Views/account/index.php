<form id="form-account">
  <div class="row">
    <div class="col-md-9">
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
      <button id="submitButton" class="btn btn-block btn-primary">Submit</button>
    </div>
    <div class="col-md-3 text-right">
      <?php if(null !== $data["user"]->getPhoto()):?>
        <div class="form-group">
          <label for="exampleInputFile">Photo</label>
          <br>
          <img src="<?php echo $data["user"]->viewImage();?>" class="img-thumbnail">
          <br>
          <button id="removeImage" class="btn btn-default">Remove Image</button>
          <!-- <p class="help-block">Example block-level help text here.</p> -->
        </div>
      <?php else:?>
        <div class="form-group">
          <label for="exampleInputFile">Photo</label>
          <input type="file" id="exampleInputFile">
          <!-- <p class="help-block">Example block-level help text here.</p> -->
        </div>
      <?php endif;?>
    </div>
  </div>
</form>
