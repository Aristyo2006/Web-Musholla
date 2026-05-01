<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page->title }} - Donasi Musholla</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme-manager')
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .page-content img { max-width: 100%; height: auto; border-radius: 1rem; margin: 2rem auto; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .page-content h1 { font-size: 2.5rem; font-weight: 900; margin-top: 2rem; margin-bottom: 1rem; color: #064e3b; }
        .page-content h2 { font-size: 2rem; font-weight: 800; margin-top: 2rem; margin-bottom: 1rem; color: #064e3b; }
        .page-content p { margin-bottom: 1.5rem; line-height: 1.8; color: #4b5563; font-size: 1.1rem; }
        .page-content ul, .page-content ol { margin-left: 2rem; margin-bottom: 1.5rem; }
        .page-content li { margin-bottom: 0.5rem; color: #4b5563; }
        .page-content blockquote { border-left: 4px solid #10b981; padding-left: 1.5rem; font-style: italic; color: #4b5563; background: #f0fdf4; padding: 1.5rem; border-radius: 0 1rem 1rem 0; margin: 2rem 0; }
        
        /* Dark Mode overrides for content */
        html.dark .page-content h1, html.dark .page-content h2 { color: #34d399; }
        html.dark .page-content p, html.dark .page-content li { color: #d1d5db; }
        html.dark .page-content blockquote { background: rgba(16, 185, 129, 0.1); color: #e5e7eb; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-zinc-950 text-zinc-900 dark:text-emerald-50 transition-colors duration-500">
    @include('partials.navbar')

    <div class="pt-32 pb-20">
        <div class="max-w-4xl mx-auto px-6">
            <h1 class="text-4xl md:text-6xl font-black text-emerald-950 dark:text-white mb-12 text-center tracking-tight">{{ $page->title }}</h1>
            
            <div class="page-content">
                {!! $page->content !!}
            </div>
        </div>
    </div>

    @include('partials.footer')
</body>
</html>
