@extends('template')

@section('title', 'Plans')

@section('content')
    @include('navbar')
    <div class="container mt-5 d-flex flex-column align-items-center">
        <h1 class="mb-4">Subscription Plans</h1>
        <form class="d-flex flex-column align-items-center" action="/plans" method="POST">
            @csrf
            <div class="container d-flex justify-content-center mb-4">
                @foreach ($subs as $sub)
                    <div class="card border-primary mb-3" style="width: 250px; margin: 20px; cursor: pointer;" onclick="selectSubscription({{$sub->id}})">
                        <div class="card-body d-flex flex-column align-items-center" style="text-align: center">
                            <h5 class="card-title fw-bold">{{$sub->subscription_name}}</h5>
                            <p class="card-text">{{$sub->subscription_description}}</p>
                            <p class="card-text fw-bold text-warning">Rp {{$sub->subscription_price}},-</p>
                            <input type="radio" id="subscription{{$sub->id}}" name="subscription_id" value="{{$sub->id}}" style="display: none">
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mb-3" style="width: 80%">
                <input type="text" class="form-control mb-4" placeholder="Enter your bank account number..." name="account_no">
                <button type="submit" class="btn btn-primary" style="width: 100%">Start Plan</button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Remove the border-primary class from all card elements
            document.querySelectorAll('.card').forEach(card => {
                card.classList.remove('border-primary');
            });
        });

        function selectSubscription(id) {
            // Deselect all subscriptions
            document.querySelectorAll('.card').forEach(card => {
                card.classList.remove('border-primary');
            });
            
            // Select the clicked subscription
            document.getElementById('subscription' + id).checked = true;
            console.log(id);
            event.currentTarget.classList.add('border-primary');
            
            document.querySelectorAll('input[name="subscription_id"]').forEach(input => {
                if (input.value != id) {
                    console.log(input.value);
                    input.checked = false;
                }
            });
        }
    </script>
@endsection
