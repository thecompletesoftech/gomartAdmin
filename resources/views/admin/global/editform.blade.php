<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Application Name</label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('application_name', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.application_name', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Application Color</label>
        <div class="col-lg-4 fv-row">
            {!! Form::color('application_color', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.application_color', 1),
            ]) !!}
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Application Logo</label>
        <div class="col-lg-4 fv-row">
            @if ($globalsetting->global_id)
                <input type="file" class="form-control form-control-lg form-control-solid" name="application_logo"
                    accept=".png, .jpg, .jpeg">
                <img src={{ env('APP_URL') }}/uploads/{{ $globalsetting->application_logo }}
                    style="width:50px; height:50px; border-radius:1rem;" />
            @else
                <input type="file" class="form-control form-control-lg form-control-solid" name="application_logo"
                    accept=".png, .jpg, .jpeg">
            @endif
        </div>
    </div>

</div>

<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\GlobalSettingRequest', 'form') !!}
@endpush
