@extends($activeTemplate.'layouts.auth_user')
@section('content')

    <div class="custom--card">
        <div class="card-header">
            <h6>@lang('Transaction History')</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive--md">
                <table class="table custom--table">
                    <thead>
                        <tr>
                            <th>Trx ID</th>
                            <th>Amount</th>
                            <th>Charge</th>
                            <th>Details</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $item)
                            <tr>
                                <td data-label="Trx ID">
                                    {{ $item->trx }}
                                </td>
                                <td data-label="Amount"> {{ $item->amount }} </td>
                                <td data-label="Charge">
                                    {{ $item->charge }}
                                </td>
                                <td data-label="Details">
                                    {{ $item->details }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <tfoot>
                    @if ($transactions->hasPages())
                        {{ paginateLinks($transactions) }}
                    @endif
                </tfoot>
            </div>
        </div>
    </div>


@endsection
