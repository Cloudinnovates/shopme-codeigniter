<?php if(isset($search)){?>
<hr>
<h2 >Sort By:</h2>
<form method="POST" class="col-sm-3">
<input type="text" name="searchquery" style="display:none;" value="<?php echo $search;?>">
<input type="text" name="sort_cat" style="display:none;" value="Relevance">
	<button class="btn btn-success" type="submit" name="submit">Relevance</button>
</form>
<form method="POST" class="col-sm-3">
<input type="text" name="searchquery" style="display:none;" value="<?php echo $search;?>">
<input type="text" name="sort_cat" style="display:none;" value="item_cost_asc">
	<button class="btn btn-success" type="submit" name="submit">Cost Ascending</button>
</form>
<form method="POST" class="col-sm-3">
<input type="text" name="searchquery" style="display:none;" value="<?php echo $search;?>">
<input type="text" name="sort_cat" style="display:none;" value="item_cost_des">
	<button class="btn btn-success" type="submit" name="submit">Cost Descending</button>
</form>

<br><hr>
Results for: <i><?php echo $search;?></i>
<br>Sorted by:<i><?php echo $sort_by;?></i>
<br><hr>
<?php }?>
	
	<?php if(!isset($items)||!$items){?>
			<h1 align="center" style="color:green;">No items required</h1>
			<?php } else {?>


	<div class="col-sm-12" >

			<h2 align="center" style="color:green;">Select your items:</h2>
			<br>
			  <?php foreach($items as $m): ?><?php if($m->item_id!=0){?>
			  	<div class="col-sm-6">
			  	<?php if(isset($search)){?>
			  	<a href="<?php echo base_url()."admin/itemdetails/".$m->user_type.'/'.$m->item_id;?>">
			  	<?php }else{?>
			    <a href="admin/itemdetails/<?php echo $user_type.'/'.$m->item_id; ?>">
			    <?php }?>
			  <div class="col-sm-10" style="min-width:200px;border: 3px solid blue;background-color: #3978ff;margin: 10px;padding: 10px">
			    <img src="<?php echo base_url()."assets/images/shopme/".$m->item_path;?>" alt="no image" width="90%" />
			    <div class="col-sm-10" style="color:white;font-size: 1.2em;">
			      <br><b>
			      Description:&nbsp;<?php echo $m->item_description; ?>
			      <br>
			      Brand:&nbsp;<?php echo $m->item_brand; ?>
			      <br>
			      Cost:&nbsp;Rs.<?php echo $m->item_cost; ?>
			    </b>
			    </div>
			  </div></a>
			  </div>
			  <?php }?>
			  <?php endforeach ?>
	</div>
	<?php }?>

	</div>

</div><div class="col-sm-2"></div>