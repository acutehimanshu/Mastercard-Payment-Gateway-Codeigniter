<html>
    <head>
        <script src="https://alahligatway.gateway.mastercard.com/checkout/version/50/checkout.js"
          data-error="errorCallback"
          data-cancel="cancelCallback"
          data-complete="completeCallback">
        </script>

        <script type="text/javascript">
            var Checkout;
            function errorCallback(error) {
                // window.location.href = 'Falilure Url';
                alert('errorCallback');
            }

            function cancelCallback() {
                // window.location.href = 'Falilure Url';
                alert(cancelCallback);
                
            }

            function completeCallback() {
                // window.location.href = 'Success Url';
                alert(completeCallback);
            }

            Checkout.configure({
              merchant: 'merchant-id', // Procided by mastercard Session API
              order: {
                  description: 'Description of the Product',
                  id: 'Order-number' // this will be your own generated order number for your invoice
              },
              session: {
                  version: 'session->version', // Procided by mastercard Session API
                  id: 'session-id' // Procided by mastercard Session API
              },
              interaction: {
                  merchant: {
                      name: '<marchant-name>', // can be static
                      logo: '' // if you will get error while passing your logo url pass it blank it will work
                  },
                  locale: 'ar_SA', // this mastercard will provide its depends on the Location here SA means saudi arabia
                }
            });

            Checkout.showLightbox(); // this will call the Payment gateway popup
        </script>
    </head>
    <body>
    </body>
</html>
