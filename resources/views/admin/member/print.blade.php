<!DOCTYPE html>
<html>
<head>
    <title>Kartu Member - {{ $member->nama_member }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: #f5f5f5; 
            font-family: Arial, sans-serif;
        }
        .card { 
            width: 480px; 
            height: 250px;
            margin: 50px auto; 
            border-radius: 20px; 
            overflow: hidden; 
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        .card-header { 
            height: 80px;
            background: linear-gradient(135deg, #007bff, #00c6ff);
            color: white; 
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-header img {
            height: 35px;
            width: auto;
            position: absolute;
            left: 15px;
            top: 15px;
            border-radius: 8px;
            border: 2px solid #fff;
        }
        .card-header h4 {
            margin: 0;
            font-weight: bold;
            color: white;
        }
        .card-body { 
            display: flex;
            padding: 20px;
            background: #f8f9fa;
            gap: 20px;
        }
        .member-info { 
            flex:1; 
            display:flex; 
            flex-direction: column; 
            justify-content: space-between; 
        }
        .member-info div { 
            display:flex; 
            justify-content: space-between; 
            align-items:center; 
            margin-bottom:10px;
        }
        .member-info div span { 
            background: #fff; 
            padding: 5px 15px; 
            border-radius: 8px; 
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }
        .member-info small { 
            color: #6c757d;
        }
        .qr-code { 
            width: 80px; 
            height: 80px; 
            display: flex; 
            align-items: center; 
            justify-content: center;
        }

        /* CSS khusus print */
        @media print {
            body { 
                background: #fff !important; 
            }
            .card {
                box-shadow: none !important;
                margin: 0 auto;
                width: 480px;
                height: 250px;
                page-break-inside: avoid;
            }
            .card-header {
                -webkit-print-color-adjust: exact; 
                print-color-adjust: exact; 
                background: linear-gradient(135deg, #007bff, #00c6ff) !important;
                color: white;
            }
            .card-body {
                background: #f8f9fa !important;
            }
            img {
                max-height: 50px !important;
                max-width: auto !important;
            }
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="card-header">
            {{-- Logo kiri atas --}}
            <img src="{{ asset('storage/logo/logocuci.png') }}" alt="Logo Wash The Vehicle">
            {{-- Judul --}}
            <h4>KARTU MEMBER</h4>
        </div>
        <div class="card-body">
            {{-- Info Member --}}
            <div class="member-info">
                <div>
                    <strong>Kode Member:</strong> <span>{{ $member->kode_member }}</span>
                </div>
                <div>
                    <strong>Nama Member:</strong> <span>{{ $member->nama_member }}</span>
                </div>
                <div>
                    <strong>No HP:</strong> <span>{{ $member->telepon }}</span>
                </div>
                <small>Terima kasih telah menjadi member Wash The Vehicle</small>
            </div>

            {{-- QR Code Otomatis --}}
            <div class="qr-code">
                @php
                    $qr = QrCode::size(80)->generate($member->kode_member);
                @endphp
                <div>{!! $qr !!}</div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
