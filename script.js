
document.addEventListener('DOMContentLoaded', function () {
  const urlParams = new URLSearchParams(window.location.search);
  const paymentId = urlParams.get('paymentId');
  if (paymentId) {
    const checkoutOptions = {
      checkoutKey: 'test-checkout-key-27f16b854954456ba9bef4961ff0b756', // Replace!
      paymentId: paymentId,
      containerId: "checkout-container-div",
    };
    const checkout = new Dibs.Checkout(checkoutOptions);
    checkout.on('payment-completed', function (response) {
      window.location = 'completed.php';
    });
  } else {
    console.log("Expected a paymentId");   // No paymentId provided, 
    window.location = 'cart.html';         // go back to cart.html
  }
});