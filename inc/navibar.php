<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $pagetitle; ?></title>
    <!-- Required meta tags -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

      	<link rel="stylesheet" type="text/css" href="css/main.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <body  id="home"data-spy="scroll" data-target=".navbar" data-offset="0">
    <nav   class="navbar navbar-expand-lg navbar-dark bg-dark navbar fixed-top">
       <div class="container-fluid">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="<?php echo $link1; ?>"><?php echo $link1title; ?><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $link2; ?>"><?php echo $link2title; ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $link3; ?>"><?php echo $link3title; ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $link4; ?>"><?php echo $link4title; ?></a>
      </li>
    </ul>
    <span class="navbar-text">
      Severe Weather Warnings
    </span>
  </div>

</div>

</nav>

  <div class="jumbotron jumbotron-fluid bg-dark">
    <div class="container text-sm-center text-light pt-2">
      <h1 class="display-3 ">Welcome</h1>
        <h1 class="display-2 d-none d-sm-block">Meteorology Club</h1>
  <p class="lead">A One-day Conference About All Things!</p>
  <div class="btn-group btn-group-lg" role="group" aria-label="...">

    <button type="button" class="btn btn-secondary"data-toggle="modal" data-target="<?php echo $target;?>"><?php echo $jumbotitle;?></button>
     <a href="<?php echo $secondbutton;?>" class="btn btn-secondary"><?php echo $secondbuttontitle;?></a>
  </div>
    </div>
  </div>
  <div class="container-fluid  pt-3">
