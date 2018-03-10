<!doctype html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Test Redis</title>
    </head>

    <body>

        <div id="app">

            <ul>

                <li v-for="message in messages">@{{ message }}</li>

            </ul>

            <input v-model="message" @keydown.enter="sendMessage" type="text">

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.13/vue.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.17.1/axios.min.js"></script>

        <script>

            var socket = io('http://localhost:3000');

            new Vue({

                el : '#app' ,

                data : {
                    message : '' ,
                    messages : []
                }

                ,

                mounted : function () {


                    socket.on('chat:App\\Events\\MessageSent' , function (message) {

                        this.messages.push(message);

                    }.bind(this));

                } ,

                methods : {

                    sendMessage : function () {

                        axios({
                            method : 'post' ,
                            url : '{{ url('send-message') }}' ,
                            data : {
                                message : this.message
                            }
                        }).then(function (response) {
                            console.log(response);
                        });

                        this.message = '';

                    }

                }

            });

        </script>

    </body>

</html>