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
            <select class="form-control form-control-solid" name="store_name">
                <option value="">Select Store Name</option>
                @foreach ($stores as $data)
                    <option value="{{ $data->store_id }}">{{ $data->store_name }}</option>
                @endforeach
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

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Status</label>
        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-solid" name="store_name">
                <option value="">Select Activate/Deactivate</option>
                <option value="0">Deactive</option>
                <option value="1">Active</option>
            </select>
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-4 col-form-label required fw-bold fs-6">Driver Description</label>
        <div class="col-lg-12 fv-row">
            <textarea class="form-control form-control-lg form-control-solid" name="driver_address"
                placeholder="Driver Description"></textarea>
        </div>
    </div>

    <div class="row mb-6">
        <h1>Car Details</h1>
    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Car Number</label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="car_number"
                placeholder="Car Number" />
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Car Name</label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="car_name"
                placeholder="Car Name" />
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Car Image</label>
        <input type="file" class="form-control form-control-lg form-control-solid" name="car_image"
            accept=".png, .jpg, .jpeg">
    </div>

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\DriverRequest', 'form') !!}
@endpush
