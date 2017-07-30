
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
    <title>Acount Login</title>
</head>
<body>
<div class="jumbotron">
    <h1 align="center">Login Page</h1>
    <p align="center">Enter Login Details:</p>
  </div>
<div class="container-fluid">
<div class=" col-sm-4"></div>
                <div class="jumbotron  col-sm-4">
                    
                    <?php if($this->session->flashdata("login_message")){?>
                    <div class="alert alert-info">      
                    <?php echo $this->session->flashdata("login_message")?>
                    </div>
                    <?php } ?>
                    <?php if($this->session->flashdata("register_message")){?>
                    <div class="alert alert-info">      
                    <?php echo $this->session->flashdata("register_message")?>
                    </div>
                    <?php } ?>
                    <h3>Log In</h3>
                    <form class="form-horizontal" method="post" action="<?php echo base_url();?>auth/verifylogin">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="id_username">
                                Username:
                            </label>
                            <div class="col-sm-6">
                                <input id="id_username" maxlength="30" name="username" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="id_password">
                                Password:
                            </label>
                            <div class="col-sm-6">
                                <input id="id_password" maxlength="30" name="password" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 ">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div><br>
                            
                        </div>
                    </form>
                    Dont have an account?<br><br>
                            <div class="col-sm-offset-2 ">
                                <a href="./auth/register">Register</a>
                            </div>
                </div>
<div class=" col-sm-4"></div>
</div>
</body>