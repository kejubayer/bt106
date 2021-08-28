@extends('layouts.backend')

@section('main')

    <div class="container mt-3">
        <h2 class="text-center">User List</h2>
        <a href="{{route('admin.user.create')}}" class="btn btn-success">Create new user</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key=>$user)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->address}}</td>
                    <td>
                        <a href="#" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-warning">Delete</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection
