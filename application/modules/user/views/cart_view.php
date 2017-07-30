



	
	<?php if(!isset($items)||!$items){?>
			<h1 align="center" style="color:green;">Cart is Empty</h1>
			<?php } else {?>


	<div class="col-sm-12" >
			<h2 align="center" style="color:green;">Details of your item:</h2>
			<br>
			  <?php foreach($items as $key=>$m): ?>
			  	<div class="col-sm-10" id="cart<?php echo $key;?>" style="margin:50px 10px;padding:20px;border:3px solid black;overflow: auto;">
			    
			    <img src="<?php echo base_url()."assets/images/shopme/".$m->item_path;?>" alt="no image" width="30%" />
			    <div class="col-sm-6" style="color:green;font-size: 1.4em;float: right;">
			      <br><b>
			      Description:&nbsp;<?php echo $m->item_description; ?>
			      <br><br>
			      Brand:&nbsp;<?php echo $m->item_brand; ?>
			      <br><br>
			      Cost:&nbsp;Rs.<?php echo $m->item_cost; ?>
			    </b><br><br>
			    <button class="btn btn-success" id="addcart<?php echo $key;?>">
			    Remove from Cart
			    </button>
			    <script type="text/javascript">
            $(document).ready(function() {
            	$("#totitems").text(+($("#totitems").text()) + 1);
            	$("#totcost").text(+($("#totcost").text()) + <?php echo $m->item_cost;?>);
                $("#addcart<?php echo $key;?>").click(function(){
                    $.ajax({
                        url: "<?php echo base_url(); ?>user/removefromcart/<?php echo $m->user_type.'/'.$m->item_id;?>",
                        dataType: 'text',
                        success: function(res) {
                                    $('#cart<?php echo $key;?>').remove();
                                    $("#totitems").text(+($("#totitems").text()) - 1);
            						$("#totcost").text(+($("#totcost").text()) - <?php echo $m->item_cost;?>);
                                
                        },
                        error: function(){
                            alert('unable to process your request');
                        }

                    });

            });
            });
        </script>
        			<br><br>

        			<button class="btn btn-success" id="buyitem<?php echo $key;?>">
					   Purchase
					    </button><br>
				<h5 align="center">(Cannot undone after)</h5>

			    </div>


		 <script type="text/javascript">
            $(document).ready(function() {
                $("#buyitem<?php echo $key;?>").click(function(){
                    $.ajax({
                        url: "<?php echo base_url(); ?>user/buyfromcart/<?php echo $m->user_type.'/'.$m->item_id.'/'.$m->item_cost;?>",
                        dataType: 'json',
                        success: function(res) {
                        			if(res.msg=="nomoney")alert('no money');
                        			else
                        			{
                        				$('#cart<?php echo $key;?>').remove();
	                                    alert('purchased');
	                                    $("#totitems").text(+($("#totitems").text()) - 1);
	            						$("#totcost").text(+($("#totcost").text()) - <?php echo $m->item_cost;?>);
                        			}
                                    
                                
                        },
                        error: function(){
                            alert('unable to process your request');
                        }

                    });

            });
            });
        </script>

			  </div>
			  <?php endforeach ?>
	</div>
	<?php }?>

	<div class="col-sm-10" style="border:3px solid green;margin:50px 20px;padding:30px 10px;color: green;">
		<h2 align="center">Total No.of Items: <span id="totitems">0</span></h1>
		<h2 align="center">Total Cost Required: <span id="totcost">0</span></h1><br>
	</div>

	</div>

</div><div class="col-sm-2"></div>