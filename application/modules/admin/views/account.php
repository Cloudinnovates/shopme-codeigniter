



	
	<?php if(!isset($users)||!$users){?>
			<div class="alert alert-danger alert-dismissable">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>No Requests!</strong> 
		</div>
			<?php } else {?>



	<div class="col-sm-12" >
			<h2 align="center" style="color:green;">Request Details:</h2>
			<br>

            <table class="table table-responsive tabe-bordered table-hover">
                <tr>
                    <th>User id</th>
                    <th>Amount</th>
                    <th>Transaction id</th>
                    <th>Approve</th>
                    <th>Reject</th>
                </tr>


			  <?php foreach($users as $key =>$user): ?>

                <tr id="request<?php echo $key;?>">
                    <td>
                        <?php echo $user->user_id;?>
                    </td>
                    <td>
                        <?php echo $user->amount;?>
                    </td>
                    <td>
                        <?php echo $user->transaction_id;?>
                    </td>
                    <td>
                        <button class="btn btn-success" id="approve<?php echo $key;?>">Approve</button>
                    </td>
                    <td>
                        <button class="btn btn-success" id="reject<?php echo $key;?>">Reject</button>
                    </td>
                </tr>

                <script type="text/javascript">
            $(document).ready(function() {
                $("#approve<?php echo $key;?>").click(function(){
                    $.ajax({
                        url: "<?php echo base_url(); ?>admin/approvemoney/<?php echo $user->user_id.'/'.$user->amount.'/'.$user->transaction_id;?>",
                        dataType: 'text',

                        success: function(res) {
                                    $('#request<?php echo $key;?>').remove();

                        },
                        error: function(){
                            alert('unable to process your request');
                        }

                    });

            });
            });
        </script>

         <script type="text/javascript">
            $(document).ready(function() {
                $("#reject<?php echo $key;?>").click(function(){
                    $.ajax({
                        url: "<?php echo base_url(); ?>admin/rejectmoney/<?php echo $user->user_id.'/'.$user->amount.'/'.$user->transaction_id;?>",
                        dataType: 'text',

                        success: function(res) {
                                    $('#request<?php echo $key;?>').remove();

                        },
                        error: function(){
                            alert('unable to process your request');
                        }

                    });

            });
            });
        </script>
    
			  <?php endforeach ?>

            </table>
	</div>
	<?php }?>

	</div>

</div><div class="col-sm-2"></div>