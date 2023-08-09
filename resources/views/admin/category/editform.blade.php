<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">
        <h4>Language</h4>
    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Category Name </label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('category_name', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.category_name', 1),
            ]) !!}
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Description </label>
        <div class="col-lg-12 fv-row">
            {!! Form::textarea('description', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.description', 1),
            ]) !!}
        </div>
    </div>

    <div class="col-lg-12 fv-row">

        {!! Form::text('language_id', null, [
            'min' => 2,
            'max' => 6,
            'value' => 2,
            'class' => 'form-control form-control-lg form-control-solid',
            'placeholder' => trans_choice('content.category_name', 1),
        ]) !!}

    </div>

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\EditCategoryRequest', 'form') !!}
@endpush