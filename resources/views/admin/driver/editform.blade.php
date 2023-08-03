<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Name</label>

        <div class="col-lg-4 fv-row">
            {!! Form::text('driver_name', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.driver_name', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Image</label>
        <div class="col-lg-4 fv-row">
            @if ($driver->driver_id)
                <input type="file" class="form-control form-control-lg form-control-solid" name="driver_image"
                    accept=".png, .jpg, .jpeg">
                <img src={{ env('APP_URL') }}/uploads/{{ $driver->driver_image }}
                    style="width:50px; height:50px; border-radius:1rem;" />
            @else
                <input type="file" class="form-control form-control-lg form-control-solid" name="driver_image"
                    accept=".png, .jpg, .jpeg">
            @endif
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Phone Number</label>
        <div class="col-lg-4 fv-row">
            {!! Form::number('driver_phone_number', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.driver_phone_number', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Email</label>
        <div class="col-lg-4 fv-row">
            {!! Form::text('driver_email', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.driver_email', 1),
            ]) !!}
        </div>

    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Store Name</label>
        <div class="col-lg-4 fv-row">
            <select class="form-control form-control-solid" name="store_name">
                <option value="">Select Store Name</option>
                @foreach ($stores as $data)
                    <option 
                        value="{{ $data->store_id }}" 
                        {{ $data->store_name == $data->store_id ? 'selected' : '' }}>
                        {{ $data->store_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-6">
        <label class="col-lg-2 col-form-label required fw-bold fs-6">Driver Address</label>
        <div class="col-lg-12 fv-row">
            {!! Form::textarea('driver_address', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.driver_address', 1),
            ]) !!}
        </div>
    </div>

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\EditDriverRequest', 'form') !!}
@endpush
