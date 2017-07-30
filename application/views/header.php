<!DOCTYPE html>
<html>
<head lang="en">
<title>Shop me</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/shopme.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.js"></script>

    <script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyDdgeDuhTp2EZdHK8zCGUN1S3dNzCd-AvM"></script>   
    <script src="<?php echo base_url();?>assets/jquery/locationpicker.jquery.min.js"></script>
</head>
<body style="background-color: yellow;">


<nav class="navbar navbar-inverse " style="margin:0px;">
  <div class="container-fluid" style="padding: 0px;">
    <div class="navbar-header" style="padding: 0px;">
      <a  href="<?php echo base_url();?>auth" >
        <img src="<?php echo base_url();?>assets/images/shopme.png" height="80px" width="235px" /></a>
    </div>
    <ul class="nav navbar-nav">
      
      <li class="<?php if (isset($home_active)) echo $home_active ?>">
            <a href="<?php echo base_url().$this->session->userdata('logged_in')['user'];?>/home">
              <div class="navbuttop">
                <span>Home Page</span> 
              </div>
            </a>            
          </li>

        <li class="<?php if (isset($shop_active)) echo $shop_active ?>">
            <a href="#">
              <div class="navbuttop" id="shopboxbtn">
                <span>Shop Here</span>
              </div>
            </a>     
        </li>



        <li class="<?php if (isset($nearby_active)) echo $nearby_active ?>">
        
          <a href="<?php echo base_url().$this->session->userdata('logged_in')['user'];?>/nearbyshops">
            <div class="navbuttop">
              <span>Nearby Shops</span>
             </div>
          </a>        
        </li>



    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li>
        <a href="#">
          <div class="navbuttop" id="mydetailsbtn"><span>
          <?php if($this->session->userdata('logged_in')['admin']==1)echo "Customer Details";
          else echo "My Details";?>
        </span>
        </div>
        </a>
        </li>
      <li>
        <a href="<?php echo base_url();?>auth/logout">
          <div class="navbuttop">
        <span>Log out</span>
        </div>
        </a>
        </li>
    </ul>


  </div>
</nav>
<script type="text/javascript">
  $('#shopboxbtn').click(function(){$('#shopbox').toggle('slow');});
  $('#mydetailsbtn').click(function(){$('#mydetailsbox').toggle('slow');});
</script>

<div class="shopboxdata col-sm-12" id="shopbox">

    <div class="col-sm-4" style="float:left;">
      <a href="<?php echo base_url().$this->session->userdata('logged_in')['user'];?>/mens" style="text-decoration:none;">
        <div class="shopboxitem">
          <span>Men's Shopping</span>
        </div>
      </a>
    </div>

    <div class="col-sm-4" style="float:left;">
      <a href="<?php echo base_url().$this->session->userdata('logged_in')['user'];?>/womens" style="text-decoration:none;">
        <div class="shopboxitem">
          <span>Women's Shopping</span>
        </div>
      </a>
    </div>

    <div class="col-sm-4" style="float:left;">
      <a href="<?php echo base_url().$this->session->userdata('logged_in')['user'];?>/kids" style="text-decoration:none;">
        <div class="shopboxitem">
          <span>Kids's Shopping</span>
        </div>
      </a>
    </div>

    <div class="col-sm-4" style="float:left;">
      <a href="<?php echo base_url().$this->session->userdata('logged_in')['user'];?>/electronics" style="text-decoration:none;">
        <div class="shopboxitem">
          <span>Electronics</span>
        </div>
      </a>
    </div>

    <div class="col-sm-4" style="float:left;">
      <a href="<?php echo base_url().$this->session->userdata('logged_in')['user'];?>/books" style="text-decoration:none;">
        <div class="shopboxitem">
          <span>Books</span>
        </div>
      </a>
    </div>

    <div class="col-sm-4" style="float:left;">
      <a href="<?php echo base_url().$this->session->userdata('logged_in')['user'];?>/others" style="text-decoration:none;">
        <div class="shopboxitem">
          <span>Others</span>
        </div>
      </a>
    </div>

</div>

<div class="shopboxdata col-sm-12" id="mydetailsbox">


    <div class="col-sm-4" style="float:left;">
      <a href="<?php echo base_url().$this->session->userdata('logged_in')['user'];?>/account" style="text-decoration:none;">
        <div class="shopboxitem">
          <span>
            <?php if($this->session->userdata('logged_in')['admin']==1)echo "User Accounts";
          else echo "My Account";?>
          </span>
        </div>
      </a>
    </div>

    <div class="col-sm-4" style="float:left;">
      <a href="<?php echo base_url().$this->session->userdata('logged_in')['user'];?>/cart" style="text-decoration:none;">
        <div class="shopboxitem">
          <span>
            <?php if($this->session->userdata('logged_in')['admin']==1)echo "User Request";
          else echo "My Cart";?>
          </span>
        </div>
      </a>
    </div>

</div>


<div class="container col-sm-12" style="background-color: yellow;margin-top:-5px;">


<div class="col-sm-2"></div>
<div class="col-sm-8 maindiv" style="background-color: white;">

<br>
  <form method="POST" action="<?php echo base_url().$this->session->userdata('logged_in')['user'];?>/search">
      <div class="form-group form-inline">
        <input class="searchbox" type="text" name="searchquery" placeholder="   Search items...!!" />
        <button class="submitbtn" type="submit" class="btn btn-default">Submit</button>
        <br>&nbsp;&nbsp;Make sure you type category (mens,womens,etc)
      </div>
    </form>

<br>
<div class="hr"></div>

<br>
