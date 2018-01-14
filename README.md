# bunq Request Helper
The easiest way to create a bunq iDeal request or get the status of it.

![](https://doc.bunq.com/assets/img/logo.png)

### Introduction
Well to be honest, the currenct bunq PHP API is a big mess. Too many calls for a simple task like a request.
So I wrapped this shit up into easy to use functions for your project.

### Features
- Create a sandbox/production context.
- Create a payment request which can be paid using iDeal or SOFORT, then redirect to your URL after payment.
- Get the status of an existing payment request.
- Includes htaccess to protect your bunq.conf.

### Future
In the future I want to implement more basic functionality, but I currently don't have bunq Premium. The bunq sandbox isn't fully functional unfortunately, so I can't really test things out for now.
- Create a QR code for the payment, so bunq users can pay it directly.
- More iDeal functionality, like skipping bunq and passing users to their requested bank directly.
- Do a callback once a payment is done, not sure if this is possible with BunqMeTab.
- Maybe convert this small project into a full gateway with nice UI and interaction.

### Examples
Create a bunq context for the API (only run once):

`bunq_CreateContext("API-KEY-HERE", "DEVICE-NAME-HERE", "IP-ADDRESS-HERE")`

Create a payment request:

`bunq_CreateRequest("PAYMENT-AMOUNT", "PAYMENT-DESCRIPTION", 0, 0, "REDIRECT-TO-URL-AFTER-PAYMENT")`

Check the status of the payment request:

`bunq_StatusRequest("PAYMENT-ID")`

### Contribution
Feel free to contribute, we can make the bunq API useful this way.

### Credits
- https://github.com/basst85/bunq_pay for the Javascript code which is used to port to PHP for future use.
- https://github.com/bunq/sdk_php/tree/develop/example for code snippets, to find out how this API works.

### License
MIT License