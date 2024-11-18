@extends('layout')

@section('content')
    <h1>User Form</h1>

    <form 
    @if (@isset($id)) action="/users/{{$id}}"
    @else
    action="/users"    
    @endif

    method="POST"
    >
    @csrf

    @if (isset($id))
    @method('put')  
    @endif

        <div>Name</div>
        <input type="text" class="form-control" name="name" value="{{$name}}" placeholder="Name">

        <div class="mt-3">Email</div>
        <input type="text" class="form-control" name="email" value="{{$email}}" placeholder="Email">

        <div class="mt-3">Password</div>
        <input type="password" class="form-control" name="password" value="{{$password}}" placeholder="Password"> 

        <div class="mt-3">
             <button type="submit" class="btn-btn-primary">
                <i class="fa-solid fa-check me-2"></i>
             บันทึกข้อมูล
                </button>
            </div>
    </form>

@endsection