<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $profile->name ?? 'Aqief Hakimi' }} — Interactive API Reference & Sandbox</title>
    <meta name="description" content="Explore and test the public RESTful APIs powering this portfolio. Featuring OpenAPI 3.0, rate-limiting, and bilingual JSON schemas.">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #0f1115;
            color: #FAF9F6;
        }
        .api-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 24px;
            background-color: #16181d;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            font-size: 13px;
        }
        .api-topbar a {
            color: #FAF9F6;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: opacity 0.2s;
        }
        .api-topbar a:hover {
            opacity: 0.8;
        }
        .badge {
            background: rgba(143, 106, 59, 0.25);
            color: #d4af37;
            border: 1px solid rgba(212, 175, 55, 0.3);
            padding: 3px 8px;
            border-radius: 4px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            font-weight: 600;
        }
        .topbar-nav {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .topbar-nav a {
            color: #9ca3af;
            font-size: 12px;
            font-family: 'JetBrains Mono', monospace;
        }
        .topbar-nav a:hover {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="api-topbar">
        <div style="display: flex; align-items: center; gap: 12px;">
            <a href="{{ url('/') }}" style="font-weight: 600; letter-spacing: -0.01em;">
                &larr; Back to Portfolio
            </a>
            <span style="color: rgba(255, 255, 255, 0.2);">|</span>
            <span class="badge">OpenAPI 3.0.3</span>
            <span style="color: #9ca3af; font-family: 'JetBrains Mono', monospace; font-size: 12px;">Base: /api/v1</span>
        </div>
        <div class="topbar-nav">
            <a href="{{ url('/status') }}">System Status &rarr;</a>
            <a href="{{ url('/api/v1/openapi.json') }}" target="_blank">Raw JSON Spec</a>
            <a href="https://github.com/kuahcurry" target="_blank">GitHub</a>
        </div>
    </div>

    <!-- Scalar Interactive API Reference -->
    <script
        id="api-reference"
        data-url="{{ url('/api/v1/openapi.json') }}"
        data-configuration='{
            "theme": "saturn",
            "darkMode": true,
            "showSidebar": true,
            "layout": "modern"
        }'>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@scalar/api-reference"></script>
</body>
</html>
