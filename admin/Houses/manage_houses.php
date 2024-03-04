<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `houses` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<div class="content py-3">
    <div class="card card-outline card-primary shadow rounded-0">
        <div class="card-header">
            <h3 class="card-title"><b><?= isset($id) ? "Update House Details - ". $id : "New House" ?></b></h3>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <form action="" id="house_form" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                    <fieldset class="border-bottom">
                    <div class="row">
                            <div class="form-group col-md-4">
                                <label for="roll" class="control-label">House Unique ID</label>
                                <input type="text" name="roll" id="roll" autofocus value="<?= isset($roll) ? $roll : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-4">
                        <label for="house_type" class="control-label">House Type</label>
                                <select name="house_type" id="house_type" value="<?= isset($house_type) ? $house_type : "" ?>" class="form-control form-control-sm rounded-0" required>
                                    <option <?= isset($house_type) && $house_type == 'Rentals' ? 'selected' : '' ?>>Rentals</option>
                                    <option <?= isset($house_type) && $house_type== 'Apartments' ? 'selected' : '' ?>>Apartments</option>
                                    <option <?= isset($house_type) && $house_type== 'Standalone' ? 'selected' : '' ?>>Standalone</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                            <label for="options" class="control-label">Lease Option</label>
                                <select name="options" id="options" value="<?= isset($options) ? $options : "" ?>" class="form-control form-control-sm rounded-0" required>
                                    <option <?= isset($options) && $options == 'For rent' ? 'selected' : '' ?>>For rent</option>
                                    <option <?= isset($options) && $options == 'For sale' ? 'selected' : '' ?>>For sale</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="house_image" class="control-label">House Image</label>
                                <input type="file" name="house_image" id="house_image" autofocus value="<?= isset($house_image) ? $house_image : "" ?>">
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-4">
                                <label for="house_owner_first_name" class="control-label">House Owner First Name</label>
                                <input type="text" name="house_owner_first_name" id="house_owner_first_name" value="<?= isset($land_owner_first_name) ? $land_owner_first_name : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-4">
                            <label for="house_owner_last_name" class="control-label">House Owner Last Name</label>
                                <input type="text" name="house_owner_last_name" id="house_owner_last_name" value="<?= isset($land_owner_last_name) ? $land_owner_last_name : "" ?>" class="form-control form-control-sm rounded-0" required>                            </div>
                            <div class="form-group col-md-4">
                            <label for="house_owner_contact" class="control-label">Land Owner`s Contact Number</label>
                                <input type="text" name="house_owner_contact" id="house_owner_contact" value="<?= isset($land_owner_contact) ? $land_owner_contact : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="dob" class="control-label">Date of Input</label>
                                <input type="date" name="dob" id="dob" value="<?= isset($dob) ? $dob : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="contact" class="control-label">House Documents(optional) </label>
                                <input type="file" name="documents" id="documents" value="<?= isset($documents) ? $documents : "" ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="amount" class="control-label">Amount for Sale/Rent</label>
                                <input type="text" name="amount" id="amount" value="<?= isset($amount) ? $amount : "" ?>" class="form-control form-control-sm rounded-0" placeholder='Amount'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="address" class="control-label">House Location</label>
                                <textarea rows="3" name="address" id="address" class="form-control form-control-sm rounded-0" required><?= isset($address) ? $address : "" ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="details" class="control-label">More details on the House</label>
                                <textarea rows="3" name="details" id="details" class="form-control form-control-sm rounded-0" required><?= isset($details) ? $details : "" ?></textarea>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-flat btn-primary btn-sm" type="submit" form="house_form">Save House Details</button>
            <a href="./?page=Houses" class="btn btn-flat btn-default border btn-sm">Cancel</a>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#house_form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_house",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        location.href="./?page=Houses/view_houses&id="+resp.sid;
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html,body,.modal').animate({scrollTop:0},'fast')
                    end_loader();
                }
            })
        })
    })
</script>