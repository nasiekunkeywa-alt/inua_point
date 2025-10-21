<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Verifications</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="table">
                    <thead><tr><th>ID</th><th>Loan</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                    @foreach($verifications as $v)
                        <tr>
                            <td>{{ $v->id }}</td>
                            <td>{{ $v->loan_id }}</td>
                            <td>{{ $v->status }}</td>
                            <td>
                                <form action="{{ route('verifications.approve', $v) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Approve</button>
                                </form>
                                <form action="{{ route('verifications.reject', $v) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $verifications->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
