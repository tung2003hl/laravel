<form id="form1">
    <div class="form-group">
        <div class="col-md-12"><strong>Address:</strong></div>
        <div class="col-md-12">
            <input type="text" name="address" class="form-control" value="" required />
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12"><strong>Name:</strong></div>
        <div class="col-md-12">
            <input type="text" name="name" class="form-control" value="" required />
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12"><strong>Address:</strong></div>
        <div class="col-md-12">
            <input type="text" name="note" class="form-control" value="" required />
        </div>
    </div>
</form>

<form id="form2">
    <div class="form-group">
        <div class="col-md-12"><strong>Address:</strong></div>
        <div class="col-md-12">
            <input type="text" name="address" class="form-control" value="" required />
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12"><strong>Name:</strong></div>
        <div class="col-md-12">
            <input type="text" name="name" class="form-control" value="" required />
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12"><strong>Address:</strong></div>
        <div class="col-md-12">
            <input type="text" name="note" class="form-control" value="" required />
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Lấy tất cả các trường input có cùng tên trong form 1 và form 2
        var $form1Inputs = $("#form1 input");
        var $form2Inputs = $("#form2 input");

        // Theo dõi sự thay đổi trong tất cả các trường input của form 1
        $form1Inputs.on("input", function () {
            // Lấy giá trị của trường input trong form 1
            var value = $(this).val();

            // Cập nhật tất cả trường input có cùng tên trong form 2
            $form2Inputs.filter('[name="' + this.name + '"]').val(value);
        });
    });
</script>
