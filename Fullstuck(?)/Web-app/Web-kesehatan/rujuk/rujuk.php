<script type="text/javascript">
	$(document).ready(function(){
		$("#data").load("rujuk/data_rujuk.php");
		$("#id-breadcrumbs").html("rujuk");
	});
	
	function tambahForm(){
		$("#form-nest").css({display:"block"});
		$.ajax({
			type:"GET",
			url:"rujuk/tambah_rujuk.php",
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
				$("#data").load("rujuk/data_rujuk.php");
			}
		});
		return false;
	}
	
	function deleteData(id,rujuk){
		var pilih = confirm('hapus '+rujuk+' dari daftar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'rujuk/hapus_rujuk.php',
					data:"id_rujuk="+id,
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
			url:'rujuk/edit_rujuk.php',
			data:"id_rujuk="+id,
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