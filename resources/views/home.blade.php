@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        socket.on('message', function (data) {
            console.log(data)
            document.getElementById('messageContent').innerHTML = `<h1>${data}</h1>`
        })

        function sendMessage() {
            console.log('send')
            var message = document.getElementById('message').value
            var to = document.getElementById('to').value
            socket.emit('sendMessage', {to, message})
        }
    </script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <p id="messageContent"></p>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                    @endif

                        <input type="text" name="to" id="to">
                        <textarea name="message" id="message" cols="30" rows="10"></textarea>
                        <button onclick="sendMessage()">send</button>

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
