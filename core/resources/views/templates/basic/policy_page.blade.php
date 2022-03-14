@extends($activeTemplate.'layouts.frontend')
@section('content')
    <div class="card text-left">
        <div class="card-header">
            <h4>
                @php echo $policyPage->data_values->title @endphp
            </h4>
        </div>
        <div class="card-body">
            <p class="card-text">
                @php echo $policyPage->data_values->details @endphp
            </p>
        </div>
    </div>
@endsection
