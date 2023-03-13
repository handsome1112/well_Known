<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $site_name }} - {{ $page_name }}</title>
        <meta name="description" content="{{ $site_description }}">
	
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('resources/views/assets/css/tabler.min.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('resources/views/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}" defer></script>
        <script src="{{ asset('resources/views/assets/js/tabler.min.js') }}" defer></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.7.4-rc.1/web3.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script>
	async function connectWallet(value) {
        try {
            if (typeof window.ethereum !== 'undefined' && window.ethereum.isMetaMask) {
                // Metamask is installed and connected
            } else {
                // Metamask is not installed or not connected
            }
            // You can now sign in the user with their Ethereum address or perform other operations with their account

            //await window.ethereum.enable();
            //connect
            const accounts = await ethereum.request({ method: 'eth_requestAccounts' });
            const address = accounts[0];
            console.log(accounts, address);

            // signup
            const nickname = 'My New Account';
            const message = `Set account nickname to "${nickname}"`;
            const signature = await window.ethereum.request({
            method: 'personal_sign',
            params: [message, address],
            });

            let data = {};
            let url = '';

            if(value) {
                data = {
                    name: address,
                    email: address + '@gmail.com',
                    _token: "{{ csrf_token() }}",
                    password: address
                }
                url = 'register';

            } else {
                data = {
                    email: address + '@gmail.com',
                    _token: "{{ csrf_token() }}",
                    password: address
                }
                url='login';
            }
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function( data ) {
                    if(data === 'exist') { 
                        alert('you have already account');
                        window.location.href='https://rektconfessions.com/login';
                    } else {
                        window.location.href='https://rektconfessions.com/';
                    }
                },
                error: function(err) {
                    console.log('something went wrong');
                }
            });
        } catch (error) {
                console.error(error);
        }
        
    }	
	</script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            @yield('content')
        </div>
    </body>
</html>
