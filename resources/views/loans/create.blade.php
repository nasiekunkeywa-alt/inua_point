<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Loan</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('loans.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>User ID</label>
                        <input type="number" name="user_id" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Term</label>
                        <input type="text" name="term" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <input type="text" name="status" class="form-control">
                    </div>
                    <button class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
