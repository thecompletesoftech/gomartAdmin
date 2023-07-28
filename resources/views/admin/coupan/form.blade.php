<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Coupan Code</label>

        <div class="col-lg-4 fv-row">
            <input type="text" class="form-control form-control-lg form-control-solid" name="coupan_code">
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Amount</label>
        <div class="col-lg-4 fv-row">
            <input type="number" class="form-control form-control-lg form-control-solid" name="amount">
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Discount</label>

        <div class="col-lg-4 fv-row">
            <input type="number" class="form-control form-control-lg form-control-solid" name="discount">
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Expiry Date</label>

        <div class="col-lg-4 fv-row">
            <input type="date" class="form-control form-control-lg form-control-solid" name="expiry_date">
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Coupan Status</label>
        <div class="col-lg-4 fv-row">
            <select name="coupan_status" class="form-control form-control-lg form-control-solid">
                <option value="">Select Active/Deactive</option>
                <option value="0">active</option>
                <option value="1">Deactive</option>
            </select>
        </div>
    </div>

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\CoupanRequest', 'form') !!}
@endpush