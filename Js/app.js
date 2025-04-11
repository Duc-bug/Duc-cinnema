const express = require('express');
const bodyParser = require('body-parser');
const crypto = require('crypto');
const axios = require('axios');

const app = express();
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// MoMo API credentials
const partnerCode = 'MOMO';
const accessKey = 'YOUR_ACCESS_KEY';
const secretKey = 'YOUR_SECRET_KEY';
const endpoint = 'https://test-payment.momo.vn/v2/gateway/api/create';

// Route to handle MoMo payment
app.post('/momo-payment', async (req, res) => {
    const { amount, orderId, orderInfo, returnUrl, notifyUrl } = req.body;

    // Generate requestId and signature
    const requestId = `REQ_${new Date().getTime()}`;
    const rawSignature = `accessKey=${accessKey}&amount=${amount}&extraData=&ipnUrl=${notifyUrl}&orderId=${orderId}&orderInfo=${orderInfo}&partnerCode=${partnerCode}&redirectUrl=${returnUrl}&requestId=${requestId}&requestType=captureWallet`;
    const signature = crypto.createHmac('sha256', secretKey).update(rawSignature).digest('hex');

    // Prepare the MoMo payment request
    const paymentRequest = {
        partnerCode,
        accessKey,
        requestId,
        amount,
        orderId,
        orderInfo,
        redirectUrl: returnUrl,
        ipnUrl: notifyUrl,
        extraData: '',
        requestType: 'captureWallet',
        signature,
    };

    try {
        // Send the payment request to MoMo
        const response = await axios.post(endpoint, paymentRequest);
        if (response.data.payUrl) {
            res.json({ payUrl: response.data.payUrl });
        } else {
            res.status(400).json({ error: 'Failed to create MoMo payment' });
        }
    } catch (error) {
        console.error('Error processing MoMo payment:', error);
        res.status(500).json({ error: 'Internal server error' });
    }
});

// Start the server
const PORT = 3000;
app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});