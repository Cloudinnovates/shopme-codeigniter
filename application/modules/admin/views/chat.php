
<?php if(isset($users_list)&&$users_list){?>
<div id="adminchatlist">
<b>Select a user to chat</b><div id="adminchatlistclose" style="float: right;color:red;cursor: pointer;">X</div>
    <ul id="msglisth">
        <?php foreach ($users_list as $key=>$user) {?>
           <li id="user<?php echo $key;?>">
           <span id="name<?php echo $key;?>">
               <?php echo $user['username'];?>
           </span>
           
           <div id="seen<?php echo $key;?>" style="float: right;color:green;">
               <?php if($user['seen']==0)echo "&nbsp;NM";?>
           </div>
           <span id="userid<?php echo $key;?>" style="display: none;">
               <?php echo $user['user_id'];?>
           </span>
           
           </li>

        <?php } ?>
    </ul>
</div>
<?php }?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#adminchatlistclose").click(function(){
            var left = $("#adminchatlist").css('left');
            if(left=="-150px")$("#adminchatlist").css('left','0px');
            else $("#adminchatlist").css('left','-150px')
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        setInterval(function(){

            jQuery.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>" + "admin/getmsglist/",
                            dataType: 'json',
                            success: function(res) { 
                            for(var msg in res){
                                    var nm="";
                                    if(res[msg].seen==0)nm="NM";
                                        $("#name"+msg).html(res[msg].username);
                                        $("#userid"+msg).html(res[msg].user_id);
                                        $("#seen"+msg).html(nm);

                                    }

                                    
                                },
                                error: function(){
                                    alert('error getting list');
                                }

                    });

        },5000);
    });
</script>


<script type="text/javascript">
	 $(document).ready(function(){
            $('#chatmain').css('display','none');
			$('#chattoggle').click(function(){
				if($('#chatmain').css('bottom')=='-310px')
					$('#chatmain').css('bottom','-10px');
				else $('#chatmain').css('bottom','-310px');
			});
		});
</script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('[id^=user]').click(function(event){
                    var id = event.target.id.slice(4);

                    var user_id = parseInt($("#userid"+id).html());
                    var username = $("#name"+id).html();

                    $("#senderid").val(user_id);

                            $("#seen"+id).html('');
                            $("#chattername").html(username);
                            $("#chatmain").css({'display':'block','bottom':'-20px'});
                            

                            jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "admin/getmessages/"+user_id,
                        dataType: 'json',
                        success: function(res) {


                                $("#messagelist").html('');

                                for (var msg in res.msgs) {
                                        var cls = "";var sender = "";
                                    if(res.msgs[msg].sender==user_id){cls = "left";sender=username;}else {cls = "right";sender = "<?php echo $this->session->userdata('logged_in')['username']?>";}

                                    $text = "<li class='"+cls+"msg'>"+
                                        "<span class='chatter'>"+sender+
                                        "</span><br>"+res.msgs[msg].message+"</li>";
                                    $("#messagelist").append($text);
                                    
                                }

                                if(res.seen==1)
                                    $("#adminseen").html("Seen by user");
                                    else $("#adminseen").html("Not Seen by user");

                            jQuery.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>" + "admin/markseen/" + user_id,
                                dataType: 'json',
                                success: function(res) {
                                    
                                },
                                error: function(){
                                    alert('error marking seen');
                                }
                            });

                        },
                        error: function(){
                            alert('error getting message');
                        }
                    });

        });
    });
</script>
	   

<div class="col-sm-4" id="chatmain">
	
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading" id="chattoggle">
                    <span class="glyphicon glyphicon-comment"></span> Chat With <span id="chattername"></span>
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
                <div class="panel-footer" id="chatfooter" style="width: 100%;">
                        <input id="msginput" class="msginput" type="text" class="form-control input-sm" placeholder="Type your message here..." style="width: 100%;">
                        <span id="senderid"></span>
                   
                </div>

        <script type="text/javascript">
                $(document).ready(function(){
                    $("#msginput").keydown(function(event){
                        if(event.keyCode == 13){
                            event.preventDefault();
                            var msg = $("#msginput").val();
                            jQuery.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>" + "admin/sendmessage/" + $("#senderid").val(),
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
                        }
                     });
                });
                </script>

            </div>
        </div>

</div>






