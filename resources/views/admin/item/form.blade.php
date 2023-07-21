<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Item Name</label>

        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="item_name">
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Item Price</label>

        <div class="col-lg-4 fv-row">
            <input type="number" class="form-control form-control-lg form-control-solid" name="item_price">
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Discount Price</label>

        <div class="col-lg-4 fv-row">
            <input type="number" class="form-control form-control-lg form-control-solid" name="dis_item_price">
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Category</label>

        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-solid" name="category_name">
                <option value="">Select Category</option>
                @foreach ($categories as $data)
                    <option value="{{ $data->cat_id }}">{{ $data->category_name }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Item Image</label>

        <div class="col-lg-4 fv-row">
            <input type="file" class="form-control form-control-lg form-control-solid" name="item_image"
                accept=".png, .jpg, .jpeg">
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Publish</label>
        <div class="col-lg-4 fv-row">
            <select name="item_publish" class="form-control form-control-lg form-control-solid">
                <option value="">Select Yes / No</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

    </div>

    <div class="row mt-6">
            <table class="table table-bordered" id="dynamicAddRemove">
                <div class="row mb-6">
                    <div class="col-lg-4 fv-row">
                        <button type="button" name="add" id="dynamic-ar" class="btn btn-primary mt-2">Add
                            size</button>
                    </div>
                </div>
            </table>
    </div>

    <div class="row mt-6">
            <table class="table table-bordered" id="dynamicAddaddons">
                <div class="row mb-6">
                    <div class="col-lg-4 fv-row">
                        <button type="button" name="add" id="dynamic-addons" class="btn btn-primary mt-2">Add addons</button>
                    </div>
                </div>
            </table>
    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Description</label>
        <div class="col-lg-12 fv-row">
            <textarea name="item_description" class="form-control form-control-lg form-control-solid"></textarea>
        </div>
    </div>

</div>
<!--end::Card body-->


@push('scripts')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>


    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function() {
            ++i;
            $("#dynamicAddRemove").append(
                '<tr><td><div  style="margin-left:2rem;"></div></td><td><div class="col-md-10 fv-row" style="margin-left:22%;"><label class="col-lg-2 col-form-label required fw-bold fs-6">Size</label><input type="text"name="add_size[]" placeholder="Enter Size" class="form-control form-control-lg form-control-solid" /></div></td><div  style="margin-left:4rem;"></div> <td><div class="col-md-10 fv-row" style="margin-left:22%;"><label class="col-lg-4 col-form-label required fw-bold fs-6">Price</label><input type="text" name="add_price[]" placeholder="Enter Price" class="form-control form-control-lg form-control-solid" /></div></td><td><div style="margin-top:35px;"><button type="button" class="btn btn-danger remove-input-field" style="margin-left:15%;" >Delete</button></div></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });
    </script>

    <script type="text/javascript">
        var i = 0;
        $("#dynamic-addons").click(function() {
            ++i;
            $("#dynamicAddaddons").append(
                '<tr><td><div  style="margin-left:2rem;"></div></td><td><div class="col-md-10 fv-row" style="margin-left:22%;"><label class="col-lg-2 col-form-label required fw-bold fs-6">Title</label><input type="text"name="addons_title[]" placeholder="Enter Title" class="form-control form-control-lg form-control-solid" /></div></td><div  style="margin-left:4rem;"></div> <td><div class="col-md-10 fv-row" style="margin-left:22%;"><label class="col-lg-4 col-form-label required fw-bold fs-6">Price</label><input type="text" name="addons_price[]" placeholder="Enter Price" class="form-control form-control-lg form-control-solid" /></div></td><td><div style="margin-top:35px;"><button type="button" class="btn btn-danger remove-add-addons" style="margin-left:15%;" >Delete</button></div></td></tr>'
            );
        });
        $(document).on('click', '.remove-add-addons', function() {
            $(this).parents('tr').remove();
        });
    </script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\ItemRequest', 'form') !!}
@endpush