<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Steampunk Calendar Dashboard</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-steam-950 text-steam-100 antialiased">
        @php
            $selectedPalette = $schemes[$palette];
            $fontClass = $fontOptions[$font]['class'];
            $monthNumber = (int) $monthStart->format('n');
            $yearNumber = (int) $monthStart->format('Y');
            $monthNames = [
                1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June',
                7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December',
            ];
        @endphp

        <main class="mx-auto flex w-full max-w-7xl flex-col gap-6 p-4 md:p-8" style="--accent: {{ $selectedPalette['accent'] }}; --highlight: {{ $selectedPalette['highlight'] }}; --paper: {{ $selectedPalette['paper'] }};">
            <section class="ornate-frame rounded-2xl border border-[var(--accent)] bg-steam-900/95 p-4 md:p-6">
                <div class="mb-4 flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-[var(--accent)]">Dashboard</p>
                        <h1 class="text-2xl font-semibold text-[var(--highlight)] md:text-3xl">Steampunk Calendar Atelier</h1>
                    </div>
                    <form class="grid grid-cols-1 gap-2 text-sm sm:grid-cols-2" method="GET" action="{{ route('calendar.index') }}">
                        <label class="flex flex-col gap-1">
                            <span class="text-[var(--highlight)]">Calendar Option</span>
                            <select name="option" class="book-input" onchange="this.form.submit()">
                                @foreach($options as $value => $label)
                                    <option value="{{ $value }}" @selected($currentOption === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="flex flex-col gap-1">
                            <span class="text-[var(--highlight)]">Color Scheme</span>
                            <select name="palette" class="book-input" onchange="this.form.submit()">
                                @foreach($schemes as $value => $scheme)
                                    <option value="{{ $value }}" @selected($palette === $value)>{{ $scheme['name'] }}</option>
                                @endforeach
                            </select>
                        </label>
                        <input type="hidden" name="month" value="{{ $monthNumber }}">
                        <input type="hidden" name="year" value="{{ $yearNumber }}">
                        <input type="hidden" name="title" value="{{ $title }}">
                        <input type="hidden" name="description" value="{{ $description }}">
                        <input type="hidden" name="font" value="{{ $font }}">
                    </form>
                </div>

                <article class="book-shell rounded-2xl border border-[var(--accent)] bg-gradient-to-b from-steam-900 to-steam-950 p-4 md:p-8">
                    <header class="mb-6 text-center">
                        <div class="mx-auto mb-2 inline-flex items-center gap-2 rounded-full border border-[var(--accent)] px-4 py-1 text-xs uppercase tracking-[0.25em] text-[var(--accent)]">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 2 5 7v5c0 5 3.5 9 7 10 3.5-1 7-5 7-10V7l-7-5Z" stroke="currentColor" stroke-width="1.5"/></svg>
                            Guild Crest
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 2 5 7v5c0 5 3.5 9 7 10 3.5-1 7-5 7-10V7l-7-5Z" stroke="currentColor" stroke-width="1.5"/></svg>
                        </div>
                        <h2 class="{{ $fontClass }} text-3xl tracking-wide text-[var(--highlight)] md:text-4xl">{{ $title }}</h2>
                        <p class="mt-2 text-sm text-steam-200">{{ $description }}</p>
                    </header>

                    <form method="GET" action="{{ route('calendar.index') }}" class="mb-6 grid gap-3 rounded-xl border border-[var(--accent)]/60 bg-[var(--paper)]/30 p-3 md:grid-cols-2 lg:grid-cols-6">
                        <label class="lg:col-span-2">
                            <span class="mb-1 block text-xs uppercase tracking-[0.2em] text-[var(--highlight)]">Title</span>
                            <input class="book-input" name="title" value="{{ $title }}" maxlength="80">
                        </label>
                        <label class="lg:col-span-2">
                            <span class="mb-1 block text-xs uppercase tracking-[0.2em] text-[var(--highlight)]">Text</span>
                            <input class="book-input" name="description" value="{{ $description }}" maxlength="120">
                        </label>
                        <label>
                            <span class="mb-1 block text-xs uppercase tracking-[0.2em] text-[var(--highlight)]">Month</span>
                            <select name="month" class="book-input">
                                @foreach($monthNames as $number => $name)
                                    <option value="{{ $number }}" @selected($number === $monthNumber)>{{ $name }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label>
                            <span class="mb-1 block text-xs uppercase tracking-[0.2em] text-[var(--highlight)]">Year</span>
                            <input class="book-input" type="number" name="year" min="1900" max="2200" value="{{ $yearNumber }}">
                        </label>
                        <label>
                            <span class="mb-1 block text-xs uppercase tracking-[0.2em] text-[var(--highlight)]">Palette</span>
                            <select name="palette" class="book-input">
                                @foreach($schemes as $value => $scheme)
                                    <option value="{{ $value }}" @selected($palette === $value)>{{ $scheme['name'] }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label>
                            <span class="mb-1 block text-xs uppercase tracking-[0.2em] text-[var(--highlight)]">Font</span>
                            <select name="font" class="book-input">
                                @foreach($fontOptions as $value => $option)
                                    <option value="{{ $value }}" @selected($font === $value)>{{ $option['name'] }}</option>
                                @endforeach
                            </select>
                        </label>
                        <input type="hidden" name="option" value="{{ $currentOption }}">
                        <div class="lg:col-span-6 flex items-center justify-between gap-3">
                            <div class="flex gap-2">
                                <a class="book-button" href="{{ route('calendar.index', ['month' => (int) $prevMonth->format('n'), 'year' => (int) $prevMonth->format('Y'), 'title' => $title, 'description' => $description, 'palette' => $palette, 'font' => $font, 'option' => $currentOption]) }}">◀ Prev</a>
                                <a class="book-button" href="{{ route('calendar.index', ['month' => (int) $nextMonth->format('n'), 'year' => (int) $nextMonth->format('Y'), 'title' => $title, 'description' => $description, 'palette' => $palette, 'font' => $font, 'option' => $currentOption]) }}">Next ▶</a>
                            </div>
                            <button type="submit" class="book-button">Apply Customization</button>
                        </div>
                    </form>

                    <div class="rounded-xl border border-[var(--accent)]/80 bg-steam-950/60 p-3">
                        <div class="mb-3 text-center">
                            <h3 class="{{ $fontClass }} text-2xl text-[var(--highlight)]">{{ $monthStart->format('F Y') }}</h3>
                        </div>

                        <div class="grid grid-cols-7 gap-2 text-center">
                            @foreach($dayLabels as $label)
                                <div class="rounded-md border border-[var(--accent)]/60 bg-[var(--paper)]/30 py-2 text-xs font-semibold tracking-[0.2em] text-[var(--highlight)]">{{ $label }}</div>
                            @endforeach
                        </div>

                        <div class="mt-2 grid grid-cols-7 gap-2">
                            @foreach($days as $week)
                                @foreach($week as $day)
                                    @if($day)
                                        <div class="calendar-day {{ $day['isToday'] ? 'calendar-day-today' : '' }}">
                                            {{ $day['number'] }}
                                        </div>
                                    @else
                                        <div class="calendar-day calendar-day-empty"></div>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </article>
            </section>
        </main>
    </body>
</html>
