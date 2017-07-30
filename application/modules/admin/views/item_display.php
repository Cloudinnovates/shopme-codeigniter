

<br>




	
	<?php if(!isset($items)||!$items){?>
			<h1 align="center" style="color:green;">No item selected</h1>
			<?php } else {?>


	<div class="col-sm-12" >
			<h2 align="center" style="color:green;">Details of your item:</h2>
			<br>
			  <?php foreach($items as $m): ?>
			  	<div class="col-sm-10" style="margin:50px 10px;padding:20px;border:3px solid black;" id="item">
			    
			    <img src="<?php echo base_url()."assets/images/shopme/".$m->item_path;?>" alt="no image" width="30%" />
			    <div class="col-sm-6" style="color:green;font-size: 1.4em;float: right;">
			      <br><b>
			      Description:&nbsp;<?php echo $m->item_description; ?>
			      <br><br>
			      Brand:&nbsp;<?php echo $m->item_brand; ?>
			      <br><br>
			      Cost:&nbsp;Rs.<?php echo $m->item_cost; ?>
			    </b><br><br>
			    <button class="btn btn-success" id="edititem" >
			    Edit item
			    </button>
			    <br><br>
			    <button class="btn btn-success" id="deleteitem" >
			    Delete item
			    </button>

			    <script type="text/javascript">
            $(document).ready(function() {
                $("#deleteitem").click(function(){
                    $.ajax({
                        url: "<?php echo base_url()."admin/deleteitem/".$user_type.'/'.$m->item_id;?>",
                        dataType: 'json',
                        success: function(res) {
                                    $('#item').remove();

                                
                        },
                        error: function(){
                            alert('unable to process your request');
                        }

                    });

            });
            });
        </script>


			<script type="text/javascript">
				$(document).ready(function(){
					$("#edititem").click(function(){
						$("#editdetails").toggle('slow');
					});
				});
			</script>


			    </div>

			  </div>

			  <div class="col-sm-offset-2 jumbotron  col-sm-8" id="editdetails" style="display: none;border:3px solid black;padding: 20px;">
		 <?php if($this->session->flashdata("edit_message")){?>
                    <div class="alert alert-info">      
                    <?php echo $this->session->flashdata("edit_message")?>
                    </div>
                    <?php } ?>

		<form class="form-horizontal" method="post" action="<?php echo base_url();?>admin/edititem/<?php echo $user_type.'/'.$m->item_id.'/',$m->item_category;?>" enctype="multipart/form-data">
						<div class="form-group">
                            <label class="control-label col-sm-4" for="item_pic">
                                Select Picture:
                            </label>
                            <div class="col-sm-6">
                                <input id="item_pic" size="20" name="item_pic" type="file" path="<?php echo base_url()."assets/images/shopme/".$m->item_path;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="id_brand">
                                Brand:
                            </label>
                            <div class="col-sm-6">
                                <input id="id_brand" maxlength="30" name="item_brand" type="text" value="<?php echo $m->item_brand;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="id_cost">
                                Cost:
                            </label>
                            <div class="col-sm-6">
                                <input id="id_cost" maxlength="30" name="item_cost" type="text" value="<?php echo $m->item_cost;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="id_description">
                                Item Description:
                            </label>
                            <div class="col-sm-6">
                                <input id="id_description maxlength="30" name="item_description" type="text" value="<?php echo $m->item_description;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 ">
                                <button type="submit" class="btn btn-success">Go</button>
                            </div><br>
                            
                        </div>
        </form>

	</div>
			  <?php endforeach ?>
	</div>
	<?php }?>


                


	</div>

</div><div class="col-sm-2"></div>