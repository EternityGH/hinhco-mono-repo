<x-master-layout>
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="fw-bold">{{ $pageTitle ?? __('messages.list') }}</h5>
                                <a href="{{ route('tax.index') }}" class=" float-end btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::model($taxdata ?? '',['method' => 'POST','route'=>'tax.store', 'data-toggle'=>"validator" ,'id'=>'tax'] ) }}
                            {{ Form::hidden('id') }}
                            <div class="row">
                                <div class="form-group col-md-4">
                                    {{ Form::label('title',__('messages.title').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                    {{ Form::text('title',old('title'),['placeholder' => __('messages.title'),'class' =>'form-control']) }}
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                
                                <div class="form-group col-md-4">
                                    {{ Form::label('value',__('messages.value').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false) }}
                                    {{ Form::number('value',old('value'), [ 'min' => 0, 'step' => 'any' , 'placeholder' => __('messages.value'),'class' =>'form-control']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    {{ Form::label('type', __('messages.select_name',[ 'select' => __('messages.type') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                    <br />
                                    {{ Form::select('type',['percent' => __('messages.percent') , 'fixed' => __('messages.fixed') ],old('type'),[ 'id' => 'type' ,'class' =>'form-control select2js','required']) }}
                                </div>
                                
                                <div class="form-group col-md-4">
                                    {{ Form::label('status',__('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                    {{ Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'id' => 'role' ,'class' =>'form-control select2js','required']) }}
                                </div>
                            </div>
                            {{ Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary float-end']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('type');
        const valueInput = document.getElementById('value');
        const valueError = document.getElementById('value-error');

        function setMinMax() {
                const type = typeSelect.value;

                if (type === 'percent') {
                    valueInput.min = 1;
                    valueInput.max = 100;
                } else if (type === 'fixed') {
                    valueInput.removeAttribute('min');
                    valueInput.removeAttribute('max');
                }
            }

        // Initialize min/max based on the current selection
        $(document).on('change', '#type', function() {
        setMinMax();
        });
        // Listen for changes in the type dropdown
        typeSelect.addEventListener('change', setMinMax);

        // Also validate on input change for the value field
        valueInput.addEventListener('input', setMinMax);
    });
</script>
</x-master-layout>