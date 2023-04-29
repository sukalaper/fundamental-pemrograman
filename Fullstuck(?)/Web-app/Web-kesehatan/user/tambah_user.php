<?php $foto = 'user/img_user/profile-icon.png'; ?>
<form name="multiform" id="multiform" class="form-horizontal" action="user/multi-form-submit.php" method="POST" enctype="multipart/form-data">
	<div id="alert"></div>
	<fieldset>
		<legend>Tambah User</legend>
		<div class="row-fluid">
			<div class="span5">
				<div class="control-group">
					<label class="control-label" for="inputUsername">Username</label>
					<div class="controls">
						<input type="text" id="username" name="username" autocomplite="off" required autofocus />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword" >Password</label>
					<div class="controls">
						<input type="password" id="" name="password" autocomplete="off" required />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputNamaLengkap" >Nama Lengkap</label >
					<div class="controls">
						<input type="text" id="" name="nama_lengkap" autocomplete="off" required />
					</div>
				</div>
			
			<div class="control-group">
					<label class="control-label" for="inputEmail" >Email</label>
					<div class="controls">
						<input type="email" id="" name="email" autocomplete="off" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputNoTelp" >No.Telp.</label>
					<div class="controls">
						<input type="text" id="" name="no_telp" autocomplete="off" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"> Level</label>
						<div class="controls">
							<label>
								<input name="level" type="radio" value="administrator" />
								<span class="lbl"> Administrator</span>
							</label>
							<label>
								<input name="level" type="radio" value="admin" />
								<span class="lbl"> Admin</span>
							</label>
						</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="poskotis" > Poskotis</label>
					<div class="controls">
					<select name="poskotis" id="poskotis" required class="chzn-select" data-placeholder="Pilih Poskotis.............">
						<option value=""></option>
						<?php
							require_once '../config/koneksi.php';
							require_once '../user/class.user.php';
							$user = new user($pdo);					
							$query = "SELECT * FROM poskotis";
							$user->select($query);
						?>
					</select>
					</div>
				</div>
			</div>
			<div class="span5">
				<div class="control-group">
		            <label class="control-label">Foto</label>
		            <div class="controls">
			            <div id="image_preview">
			            <img id="previewing" src="<?php  echo $foto; ?>" width="250" height="250"/></div>
			            <span id='loading'></span>
		                <div id="message"></div>
	           		</div>
       			</div>
       			<div class="control-group">
					<label class="control-label" for="inputfoto" >Pilih Foto</label>
					<div class="controls">
						<input type="file" name="file" id="file"/>
					</div>
				</div>
			</div>
		</div>
		<div class="form-actions">
			<div class="controls">
				<button type="submit" class="btn btn-primary" id="multi-post">Tambah</button>
				<button type="button" id="close" class="btn btn-primary" >Tutup</button>
			</div>
		</div>
		
	</fieldset>
</form>

<script type="text/javascript">
//-----------------------------------------------------------------------------------------------------------
$(document).ready(function(){
	$("#close").click(function(){
		$("#form-nest").hide("slow");
	});
	$(".chzn-select").chosen();
});
//----------------------------------------------------------------------------------------------------------
$(function() {
        $("#file").change(function() {
            $("#message").empty(); // To remove the previous error message
            var file = this.files[0];
            var imagefile = file.type;
            var match= ["image/jpeg","image/png","image/jpg"];
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
            {
                $('#previewing').attr('src','noimage.png');
                $("#message").html("<p id='error'>Mohon Pilih File dengan benar</p>"+"<h4>Catatan</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                return false;
            }else{
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    function imageIsLoaded(e) {
        $("#file").css("color","#FFFFFF");
        $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '250px');
        $('#previewing').attr('height', '230px');
    };
//-------------------------------------------------------------------------------------------------------------
$(document).ready(function(){
 function getDoc(frame) {
     var doc = null;     
     // IE8 cascading access check
     try {
         if (frame.contentWindow) {
             doc = frame.contentWindow.document;
         }
     } catch(err) {
     }
     if (doc) { // successful getting content
         return doc;
     }
     try { // simply checking may throw in ie8 under ssl or mismatched protocol
         doc = frame.contentDocument ? frame.contentDocument : frame.document;
     } catch(err) {
         // last attempt
         doc = frame.document;
     }
     return doc;
 }
$("#multiform").submit(function(e){
	$("#multi-msg").html("<img src='assets/images/ajax-loader.gif'/>");
	var formObj = $(this);
	var formURL = formObj.attr("action");
if(window.FormData !== undefined)  // for HTML5 browsers
//	if(false)
	{	
		var formData = new FormData(this);
		$.ajax({
        	url: formURL,
	        type: 'POST',
			data:  formData,
			mimeType:"multipart/form-data",
			contentType: false,
    	    cache: false,
        	processData:false,
        	beforeSend:function(){
				$("#multiform").html("<img src='assets/images/ajax-loader.gif' />");
				$("#data").html("<img src='assets/images/ajax-loader.gif' />");
			},
			success: function(data, textStatus, jqXHR)
		    {
				$("#multiform").html(data);
				$("#data").load("user/data_user.php");
		    },
		  	error: function(jqXHR, textStatus, errorThrown) 
	    	{
				$("#alert").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
	    		
	    	} 	        
	   });
        e.preventDefault();
        e.unbind();
   }
   else  //for olden browsers
	{
		//generate a random id
		var  iframeId = 'unique' + (new Date().getTime());

		//create an empty iframe
		var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');

		//hide it
		iframe.hide();

		//set form target to iframe
		formObj.attr('target',iframeId);

		//Add iframe to body
		iframe.appendTo('body');
		iframe.load(function(e)
		{
			var doc = getDoc(iframe[0]);
			var docRoot = doc.body ? doc.body : doc.documentElement;
			var data = docRoot.innerHTML;
			$("#multiform").html(data);
			$("#data").load("user/data_user.php");
		});
	
	}

});
$("#multi-post").click(function(){
	if(document.multiform.username.value==""){
		alert("Silahkan Isi Username !");
		document.multiform.username.focus();
		return false;
		}
		if(document.multiform.password.value==""){
			alert("Silahkan Isi Password !");
			document.multiform.password.focus();
			return false;
		}
		if(document.multiform.nama_lengkap.value==""){
			alert("Silahkan Isi Nama Lengkap !");
			document.multiform.nama_lengkap.focus();
			return false;
		}
		if(document.multiform.email.value==""){
			alert("Silahkan Isi Email !");
			document.multiform.email.focus();
			return false;
		}
		if(document.multiform.level.value==""){
			alert("Silahkan Pilih Level !");
			document.multiform.level.focus();
			return false;
		}else{
		$("#multiform").submit();	
	}
});

});
</script>