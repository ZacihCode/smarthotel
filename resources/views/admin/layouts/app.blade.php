<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'D\'Hotels Admin' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @livewireStyles
</head>

<body class="min-h-screen flex flex-col bg-gray-50 text-gray-800">
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
    @include('admin.layouts.content')
    @include('admin.layouts.footer')
    @livewireScripts
</body>

</html>