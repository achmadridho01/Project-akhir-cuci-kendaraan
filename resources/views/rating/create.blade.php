<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Rating Pelayanan Kasir</title>
<style>
    body {
        font-family: sans-serif;
        background: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    .container {
        background: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        text-align: center;
        max-width: 500px;
        width: 100%;
    }
    h3 {
        margin-bottom: 40px;
    }
    .rating-box {
        display: inline-block;
        padding: 20px;
        border: 2px solid #ccc;
        border-radius: 12px;
        cursor: pointer;
        font-size: 2.5rem;
        width: 120px;
        margin: 10px;
        transition: 0.2s;
    }
    .rating-box span {
        display: block;
        font-size: 1rem;
        margin-top: 8px;
    }
    .rating-box:hover {
        border-color: #888;
        background: #f0f0f0;
    }
    .rating-box.selected {
        background: #d0ffd0;
        border-color: #4CAF50;
    }
    .btn-submit {
        margin-top: 40px;
        padding: 12px 30px;
        font-size: 16px;
        border: none;
        background: #4CAF50;
        color: white;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-submit:hover {
        background: #45a049;
    }
</style>
</head>
<body>

<div class="container">
    <h3>Apakah Anda puas dengan pelayanan kasir?</h3>

    <form method="POST" action="{{ route('rating.store', $transaksi->id) }}">
        @csrf

        <div>
            <label class="rating-box" data-value="1">
                😡<br>
                <span>Tidak Puas</span>
                <input type="radio" name="nilai_rating" value="1" required style="display:none;">
            </label>

            <label class="rating-box" data-value="2">
                😐<br>
                <span>Biasa Saja</span>
                <input type="radio" name="nilai_rating" value="2" style="display:none;">
            </label>

            <label class="rating-box" data-value="3">
                😄<br>
                <span>Puas</span>
                <input type="radio" name="nilai_rating" value="3" style="display:none;">
            </label>
        </div>

        <button type="submit" class="btn-submit">Simpan Rating</button>
    </form>
</div>

<script>
document.querySelectorAll('.rating-box').forEach(label => {
    label.addEventListener('click', () => {
        document.querySelectorAll('.rating-box').forEach(l => l.classList.remove('selected'));
        label.classList.add('selected');
        label.querySelector('input[type="radio"]').checked = true;
    });
});
</script>

</body>
</html>
