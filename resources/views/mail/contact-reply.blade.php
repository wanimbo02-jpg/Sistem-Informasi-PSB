<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balasan dari SMA Negeri Karubaga</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #00bcd4;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-top: none;
        }
        .message-box {
            background: white;
            padding: 20px;
            border-left: 4px solid #00bcd4;
            margin: 20px 0;
            border-radius: 4px;
        }
        .footer {
            background: #333;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 0 0 8px 8px;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #00bcd4;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SMA Negeri Karubaga</h1>
        <p>Balasan Pesan Anda</p>
    </div>
    
    <div class="content">
        <h2>Halo, {{ $contact->name }}!</h2>
        
        <p>Terima kasih telah menghubungi kami. Berikut adalah balasan dari pesan yang Anda kirimkan:</p>
        
        <div class="message-box">
            <h3>Pesan Anda:</h3>
            <p><em>"{{ $contact->message }}"</em></p>
            <hr>
            <h3>Balasan Kami:</h3>
            <p>{{ $reply }}</p>
        </div>
        
        <p>Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami kembali.</p>
        
        <a href="{{ route('contact') }}" class="btn">Hubungi Kami Lagi</a>
        
        <p><strong>Salam hangat,</strong></p>
        <p><strong>Tim SMA Negeri Karubaga</strong></p>
    </div>
    
    <div class="footer">
        <p>&copy; {{ date('Y') }} SMA Negeri Karubaga. All rights reserved.</p>
        <p>Email: info@smanegerikarubaga.sch.id | Telepon: (0969) XXXXXX</p>
    </div>
</body>
</html>
