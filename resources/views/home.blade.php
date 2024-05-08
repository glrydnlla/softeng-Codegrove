@extends('template')

@section('title', 'Home')
    
@section('content')
    @include('navbar')
    <div class="bg-white">
        <div class="container mt-5">
            <div class="card border border-secondary">
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                    <div>
                        <img src="user-image.jpg" class="rounded-circle" width="40" height="40" alt="User Image">
                        <span class="ms-2">Username</span>
                    </div>
                    <span class="badge bg-success">Category</span>
                </div>
                <div class="card-body">
                    <p class="card-text">Your text goes here...</p>
                    <hr class="my-4">
                    <a href="#" class="card-link">View all replies...</a>
                </div>
            </div>
        </div>
        
        

        <a href="/add-question" class="custom-button">
            <div class="plus-symbol">+</div>
        </a>

    </div>

    <style>
        .custom-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: white;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            text-decoration: none;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
            transition: background-color 0.3s;
            position: fixed;
            bottom: 30px;
            right: 30px;
        }
    
        .custom-button:hover {
            background-color: rgb(214, 214, 214);
        }
    
        .plus-symbol {
            color: black;
            font-size: 24px;
        }
    </style>
@endsection