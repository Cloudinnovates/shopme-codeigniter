<div id="closeallads" style="width:100px;border:1px solid black;position: fixed;bottom: 10px;left:10px;border-radius:5px;cursor: pointer;background-color: green;">X Close all Ads</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#closeallads").click(function(){
			$("#allads").toggle('slow');
		});
	});
</script>
<div id="allads">

<?php if($this->session->userdata('views')){?>
<div id="viewsad">

No.of views: <br>
	<?php echo $this->session->userdata('views')['views'];?>

</div>
<?php }?>

<?php if($this->session->userdata('logged_in')){?>
<div id="walletad">

Wallet: <br>
	Rs:<?php echo $this->session->userdata('logged_in')['wallet'];?>

</div>
<?php }?>


	<div id="topad">
	  Top
	</div>



<script type="text/javascript">
	$(document).ready(function(){
		$("#topad").click(function() {
  		$("html, body").animate({ scrollTop: 0 }, "slow");

	});

});
</script>
<script type="text/javascript">
$(document).scroll(function() {
  var y = $(this).scrollTop();
  if (y > 200) {
    $('#topad').fadeIn();
  } else {
    $('#topad').fadeOut();
  }
});
</script>

</div>