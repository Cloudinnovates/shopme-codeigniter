



	
	<?php if(!isset($users)||!$users){?>
			<div class="alert alert-danger alert-dismissable">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Sorry!</strong> Internal Problem
		</div>
			<?php } else {?>

			<?php if($this->session->flashdata("upload_message")){?>
                    <div class="alert alert-info">     
                    <?php echo $this->session->flashdata("upload_message")?>
                    </div>
                    <?php } ?>

                    <?php if($this->session->flashdata("transaction_message")){?>
                    <div class="alert alert-info">     
                    <?php echo $this->session->flashdata("transaction_message")?>
                    </div>
                    <?php } ?>


           <div class="col-sm-offset-4 col-sm-4">
           	<button class="btn btn-success" id="moneyaddbtn">Add money to Wallet</button>
           </div>

           <script type="text/javascript">
                $("#moneyaddbtn").click(function(){$('#moneyadddata').toggle('slow');});
        </script>

           
           <div class="col-sm-10" id="moneyadddata" style="display:none;margin:50px 10px;padding:20px;border:3px solid black;">			

				<form class="form-horizontal" method="post" action="<?php echo base_url();?>user/addmoney">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="id_amount">
                                Enter Amount to add:
                            </label>
                            <div class="col-sm-6">
                                <input id="id_amount" maxlength="30" name="amount">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-4" for="id_trans">
                                Enter Transaction id:
                            </label>
                            <div class="col-sm-6">
                                <input id="id_trans" maxlength="30" name="transaction">
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <div class="col-sm-offset-2 ">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div><br>
                            
                        </div>
        </form>


		</div>


	<div class="col-sm-12" >
			<h2 align="center" style="color:green;">User Details:</h2>
			<br>
			  <?php foreach($users as $user): ?>
			  	<div class="col-sm-10"  style="margin:50px 10px;padding:20px;border:3px solid black;">
			    
			    <img src="<?php echo base_url();?>assets/images/users/<?php echo $user->image_path;?>" alt="no image" width="30%" style="overflow: auto;"/>
			    <div class="col-sm-6" style="color:green;font-size: 1.4em;float: right;">
			      <br><b>
			      User Id:&nbsp;<?php echo $user->id; ?>
			      <br><br>
			      User Name:&nbsp;<?php echo $user->username; ?>
			      <br><br>
			      Email id:&nbsp;<?php echo $user->emailid; ?>
			      <br><br>
			      Wallet:&nbsp;Rs:<?php echo $user->wallet; ?>
			      <br><br>
			      User type:&nbsp;<?php if($user->admin)echo "Admin";else echo "User"; ?>
			    </b><br><br>
			    <button class="btn btn-success" id="editdetails">
			   	Edit Details
			    </button>
			    <script type="text/javascript">
                $("#editdetails").click(function(){$('#editdetailsdata').toggle('slow');});
        </script>

			    </div>

			  </div>
			  <br><hr><br>


		<div class="col-sm-10" id="editdetailsdata" style="display:none;margin:50px 10px;padding:20px;border:3px solid black;">
			

				<form class="form-horizontal" method="post" action="<?php echo base_url();?>user/editdetails" enctype="multipart/form-data">
						<div class="form-group">
                            <label class="control-label col-sm-4" for="user_pic">
                                Select Picture:
                            </label>
                            <div class="col-sm-6">
                                <input id="user_pic" size="20" name="user_pic" type="file">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="id_email">
                                Email-id:
                            </label>
                            <div class="col-sm-6">
                                <input id="id_email" maxlength="30" name="emailid" type="email">
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <div class="col-sm-offset-2 ">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div><br>
                            
                        </div>
        </form>


		</div>

			  <?php endforeach ?>
	</div>
	<?php }?>

	</div>

</div><div class="col-sm-2"></div>