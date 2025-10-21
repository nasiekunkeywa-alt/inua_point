<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Payments</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a class="btn btn-primary mb-3" href="{{ route('payments.create') }}">Add Payment</a>
                <table class="table">
                    <thead><tr><th>ID</th><th>Loan</th><th>Amount</th><th>Paid At</th></tr></thead>
                    <tbody>
                    @foreach($payments as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->loan_id }}</td>
                            <td>{{ $p->amount }}</td>
                            <td>{{ $p->paid_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $payments->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
