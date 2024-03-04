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
                <form action="handler.php" id="land_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" class="form-control">
                    <fieldset class="border-bottom">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>First Name:</label>
                                <input type="text" name="First_Name" id="First_Name" class="form-control"
                                    aria-label="first Name" placeholder="Land Owner`s First Name!" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Last Name:</label>
                                <input type="text" name="Last_Name" id="Last_Name" class="form-control"
                                    aria-label="last Name" placeholder="Land Owner`s Last Name!" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Land Address:</label>
                                <input type="text" name="address" id="address" class="form-control" aria-label="address"
                                    placeholder="Land Address" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Block Number:</label>
                                <input type="text" name="roll" id="roll" class="form-control" aria-label="roll"
                                    placeholder="Block Number" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Land Type:</label>
                                <select class="form-control" name="land_type" id="land_type" aria-label="land_type"
                                    placeholder="land_type" required>
                                    <option value="">Select Type</option>
                                    <option value="Mailo">Mailo</option>
                                    <option value="Free hold">Free hold</option>
                                    <option value="Lease">Lease</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Date of Input:</label>
                                <input type="date" name="dob" id="dob" class="form-control" aria-label="dob"
                                    placeholder="Date of Input" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Amount in Ugx(Price):</label>
                                <input type="amount" name="amount" id="amount" class="form-control" aria-label="amount"
                                    placeholder="Use commas after 3 zeros!" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact number:</label>
                                <input type="text" name="land_owner_contact" id="land_owner_contact"
                                    class="form-control" aria-label="land_owner_contact"
                                    placeholder="land_owner_contact" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Status:</label>
                                <select class="form-control" name="status" id="status" aria-label="status"
                                    placeholder="status" required>
                                    <option value="">Select Status</option>
                                    <option value="Available">Available</option>
                                    <option value="Sold">Sold</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="details" class="control-label">More details on the Land</label>
                                <textarea rows="3" name="details" id="details"
                                    class="form-control form-control-sm rounded-0"
                                    required></textarea>
                            </div>
                        </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="land_image"> Land Image:</label>
                        <input type="file" name="land_image" id="land_image" class="form-control"
                            aria-label="land_image" placeholder="Land Image" required>
                    </div>
                    <div class="col">
                        <label>Land Document:</label>
                        <input type="file" name="documents" id="documents" class="form-control" multiple required>
                    </div>
                </div>
            </div>
            </fieldset>
            </form>
        </div>
    </div>
    <div class="card-footer text-right">
            <button class="btn btn-flat btn-primary btn-sm" type="submit"name="submit" id="land_form">Save Land Details</button>
            <a href="./?page=Land" class="btn btn-flat btn-default border btn-sm">Cancel</a>
        </div>
    </div>
</div>
<!--script>
    $(function () {
        $('#save_land_details').click(function (e) {
            e.preventDefault();
            var _this = $(this);
            $('.pop-msg').remove();
            var el = $('<div>');
            el.addClass("pop-msg alert");
            el.hide();
            start_loader();
            $.ajax({
                url: $('#land_form').attr('action'),
                data: new FormData($('#land_form')[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    alert("An error occurred: " + error);
                    end_loader();
                },
                success: function (resp) {
                    if (response.status == 'success') {
                        el.addClass("alert-success");
                    } else {
                        el.addClass("alert-danger");
                    }
                    el.text(response.msg);
                    _this.closest('.card').prepend(el);
                    el.show('slow');
                    $('html,body,.modal').animate({ scrollTop: 0 }, 'fast');
                    end_loader();
                }
            });
        });
    });
</script>