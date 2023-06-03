<script type="text/javascript">
	$(document).ready(function(){
		$("#data").load("poskotis/data_poskotis.php");
		$("#id-breadcrumbs").html("poskotis");
	});
	
	function tambahForm(){
		$("#form-nest").css({display:"block"});
		$.ajax({
			type:"GET",
			url:"poskotis/tambah_poskotis.php",
			data:null,
			beforeSend:function(){
				$("#form").html("<img src='assets/images/ajax-loader.gif' />");
			},
			success:function(data){
				$('#form').html(data);
			}
		});
		$('#form').show("slow");
	}
	
	function submitForm(url){
		var thisPost = $("#forms").serialize();
		$.ajax({
			type:"POST",
			url:url,
			data:thisPost,
			beforeSend:function(){
				$("#form").html("<img src='assets/images/ajax-loader.gif' />");
				$("#data").html("<img src='assets/images/ajax-loader.gif' />");
			},
			success:function(data){
				$('#form').html(data);
				$("#data").load("poskotis/data_poskotis.php");
			}
		});
		return false;
	}
	
	function deleteData(id,poskotis){
		var pilih = confirm('hapus '+poskotis+' dari daftar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'poskotis/hapus_poskotis.php',
					data:"id_poskotis="+id,
					beforeSend:function(){
						$("#data").html("<img src='assets/images/ajax-loader.gif' />");
					},
					success:function(data){
						$('#data').html(data);
						$("#alert").html("<div id='alert' class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>Data berhasil di hapus</div>");
					},
					error:function(data){
						$("#alert").html("<div id='alert' class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button>Data gagal di hapus</div>");
					}
				});
		}
	}
	
	function editData(id){
		$.ajax({
			type:"GET",
			url:'poskotis/edit_poskotis.php',
			data:"id_poskotis="+id,
			beforeSend:function(){
				$("#form-nest").css({display:"block"});
				$("#form").html("<img src='assets/images/ajax-loader.gif' />");
			},
			success:function(data){
				$('#form').html(data);
			}
		});
		$('#form').fadeIn(3000);
	}
	
	
</script>


<div id="form-nest" class="row-fluid" style="display:none">
	<div id="form" class="span12 well">
		
	</div>
</div>

<div class="row-fluid">
	<div id="data" class="span12 well">
		<img src='assets/images/ajax-loader.gif' />
	</div>
</div>