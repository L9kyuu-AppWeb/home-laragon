<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Terbatas - Laragon Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrojFfKjJ/l7JtLzPqG6E7i/K2wS6w+05+0FfF/YQ6tG9+w/x8fJ5A7oB5eQ6g2iQ8P9A0dF/l9Y6tO6w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 2rem;
            max-width: 500px;
            text-align: center;
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .icon-container {
            width: 80px;
            height: 80px;
            background: #fef3c7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        .icon {
            font-size: 2.5rem;
            color: #f59e0b;
        }
        h1 {
            color: #1f2937;
            font-size: 1.75rem;
            margin-bottom: 1rem;
        }
        p {
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        .btn {
            background: #3b82f6;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
            transition: all 0.3s ease;
        }
        .btn:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon-container">
            <i class="fas fa-lock icon"></i>
        </div>
        <h1>Akses Terbatas</h1>
        <p>
            Maaf, halaman ini hanya dapat diakses dari komputer lokal. 
            Akses dari jaringan eksternal telah dibatasi untuk alasan keamanan.
        </p>
        <p>
            Jika Anda ingin mengakses proyek dari jaringan eksternal, 
            harap hubungi administrator sistem.
        </p>
        <a href="javascript:history.back()" class="btn">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
</body>
</html>