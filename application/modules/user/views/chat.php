<script type="text/javascript">
	 $(document).ready(function(){
			$('#chattoggle').click(function(){
				if($('#chatmain').css('bottom')=='-310px')
					$('#chatmain').css('bottom','-10px');
				else $('#chatmain').css('bottom','-310px');
			});
		});
</script>

<script type="text/javascript">
     $(document).ready(function(){
        getmessages();

        setInterval(checknewmsgs,5000);
        });
</script>

<script type="text/javascript">
    function checknewmsgs(){
        jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "user/checknewmsgs",
                        dataType: 'json',
                        success: function(res) {

                            if(res.msg == 'yes'){
                                $("#newmsgs").css('display','block');
                                getmessages();
                            }
                            
                        },
                        error: function(){
                        }
                    });


    }
</script>

<script type="text/javascript">
    function getmessages(){

         jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "user/getmessages",
                        dataType: 'json',
                        success: function(res) {
                                $("#messagelist").html('');

                                for (var msg in res.msgs) {
                                        var cls = "";var sender = "";
                                    if(res.msgs[msg].receiver == "<?php echo $this->session->userdata('logged_in')['id']?>"){cls = "left";sender="Admin"}else {cls = "right";sender = "<?php echo $this->session->userdata('logged_in')['username']?>"}

                                    $text = "<li class='"+cls+"msg'>"+
                                        "<span class='chatter'>"+sender+
                                        "</span><br>"+res.msgs[msg].message+"</li>";
                                    $("#messagelist").append($text);
                                    
                                }

                                if(res.seen==1)
                                    $("#adminseen").html("Seen by admin");
                                    else $("#adminseen").html("Not Seen by admin");

                        },
                        error: function(){
                            alert('error getting message');
                        }
                    });

    }

    function markseen(){


            $("#newmsgs").css('display','none');

        jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "user/markseen",
                        dataType: 'json',
                        success: function(res) {
                            
                        },
                        error: function(){
                            alert('error marking seen');
                        }
                    });

    }
</script>
	   

<script type="text/javascript">
            $(document).ready(function() {

                $("#msginput").keydown(function(event){
                if(event.keyCode == 13){

                    event.preventDefault();
                    var msg = $("#msginput").val();
                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "user/sendmessage",
                        dataType: 'json',
                        data: {msg: msg},
                        success: function(res) {
                                $text = "<li class='rightmsg'>"+
                                		"<span class='chatter'><?php echo $this->session->userdata('logged_in')['username']?>"+
                                		"</span><br>"+msg+"</li>";
                                $("#messagelist").append($text);
                                $("#msginput").val('');        
                        },
                        error: function(){
                        	alert('error sending message');
                        }
                    });
            }});

            });
        </script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#chatmain').click(function(){
            markseen();
        });
    });
</script>

<div class="col-sm-4" id="chatmain">
	
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading" id="chattoggle">
                    <span class="glyphicon glyphicon-comment"></span> Chat With Admin
                    <span id="newmsgs" style="float: right;color:black;font-size:1.3em;display: none;">NM</span>
                </div>
                <div class="panel-body" id="chatbody">
                    <ul id="messagelist">
                    	<li class="leftmsg"><span class="chatter">saiprasenthati:</span><br>Hello...!!!</li>
                    	<li class="rightmsg"><span class="chatter">Bob:</span><br>Hii</li>
                    	<li class="leftmsg"><span class="chatter">saiprasenthati:</span><br>How r u</li>
                    	<li class="rightmsg"><span class="chatter">Bob:</span><br>I am Fine. But you are not taking care about me i am upset. by the way how are you?</li>
                    </ul>
                    <hr>
                    <div id="adminseen"></div>
                </div>
                <div class="panel-footer" id="chatfooter">
                        <input id="msginput" type="text" class="input-sm" placeholder="Type your message here..." style="width: 70%;">
                        <button class="btn btn-success" style="" onclick="getmessages();">Reload</button>
                   
                </div>
            </div>
        </div>

</div>






