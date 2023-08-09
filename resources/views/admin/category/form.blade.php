<div class="card-body">

    <!--begin::Input group-->

    @foreach ($languages as $lan)

        <div class="row mb-6">
            <h4>Language_{{ $lan->language_name }}</h4>
        </div>

        <div class="row mb-6">

            <label class="col-lg-2 col-form-label required fw-bold fs-6">Category Name_{{ $lan->language_slug }}</label>
            <div class="col-lg-4 fv-row">
                <input 
                    type="text" name="category_name[]"
                    class="form-control form-control-lg form-control-solid"
                     />
            </div>

            <label class="col-lg-2 col-form-label required fw-bold fs-6">Category Image_{{ $lan->language_slug }}</label>
            <div class="col-lg-4 fv-row">
                <input type="file" class="form-control form-control-lg form-control-solid" name="category_image[]"
                    accept=".png, .jpg, .jpeg">
            </div>

        </div>

        <div class="row mb-6">

            <label class="col-lg-2 col-form-label required fw-bold fs-6">Description_{{ $lan->language_slug }}</label>
            <div class="col-lg-12 fv-row">
                <textarea name="description[]" class="form-control form-control-lg form-control-solid" placeholder="description"></textarea>
            </div>

            <div class="col-lg-12 fv-row">
                <input type="hidden" name="language_id[]" value="{{ $lan->language_id }}"
                    class="form-control form-control-lg form-control-solid" placeholder="language Id" readOnly />
            </div>

        </div>
    @endforeach

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\CategoryRequest', 'form') !!}
@endpush