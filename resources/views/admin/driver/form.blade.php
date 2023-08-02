<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Name</label>

        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="driver_name"
                placeholder="Driver name" />
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Image</label>

        <div class="col-lg-4 fv-row">
            <input type="file" class="form-control form-control-lg form-control-solid" name="driver_image"
                accept=".png, .jpg, .jpeg" />
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Name</label>

        <div class="col-lg-4 fv-row">
            <select name="store_name" class="form-control form-control-lg form-control-solid">
                <option value="">Select Store Name</option>
                <option value="0">medical</option>
                <option value="1">toy</option>
            </select>
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Phone Number</label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="driver_phone_number"
                placeholder="Driver Phone Number" />
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Email</label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="driver_email"
                placeholder="Driver Email" />
        </div>
    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Description</label>
        <div class="col-lg-12 fv-row">
            <textarea class="form-control form-control-lg form-control-solid" name="driver_address"
                placeholder="Driver Description"></textarea>
        </div>
    </div>

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\DriverRequest', 'form') !!}
@endpush
