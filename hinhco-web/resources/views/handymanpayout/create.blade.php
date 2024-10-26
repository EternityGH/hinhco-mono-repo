<x-master-layout>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-block card-stretch">
                <div class="card-body p-0">
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <h5 class="fw-bold">{{ $pageTitle ?? trans('messages.list') }}</h5>
                        <a href="{{ route('handyman.index') }}" class=" float-end btn btn-sm btn-primary"><i
                                    class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
            {{ Form::model($payoutdata,['method' => 'POST','route'=>'handymanpayout.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'handymanpayout'] ) }}
                    {{ Form::hidden('handyman_id') }}
                        <div class="row">
                            <div class="form-group col-md-3">
                                {{ Form::label('method',trans('messages.method').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('payment_method',['cash' => __('messages.cash'), 'wallet' => __('messages.wallet') ],old('method'),[ 'id' => 'method' ,'class' =>'form-control select2js','required']) }}
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('amount', __('messages.amount'), ['class' => 'form-control-label']) }}

                                {{-- Display the formatted amount in a readonly input field --}}
                                {{ Form::text('formatted_amount', getPriceFormat($payoutdata->amount ?? 0), [
                                    'class' => 'form-control',
                                    'readonly' => true,
                                    'placeholder' => __('messages.amount'),
                                ]) }}

                                {{-- Use a hidden field to store the raw amount value for submission --}}
                                {{ Form::hidden('amount', old('amount') ?? $payoutdata->amount, [
                                    'id' => 'raw_amount',
                                ]) }}
                            </div>
                            <div class="form-group col-md-12 ">
                                {{ Form::label('description',__('messages.description'), ['class' => 'form-control-label']) }}
                                {{ Form::textarea('description', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.description') ]) }}
                            </div>
                            
                        </div>
                    {{ Form::submit( trans('messages.save'), ['class'=>'btn btn-md btn-primary float-end']) }}
                {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
</x-master-layout>
