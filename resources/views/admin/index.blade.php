@extends('layouts.myapp')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h3 class="mb-0">📩 Submitted Messages</h3>
                </div>

                <div class="card-body bg-light">
                    @if($messages->isEmpty())
                        <div class="alert alert-info text-center mb-0">
                            No messages found.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped align-middle mb-0">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $msg)
                                        <tr class="text-center">
                                            <td>{{ $msg->first_name }} {{ $msg->last_name }}</td>
                                            <td>{{ $msg->email }}</td>
                                            <td>{{ $msg->phone }}</td>
                                            <td><span class="badge bg-info text-dark">{{ $msg->subject }}</span></td>
                                            <td>{{ $msg->message }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $messages->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
