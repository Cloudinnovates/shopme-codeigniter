

<br><div class="hr"></div>
<br>
<h1 align="center">Enter a shop:</h1>

 <?php if($this->session->flashdata("upload_shop")){?>
                    <div class="alert alert-info">      
                    <?php echo $this->session->flashdata("upload_shop");?>
                    </div>
                    <?php } ?>

<div class="col-sm-offset-1 col-sm-10" style="border:3px solid black;border-radius: 100px;padding:50px;">
    
<form class="form-horizontal" method="post" action="<?php echo base_url();?>admin/uploadshop" >

                        <div class="form-group">
                            <label class="control-label col-sm-4" for="id_name">
                                Name of the shop:
                            </label>
                            <div class="col-sm-6">
                                <input id="id_name" class="form-control" maxlength="30" name="shop_name" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="id_type">
                                Shop Type:
                            </label>
                            <div class="col-sm-6">
                                <input id="id_type" class="form-control" maxlength="30" name="shop_type" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="id_city">
                                Shop City:
                            </label>
                            <div class="col-sm-6">
                                <input id="id_city" class="form-control" maxlength="30" name="shop_city" type="text">
                            </div>
                        </div>
                        <hr>
                        <h2 align="center">Choose location:</h2><br>
                        <div class="form-group">
                        <label class="col-sm-4 control-label">Location:</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="us3-address" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Radius:</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="us3-radius" />
                        </div>
                    </div>
                    <div id="us3" style="width: 550px; height: 400px;"></div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="m-t-small">
                        <label class="p-r-small col-sm-1 control-label">Lat.:</label>

                        <div class="col-sm-3">
                            <input type="text" class="form-control" style="width: 110px" id="us3-lat" name="shop_lat" />
                        </div>
                        <label class="p-r-small col-sm-2 control-label">Long.:</label>

                        <div class="col-sm-3">
                            <input type="text" class="form-control" style="width: 110px" id="us3-lon" name="shop_long" />
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <script>
                        $('#us3').locationpicker({
                            location: {
                                latitude: 46.15242437752303,
                                longitude: 2.7470703125
                            },
                            radius: 300,
                            inputBinding: {
                                latitudeInput: $('#us3-lat'),
                                longitudeInput: $('#us3-lon'),
                                radiusInput: $('#us3-radius'),
                                locationNameInput: $('#us3-address')
                            },
                            enableAutocomplete: true,
                            onchanged: function (currentLocation, radius, isMarkerDropped) {
                                // Uncomment line below to show alert on each Location Changed event
                                //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                            }
                        });
                    </script>
                    <br>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-4 ">
                                <button type="submit" class="btn btn-success">Insert City</button>
                            </div><br>
                            
                        </div>
        </form>

</div>




<br><hr>

	<img src="<?php echo base_url();?>assets/images/homepageimage.jpg"  width="100%" height="$(this).css(width);"/>

</div><div class="col-sm-2"></div>