<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Wash The Vehicle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="height:100vh;">

<div class="card shadow p-4" style="width: 380px;">
    <div class="text-center mb-3">
        {{-- LOGO MOBIL --}}
        <img src="https://cdn-icons-png.flaticon.com/512/296/296216.png" width="80" alt="Wash The Vehicle">
        
        <h4 class="mt-3 fw-bold">Wash The Vehicle</h4>
        <small class="text-muted">Login Kasir & Admin</small>
    </div>

    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100 fw-semibold">
            Login
        </button>
    </form>
</div>

{{-- ===== POPUP NOTIF SUCCESS LOGOUT ===== --}}
@if(session('success'))
<div id="notif-success"
     style="
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.8);
        background: #28a745;
        color: white;
        padding: 20px 35px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        z-index: 9999;
        font-weight: 600;
        text-align: center;
        opacity: 0;
        transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
     ">
    ✅ {{ session('success') }}
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const notif = document.getElementById('notif-success');
    if (!notif) return;

    notif.style.opacity = 1;
    notif.style.transform = "translate(-50%, -50%) scale(1)";
    setTimeout(() => {
        notif.style.opacity = 0;
        notif.style.transform = "translate(-50%, -50%) scale(0.8)";
        setTimeout(() => notif.remove(), 500);
    }, 2500);
});
</script>
@endif

</body>
</html>
