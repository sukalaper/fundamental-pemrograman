<script type="text/javascript">
	$(document).ready(function(){
		$("#data").load("insiden/data_insiden.php");
		$("#id-breadcrumbs").html("insiden");
	});
	
	function tambahForm(){
		$("#form-nest").css({display:"block"});
		$.ajax({
			type:"GET",
			url:"insiden/tambah_insiden.php",
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
				$("#data").load("insiden/data_insiden.php");
			}
		});
		return false;
	}

	function deleteData(id,name){
		var pilih = confirm('hapus '+name+' dari daftar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'insiden/hapus_insiden.php',
					data:"id_insiden="+id,
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

	function deleteDetail(id,name){
		var pilih = confirm('hapus '+name+' dari daftar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'insiden/hapus_detail_insiden.php',
					data:"id_detail_insiden="+id,
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
		$("#form-nest").css({display:"block"});
		$.ajax({
			type:"GET",
			url:'insiden/edit_insiden.php',
			data:"id_insiden="+id,
			beforeSend:function(){
				$("#form").html("<img src='assets/images/ajax-loader.gif' />");
			},
			success:function(data){
				$('#form').html(data);
			}
		});
		$('#form').fadeIn(3000);
	}

	function tambahkorban(id){
		$("#form-nest").css({display:"block"});
		$.ajax({
			type:"GET",
			url:'insiden/tambah_detail_insiden.php',
			data:"id_insiden="+id,
			beforeSend:function(){
				$("#form").html("<img src='assets/images/ajax-loader.gif' />");
			},
			success:function(data){
				$('#form').html(data);
				$("#data").load("insiden/data_insiden.php");
			}
		});
		$('#form').fadeIn(3000);
	}

	function detail(id){
		$.ajax({
			type:"GET",
			url:'insiden/detail.php',
			data:"id_insiden="+id,
			beforeSend:function(){
				$("#data").html("<img src='assets/images/ajax-loader.gif' />");
			},
			success:function(data){
				$('#data').html(data);
			}
		});
		$('#data').fadeIn(3000);	
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

