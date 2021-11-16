@extends('layouts.app')

@push('styles')
<style type="text/css">

</style>

@endpush
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Chat') }}</div>

                   <div class="card-body">

                    <div class="row p-2">

                        <div class="col-10">
                            <div class="row">
                                <div class="col-12 border rounded-lg p-3">
                                    <ul id="messages" class="list-unstyled overflow-auto" style="height: 45vh">

                                    </ul>
                                 </div>
                            </div>
                                 <form>
                                    <div class="row py-3">
                                        <div class="col-10">
                                            <input id="message" class="form-control" type="text">

                                        </div>

                                        <div class="col-2">
                                            <button id="send" type="submit" class="btn btn-primary btn-block">
                                                Send
                                            </button>

                                        </div>

                                    </div>
                                 </form>
                        </div>


                        <div class="col-2">
                            <p><strong>Online Now</strong></p>

                            <ul id="users" class="list-unstyled overflow-auto text-info" style="height: 45vh">

                            </ul>

                        </div>

                    </div>

                   </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
    <script>
        const usersElement = document.getElementById('users');
        const messagesElement = document.getElementById('messages');
        //using presence channel
        Echo.join('chat')
            .here((users) => {
                users.forEach((user , index) => {
                let element = document.createElement('li');
                element.setAttribute('id' , user.id);
                element.innerText = user.name;

            usersElement.appendChild(element); //add element users to the list of users
            });

        })
        .joining((user) => {
                let element = document.createElement('li');
                element.setAttribute('id' , user.id);
                element.innerText = user.name;
                usersElement.appendChild(element); // add users to the <li>
        })
        .leaving((user) => {
                const element = document.getElementById(user.id);
                element.parentNode.removeChild(element);
        })
        .listen('MessageSent' , (e) => {
            let element = document.createElement('li');

                element.innerText = e.user.name + ':' + e.message;

                messagesElement.appendChild(element); //add element message to the list of messages
        })



        /*presence channel:

        When using certain applications, it is usually expected that the current user is able to see all other users currently using the service alongside them.
         For instance, Dropbox Paper shows all the users that are currently viewing a document.
        This is very useful and it helps stop users feeling like they are alone on your application.
        */

    </script>


    <script>
        const messageElement = document.getElementById('message');
        const sendElement = document.getElementById('send');

        //action to send message
        sendElement.addEventListener('click' , (e) => {
            e.preventDefault();
            window.axios.post('/chat/message' , {
                message : messageElement.value,
            });
            messageElement.value = ''  ;  // to allow user to send message again
        })

    </script>

@endpush

