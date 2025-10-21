<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Payment</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('payments.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Loan ID</label>
                        <input type="number" name="loan_id" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Paid At</label>
                        <input type="datetime-local" name="paid_at" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Method</label>
                        <input type="text" name="method" class="form-control">
                    </div>
                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
