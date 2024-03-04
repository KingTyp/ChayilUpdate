<style>
    .img-thumb-path{
        width:100px;
        height:80px;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<div class="card card-outline card-primary rounded-0 shadow">
	<div class="card-header">
		<h3 class="card-title">List of Land Available for sale</h3>
		<div class="card-tools">
			<a href="./?page=Land/manage_land" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-plus"></span>  Add New Land Details</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="20%">
					<col width="25%">
					<col width="15%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr class="bg-gradient-dark text-light">
						<th>No</th>
						<th>Date of Input</th>
						<th>Property Type</th>
						<th>Owner`s Name</th>
						<th>Block Number</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
						$i = 1;
						$qry = $conn->query("SELECT *, CONCAT(land_owner_last_name, ', ', land_owner_first_name) AS fullname from `land` ORDER BY CONCAT(land_owner_last_name, ', ', land_owner_first_name) ASC");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><?php echo date("Y-m-d H:i",strtotime($row['dob'])) ?></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['land_type'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['fullname'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['roll'] ?></p></td>
							<td class="text-center">
								<?php 
									switch ($row['status']){
										case 0:
											echo '<span class="rounded-pill badge badge-danger bg-gradient-danger px-3">Sold</span>';
											break;
										case 1:
											echo '<span class="rounded-pill badge badge-success bg-gradient-success px-3">Available</span>';
											break;
									}
								?>
							</td>
							<td align ="center">
								 <a href="./?page=land/view_land&id=<?= $row['id'] ?>" class="btn btn-flat btn-default btn-sm border"><i class="fa fa-eye"></i> View</a>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.table td, .table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });
	})
	function delete_land($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_land",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>