<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Loans</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a class="btn btn-primary mb-3" href="{{ route('loans.create') }}">Create Loan</a>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table">
                    <thead>
                        <tr><th>ID</th><th>User</th><th>Amount</th><th>Status</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($loans as $loan)
                        <tr>
                            <td>{{ $loan->id }}</td>
                            <td>{{ $loan->user_id }}</td>
                            <td>{{ $loan->amount }}</td>
                            <td>{{ $loan->status }}</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="{{ route('loans.edit', $loan) }}">Edit</a>
                                <form action="{{ route('loans.destroy', $loan) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $loans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
