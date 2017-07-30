
<h1 align="center">Select Your Location:</h1>

<div class="col-sm-offset-1 col-sm-10" style="border:3px solid black;border-radius: 100px;padding:50px;">

    <div class="form-horizontal" >
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
                <input type="text" class="form-control" style="width: 110px" id="us3-lat" name="user_lat" />
            </div>
            <label class="p-r-small col-sm-2 control-label">Long.:</label>

            <div class="col-sm-3">
                <input type="text" class="form-control" style="width: 110px" id="us3-lon" name="user_long" />
            </div>
        </div>
        <div class="clearfix"></div>
        <script>
            $('#us3').locationpicker({
                location: {
                    latitude: 46.15242437,
                    longitude: 2.747070312
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
                    <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-4 ">
                                <button type="submit" class="btn btn-success" id="searchshops">Go</button>
                            </div><br>
                            
                        </div>
    </div>
    
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $("#searchshops").click(function(){
            var lat =  $("#us3-lat").val();
            var long = $("#us3-lon").val();
                jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "user/getshops/"+lat+"/"+long,
                        dataType: 'json',
                        success: function(res) {
                                $("#shoplist").html("<tr><th>Shop id</th><th>Shop Name</th><th>Shop Type</th><th>Shop Location:</th><th>Distance from here</th><th>View in Map</th></tr>");
                            for(shop in res.shops){
                                $text = "<tr id='shop"+res.shops[shop].shop_id+"'><td>"+res.shops[shop].shop_id+"</td><td>"+res.shops[shop].shop_name+"</td><td>"+res.shops[shop].shop_type+"</td><td>"+res.shops[shop].shop_city+"</td><td>"+res.shops[shop].shop_dist+" km</td><td>"+"<button href='#us3' class='btn btn-success' onclick='viewinmap("+res.shops[shop].shop_id+");'>View in Map</button><span style='display:none;' id='lat"+res.shops[shop].shop_id+"'>"+res.shops[shop].shop_lat+"</span><span style='display:none;' id='long"+res.shops[shop].shop_id+"'>"+res.shops[shop].shop_long+"</span>"+"</td></tr>";
                                $("#shoplist").append($text);
                            }
                            
                        },
                        error: function(){

                            alert('error retrieving shops');
                        }
                    });

        });
    });
</script>

<script type="text/javascript">
    function viewinmap($shopid){
        $lat = $("#lat"+$shopid).html();
            $long = $("#long"+$shopid).html();
            $('#us3').locationpicker({
                location: {
                    latitude: $lat,
                    longitude: $long
                }
            });
            $("html, body").animate({ scrollTop: 200 }, "slow");
    }
</script>


<br><hr>
<br>

<div class="col-sm-offset-1 col-sm-10 shopsdisplay">

<table class="table table-responsive tabe-bordered table-hover table-stripped" id="shoplist" style="border:3px solid black;padding:10px;">
    <tr>
        <th>Shop id</th>
        <th>Shop Name</th>
        <th>Shop Type</th>
        <th>Distance from here</th>
        <th>View in Map</th>
    </tr>
</table>
    
</div>

<br><hr>

	<img src="<?php echo base_url();?>assets/images/homepageimage.jpg"  width="100%" height="$(this).css(width);"/>

</div>
<div class="col-sm-2"></div>