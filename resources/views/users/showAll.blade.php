@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                 <ul id="users">

                 </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')

<script>

// to get all users from db by js
window.axios.get('/api/users')
.then((response) => {
    const usersElement = document.getElementById('users');
    let users = response.data;
    users.forEach((user , index) => {
     let element = document.createElement('li');
     element.setAttribute('id' , user.id);
     element.innerText = user.name;

     usersElement.appendChild(element); //Append users to the <li>
    });
});

</script>


<script>



window.Echo.channel('users')
        .listen('UserCreated' , (e) => {
            const usersElement = document.getElementById('users')
            let element = document.createElement('li');
            element.setAttribute('id' , e.user.id);
            element.innerText = e.user.name;

            usersElement.appendChild(element); //add element users to the list of users

        })

        .listen('UserUpdated' , (e) => {

            const element = document.getElementById(e.user.id);
            // modifiy inner text
            element.innerText = e.user.name;

        })

        .listen('UserDeleted' , (e) => {
            const element = document.getElementById(e.user.id);
            element.parentNode.removeChild(element)
        })


</script>

@endpush
