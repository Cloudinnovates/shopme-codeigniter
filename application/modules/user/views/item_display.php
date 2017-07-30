

<br>




	
	<?php if(!isset($items)||!$items){?>
			<h1 align="center" style="color:green;">No item selected</h1>
			<?php } else {?>


	<div class="col-sm-12" >
			<h2 align="center" style="color:green;">Details of your item:</h2>
			<br>
			  <?php foreach($items as $m): ?>
			  	<div class="col-sm-10" style="margin:50px 10px;padding:20px;border:3px solid black;">
			    
			    <img src="<?php echo base_url()."assets/images/shopme/".$m->item_path;?>" alt="no image" width="30%" />
			    <div class="col-sm-6" style="color:green;font-size: 1.4em;float: right;">
			      <br><b>
			      Description:&nbsp;<?php echo $m->item_description; ?>
			      <br><br>
			      Brand:&nbsp;<?php echo $m->item_brand; ?>
			      <br><br>
			      Cost:&nbsp;Rs.<?php echo $m->item_cost; ?>
			    </b><br><br>
			    <button class="btn btn-success" id="addcart" <?php if($carted)echo "disabled";?>>
			    <?php if($carted)echo "Already added to Cart";else echo "Add to Cart";?>
			    </button>

			    <script type="text/javascript">
            $(document).ready(function() {
                $("#addcart").click(function(){
                    $.ajax({
                        url: "<?php echo base_url(); ?>user/addtocart/<?php echo $user_type.'/'.$m->item_id;?>",
                        dataType: 'text',
                        success: function(res) {
                                    $("#addcart").prop("disabled",true);
                                    $("#addcart").html("Added to Cart");
                                
                        },
                        error: function(){
                            alert('unable to process your request');
                        }

                    });

            });
            });
        </script>

			    </div>

			  </div>
			  <?php endforeach ?>
	</div>
	<?php }?>

	</div>

</div><div class="col-sm-2"></div>