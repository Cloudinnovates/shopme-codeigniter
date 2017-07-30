
	<h2 align="center" style="color:green;">Welcome to <?php echo $user_type;?> 's <?php echo $cat;?> category</h2>
	<hr>
	<h1 align="center" style="color:green;">Upload an item:</h1>
<br>

	<div class=" col-sm-2"></div>
                <div class="jumbotron  col-sm-8">
		 <?php if($this->session->flashdata("upload_message")){?>
                    <div class="alert alert-info">      
                    <?php echo 'Your last upload was '.$this->session->flashdata("upload_message")?>
                    </div>
                    <?php } ?>

		<form class="form-horizontal" method="post" action="<?php echo base_url();?>admin/uploadimage/<?php echo $user_type.'/'.$cat;?>" enctype="multipart/form-data">
						<div class="form-group">
                            <label class="control-label col-sm-4" for="item_pic">
                                Select Picture:
                            </label>
                            <div class="col-sm-6">
                                <input id="item_pic" size="20" name="item_pic" type="file">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="id_brand">
                                Brand:
                            </label>
                            <div class="col-sm-6">
                                <input id="id_brand" maxlength="30" name="item_brand" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="id_cost">
                                Cost:
                            </label>
                            <div class="col-sm-6">
                                <input id="id_cost" maxlength="30" name="item_cost" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="id_description">
                                Item Description:
                            </label>
                            <div class="col-sm-6">
                                <input id="id_description maxlength="30" name="item_description" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 ">
                                <button type="submit" class="btn btn-success">Upload item</button>
                            </div><br>
                            
                        </div>
        </form>

	</div>
	<div class="col-sm-2"></div>

<br><hr>
<br>


</div><div class="col-sm-2"></div>