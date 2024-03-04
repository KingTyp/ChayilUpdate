<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `land` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<div class="content py-4">
    <div class="card card-outline card-navy shadow rounded-0">
        <div class="card-header">
            <h5 class="card-title">Land Details</h5>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary btn-flat" href="./?page=land/manage_land&id=<?= isset($id) ? $id : '' ?>"><i class="fa fa-edit"></i> Edit</a>
                <button class="btn btn-sm btn-danger btn-flat" id="delete_land"><i class="fa fa-trash"></i> Delete</button>
                <button class="btn btn-sm btn-info bg-info btn-flat" type="button" id="update_status">Update Status</button>
                <a href="./?page=land" class="btn btn-default border btn-sm btn-flat"><i class="fa fa-angle-left"></i> Back to List</a>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid" id="outprint">
                <style>
                    #sys_logo{
                        width:5em;
                        height:5em;
                        object-fit:scale-down;
                        object-position:center center;
                    }
                </style>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label text-muted">Type of Land</label>
                            <div class="pl-4"><?= isset($land_type) ? $land_type : 'N/A' ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label text-muted">Status</label>
                            <div class="pl-4">
                                <?php 
                                    switch ($status){
                                        case 0:
                                            echo '<span class="rounded-pill badge badge-secondary bg-gradient-secondary px-3">Sold</span>';
                                            break;
                                        case 1:
                                            echo '<span class="rounded-pill badge badge-primary bg-gradient-primary px-3">Available</span>';
                                            break;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <fieldset class="border-bottom">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-muted">Block number</label>
                                <div class="pl-4"><?= isset($roll) ? $roll : 'N/A' ?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-muted">Date of Input</label>
                                <div class="pl-4"><?= isset($dob) ? date("M d, Y",strtotime($dob)) : 'N/A' ?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label text-muted">Owner`s Contact</label>
                                <div class="pl-4"><?= isset($land_owner_contact) ? $land_owner_contact : 'N/A' ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label text-muted">Land Location</label>
                                <div class="pl-4"><?= isset($Address) ? $Address : 'N/A' ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label text-muted">More details on the Land</label>
                                <div class="pl-4"><?= isset($details) ? $details : 'N/A' ?></div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="text-muted">Information on the Land</legend>
                    <table class="table table-stripped table-bordered" id="land">
                        <colgroup>
                            <col width="5%">
                            <col width="25%">
                            <col width="20%">
                            <col width="10%">
                            <col width="15%">
                            <col width="15%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                            <tr class="bg-gradient-dark">
                                <th class="py-1 text-center">Land ID</th>
                                <th class="py-1 text-center">Land Document</th>
                                <th class="py-1 text-center">Land Image</th>
                                <th class="py-1 text-center">Owner`s First Name</th>
                                <th class="py-1 text-center">Owner`s Last Name</th>
                                <th class="py-1 text-center">Status</th>
                                <th class="py-1 text-center">Amount in Ugx(Price)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i= 1;
                            $academics = $conn->query("SELECT land.* FROM `land` where id=$id ");
                            while($row = $academics->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="px-2 py-1 align-middle text-center"><?= $i++; ?></td>
                                <td class="px-2 py-1 align-middle">
                                    <small><span class=""><?= $row['documents'] ?></span></small>
                                    
                                </td>
                                <td>
                                <div class="form-group col-6 d-flex justify-content-center">
					               <img src="<?php echo validate_image(isset($meta['land_image']) ? $meta['land_image'] :'') ?>" alt="" id="land_image" class="img-fluid img-thumbnail">
				                </div>
                                </td>
                               
                                <td class="px-2 py-1 align-middle">
                                    <small><span class=""><?= $row['land_owner_first_name'] ?></span></small>
                                </td>
                                <td class="px-2 py-1 align-middle">
                                    <small><span class=""><?= $row['land_owner_last_name'] ?></span></small>
                                <td class="px-2 py-1 align-middle text-center">
                                    <?php 
                                    switch($row['status']){
                                        case '0':
                                            echo '<span class="rounded-pill badge badge-primary px-3">Sold</span>';
                                            break;
                                        case '1':
                                            echo '<span class="rounded-pill badge badge-success px-3">Available</span>';
                                            break;
                                    }
                                    ?>
                                </td>
                                <td class="px-2 py-1 align-middle">
                                    <small><span class=""><?= $row['amount'] ?></span></small>
                                </td>
                                
                            </tr>
                            
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </div>
    </div>
</div>
<noscript id="print-header">
    <div class="row">
        <div class="col-2 d-flex justify-content-center align-items-center">
            <img src="<?= validate_image($_settings->info('logo')) ?>" class="img-circle" id="sys_logo" alt="System Logo">
        </div>
        <div class="col-8">
            <h4 class="text-center"><b><?= $_settings->info('name') ?></b></h4>
            <h3 class="text-center"><b>Land Records</b></h3>
        </div>
        <div class="col-2"></div>
    </div>
</noscript>
<script>
    $(function() {
        $('#update_status').click(function(){
            uni_modal("Update Status of <b><?= isset($roll) ? $roll : "" ?></b>","land/update_status.php?land_id=<?= isset($id) ? $id : "" ?>")
        })
        $('#delete_land').click(function(){
			_conf("Are you sure to delete this Land Information?","delete_land",['<?= isset($id) ? $id : '' ?>'])
		})
        $('.view_data').click(function(){
			uni_modal("Report Details","students/view_report.php?id="+$(this).attr('data-id'),"mid-large")
		})
        $('.table td, .table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });
        $('#print').click(function(){
            start_loader()
            $('#academic-history').dataTable().fnDestroy()
            var _h = $('head').clone()
            var _p = $('#outprint').clone()
            var _ph = $($('noscript#print-header').html()).clone()
            var _el = $('<div>')
            _p.find('tr.bg-gradient-dark').removeClass('bg-gradient-dark')
            _p.find('tr>td:last-child,tr>th:last-child,colgroup>col:last-child').remove()
            _p.find('.badge').css({'border':'unset'})
            _el.append(_h)
            _el.append(_ph)
            _el.find('title').text(' Records - Print View')
            _el.append(_p)


            var nw = window.open('','_blank','width=1000,height=900,top=50,left=200')
                nw.document.write(_el.html())
                nw.document.close()
                setTimeout(() => {
                    nw.print()
                    setTimeout(() => {
                        nw.close()
                        end_loader()
                        $('.table').dataTable({
                            columnDefs: [
                                { orderable: false, targets: 5 }
                            ],
                        });
                    }, 300);
                }, (750));
                
            
        })
    })
    function delete_academic($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_academic",
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
					location.href="./?page=Land";
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
