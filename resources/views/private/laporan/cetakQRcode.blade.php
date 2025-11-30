<title>QR CODE</title>
<img src="data:image/png;base64, {!! base64_encode(QrCode::size(350)->generate($QRcode)) !!} " style="width: 150px;">
