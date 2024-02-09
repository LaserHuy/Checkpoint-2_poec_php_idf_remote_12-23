const calculateTotalPrice = () => {
    const cartInputs = document.querySelectorAll('input[name^="cart"]');
    let totalCupcakes = 0;
    let totalPrice = 0;
    
    for (let i = 0; i < cartInputs.length; i += 2) {
        const numberCupcake = parseInt(cartInputs[i].value);
        const unitPrice = parseFloat(cartInputs[i + 1].value);
        totalCupcakes += numberCupcake;
        totalPrice += numberCupcake * unitPrice;
    }
    
    // Apply discount for every three cupcakes purchased
    const discountCupcakes = Math.floor(totalCupcakes / 3);
    const discountAmount = discountCupcakes * 0.5; // 50 cents discount per cupcake
    const finalPrice = totalPrice - discountAmount;
    
    return [totalPrice.toFixed(2), finalPrice.toFixed(2)];
};

const [totalPrice, finalPrice] = calculateTotalPrice();
const bill = [totalPrice, finalPrice];
