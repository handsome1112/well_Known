async function connectWallet() {
    try {
        if (typeof window.ethereum !== 'undefined' && window.ethereum.isMetaMask) {
            // Metamask is installed and connected
          } else {
            // Metamask is not installed or not connected
          }
        // You can now sign in the user with their Ethereum address or perform other operations with their account

        await window.ethereum.enable();
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

        if (signature) {
            $j.ajax({
                url: url,
                type: 'POST',
                dataType: 'jsonp', 
                success : function() { 
                    alert('Hello'); 
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    alert('Error: '+jqXHR.status);
                } // <-- remove the trailing comma you had here
            });
        } else {
            // alert
        }

    } catch (error) {
        console.error(error);
    }
      
}