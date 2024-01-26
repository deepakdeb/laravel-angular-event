@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="row g-2 align-items-center my-3">
            <div class="col">
                <!-- Registration pre-title -->
                <div class="registration-pretitle">
                    Registration Management
                </div>
                <h2 class="registration-title">
                    Registrations
                </h2>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div id="table-default" class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Address</th>
                            <th>Created Time</th>
                            <th>Updated Time</th>
                        </tr>
                        @foreach ($registrations as $index => $registration)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $registration->name }}</td>
                                <td>{{ $registration->email }}</td>
                                <td>{{ $registration->age }}</td>
                                <td>{{ $registration->address }}</td>

                                <td>{{ $registration->created_at }}</td>
                                <td>{{ $registration->updated_at }}</td>
                            </tr>
                        @endforeach
                       
                    </table>
                </div>
            </div>
        </div>


        {{-- <div class="mt-3">
            {!! $registrations->links('pagination::bootstrap-5') !!}
        </div> --}}


    </div>

  
@endsection
