# dkvdev-qr-pay V0.1beta.
This application enables instant access to online payments by using the stripe API.

Requirements: 

    -apache web server
    -PHP 8.0
    -SQL database (tested with MariaDB)
    -Stripe account
    -SSL certificate

    -For those without access to those a service is in development.

Simply edit the .env files and run the application.
The comments in the .env files will guide the way.
In stripe's developer settings you'll need to create a webhook endpoint for all check-out events and point it to: "https://yourdomain.ex/webhook.php".
The application .env files need stripe's secret API key and the webhook secret to function.
Read stripes documentation on best practices regarding API keys to determine which key is best for your use of the application. The default key will work.

From there you have access to live payment data connected to your stripe account.
Use the QR code to easily offer users a payment platform that's truly mobile.
The application pulls in new payment data every 10 seconds and updates on the fly.
The webhook is triggered on every change of the payment state and then added to the payment data.

Wide control over your front-end is granted from the cms. You have a lot of freedom to brand your page to your liking.

