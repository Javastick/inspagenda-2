<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Inspagenda') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FullCalendar -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

    <!-- Styles -->
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg-main: #f8fafc;
            --text-main: #1e293b;
            --event-past: #94a3b8;
            --event-today: #10b981;
            --event-future: #f59e0b;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* FullCalendar Customization */
        .fc {
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .fc-header-toolbar {
            margin-bottom: 2rem !important;
        }

        .fc-button-primary {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
            border-radius: 0.5rem !important;
            font-weight: 500 !important;
            padding: 0.5rem 1rem !important;
            transition: all 0.2s;
        }

        .fc-button-primary:hover {
            background-color: var(--primary-hover) !important;
            border-color: var(--primary-hover) !important;
        }

        .fc-event {
            border: none !important;
            border-radius: 4px !important;
            padding: 2px 4px !important;
            font-size: 0.85rem !important;
            cursor: pointer;
            transition: transform 0.1s;
        }

        .fc-event:hover {
            transform: scale(1.02);
        }

        /* Status Colors */
        .fc-event-past {
            background-color: var(--event-past) !important;
        }

        .fc-event-today {
            background-color: var(--event-today) !important;
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.3);
        }

        .fc-event-future {
            background-color: var(--event-future) !important;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-weight: 700;
            font-size: 1.875rem;
            color: var(--text-main);
            margin: 0;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    @yield('scripts')
</body>
</html>
