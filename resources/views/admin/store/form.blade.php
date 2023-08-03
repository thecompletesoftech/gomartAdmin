<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Name</label>

        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="store_name"
                placeholder="Store name" />
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Image</label>

        <div class="col-lg-4 fv-row">
            <input type="file" class="form-control form-control-lg form-control-solid" name="store_image"
                accept=".png, .jpg, .jpeg" />
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Name</label>

        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-solid" name="category_name">
                <option value="">Select Category</option>
                @foreach ($categories as $data)
                    <option value="{{ $data->cat_id }}">{{ $data->category_name }}</option>
                @endforeach
            </select>
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Phone</label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="store_phone"
                placeholder="Store Phone" />
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Address </label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="store_address"
                placeholder="Store Address" />
        </div>
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Latitude</label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="store_latitude"
                placeholder="Store Latitude" />
        </div>
    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Longititude</label>
        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="store_longitude"
                placeholder="Store Longitude" />
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Opening Time</label>
        <div class="col-lg-4 fv-row">
            <input type="time" class="form-control form-control-lg form-control-solid" name="store_opening_time"
                placeholder="Store Opening Time" />
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Closing Time</label>
        <div class="col-lg-4 fv-row">
            <input type="time" class="form-control form-control-lg form-control-solid" name="store_closing_time"
                placeholder="Store Closing Time" />
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Status</label>
        <div class="col-lg-4 fv-row">
            <select name="store_status" class="form-control form-control-lg form-control-solid">
                <option value="">Select Status</option>
                <option value="0">Close</option>
                <option value="1">Open</option>
            </select>
        </div>
    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Active</label>
        <div class="col-lg-4 fv-row">
            <select name="store_active" class="form-control form-control-lg form-control-solid">
                <option value="">Select Enable/Disable</option>
                <option value="0">enable</option>
                <option value="1">disable</option>
            </select>
        </div>
    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Description</label>
        <div class="col-lg-12 fv-row">
            <textarea class="form-control form-control-lg form-control-solid" name="store_description"
                placeholder="Driver Description"></textarea>
        </div>
    </div>

</div>

<div class="row mb-6">
    <h1 class="ml-5">Gallery </h1>
</div>

<div class="card-body">
    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Gallery Image</label>

        <div class="col-lg-4 fv-row">
            <input type="file" class="form-control form-control-lg form-control-solid" name="gallery_image"
                accept=".png, .jpg, .jpeg" />
        </div>

    </div>
</div>

<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\StoreRequest', 'form') !!}
@endpush
