<?php
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM `land` where id = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();
        foreach ($res as $k => $v) {
            if (!is_numeric($k))
                $$k = $v;
        }
    }
}
?>
<div class="content py-3">
    <div class="card card-outline card-primary shadow rounded-0">
        <div class="card-header">
            <h3 class="card-title"><b>
                    <?= isset($id) ? "Update Land Details - " . $id : "New Land" ?>
                </b></h3>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <form action="" id="land_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                    <fieldset class="border-bottom">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="land_type" class="control-label">Type of Land</label>
                                <select name="land_type" id="land_type"
                                    value="<?= isset($land_type) ? $land_type : "" ?>"
                                    class="form-control form-control-sm rounded-0" required>
                                    <option <?= isset($land_type) && $land_type == 'Lease' ? 'selected' : '' ?>>Lease
                                    </option>
                                    <option <?= isset($land_type) && $land_type == 'Free hold' ? 'selected' : '' ?>>Free
                                        hold</option>
                                    <option <?= isset($land_type) && $land_type == 'Mailo' ? 'selected' : '' ?>>Mailo
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="roll" class="control-label">Block Number</label>
                                <input type="text" name="roll" id="roll"
                                    value="<?= isset($roll) ? $roll : "" ?>"
                                    class="form-control form-control-sm rounded-0" placeholder='Block Number'>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="amount" class="control-label">Amount in Ugx(Price)</label>
                                <input type="text" name="amount" id="amount"
                                    value="<?= isset($amount) ? $amount : "" ?>"
                                    class="form-control form-control-sm rounded-0" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="land_owner_first_name" class="control-label">Land Owner First Name</label>
                                <input type="text" name="land_owner_first_name" id="land_owner_first_name"
                                    value="<?= isset($land_owner_first_name) ? $land_owner_first_name : "" ?>"
                                    class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="land_owner_last_name" class="control-label">Land Owner Last Name</label>
                                <input type="text" name="land_owner_last_name" id="land_owner_last_name"
                                    value="<?= isset($land_owner_last_name) ? $land_owner_last_name : "" ?>"
                                    class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="land_owner_contact_name" class="control-label">Land Owner`s Contact
                                    Number</label>
                                <input type="text" name="land_owner_contact" id="land_owner_contact"
                                    value="<?= isset($land_owner_contact) ? $land_owner_contact : "" ?>"
                                    class="form-control form-control-sm rounded-0" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="dob" class="control-label">Date of Input</label>
                                <input type="date" name="dob" id="dob" value="<?= isset($dob) ? $dob : "" ?>"
                                    class="form-control form-control-sm rounded-0" required>
                            </div>
                            <form action="handler.php" id="land_form" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-4">
                                <label for="documents" class="control-label">Land Documents</label>
                    
                                    <input type="file"  id="documents" name="documents">
                                </div>
                                <div class="form-group col-md-4">
                                <label for="land_image" class="control-label">Land Image</label>
                                    <input type="file"  id="land_image" name="land_image">
                                </div>
                            </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="Address" class="control-label">Land Location</label>
                                <textarea rows="3" name="Address" id="Address"
                                    class="form-control form-control-sm rounded-0"
                                    required><?= isset($Address) ? $Address : "" ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="details" class="control-label">More details on the Land</label>
                                <textarea rows="3" name="details" id="details"
                                    class="form-control form-control-sm rounded-0"
                                    required><?= isset($details) ? $details : "" ?></textarea>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-flat btn-primary btn-sm" type="submit" form="land_form">Save Land Details</button>
            <a href="./?page=Land" class="btn btn-flat btn-default border btn-sm">Cancel</a>
        </div>
    </div>
</div>
<script>
    function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#land_image').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
    $(function () {
        $('#land_form').submit(function (e) {
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
            el.addClass("pop-msg alert")
            el.hide()
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_land",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.log(err)
                    alert_toast("An error occured", 'error');
                    end_loader();
                },
                success: function (resp) {
                    if (resp.status == 'success') {
                        location.href = "./?page=Land/view_land&id=" + resp.id;
                    } else if (!!resp.msg) {
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    } else {
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html,body,.modal').animate({ scrollTop: 0 }, 'fast')
                    end_loader();
                }
            })
        })
    })
</script>