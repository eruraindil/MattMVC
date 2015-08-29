<?php
  use MattMVC\Core\App as App;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <title><?php echo (App::NAME != $data["title"] ? $data["title"] . " - " . App::NAME : App::NAME . " - " . App::TAGLINE);?></title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="/static/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/static/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!--[if lt IE 9]>
      <script src="/static/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
    <link href="/css/theme.css" rel="stylesheet" />
    <link href="/css/main.css" rel="stylesheet" />
  </head>
  <body>
    <header class="navbar navbar-bright navbar-fixed-top" role="banner">
      <div class="container">
        <div class="navbar-header">
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="/" class="navbar-brand"><?php echo App::NAME;?></a>
        </div>
        <nav class="collapse navbar-collapse" role="navigation">
          <ul class="nav navbar-nav">
            <?php foreach($data['categories'] as $category):?>
              <li class="active">
                <a href="/category/<?php echo $category->getId();?>">
                  <?php echo $category->getName();?>
                </a>
              </li>
            <?php endforeach;?>
          </ul>
          <form class="navbar-form form-inline pull-right">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
              </span>
            </div>
          </form>
          <ul class="nav navbar-right navbar-nav">
            <li role="separator" class="divider"></li>
            <?php if(!isset($_SESSION["username"])):?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login</a>
                <ul class="dropdown-menu" style="padding:12px;">
                  <form class="form-signin" action="/auth/login" method="post">
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="remember-me"> Remember me
                      </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                  </form>
                </ul>
              </li>
            <?php else:?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#"><?php echo $_SESSION["username"];?></a></li>
                  <li><a href="/account/">Edit Account</a></li>
                </ul>
              </li>
              <li><a href="/auth/logout">Logout</a></li>
            <?php endif;?>
            <li role="separator" class="divider"></li>
          </ul>
        </nav>
      </div>
    </header>
    <div id="masthead">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1><?php echo $data['title'];?>
              <p class="lead"><?php echo $data['subtitle'];?></p>
            </h1>
          </div>
          <!-- <div class="col-md-5">
            <div class="well well-lg">
              <div class="row">
                <div class="col-sm-12">
                  an ad
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div><!-- /cont -->
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="top-spacer"> </div>
          </div>
        </div>
      </div><!-- /cont -->
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-body">
