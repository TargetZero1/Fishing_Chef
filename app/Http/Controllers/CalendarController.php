<?php

namespace App\Http\Controllers;

use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CalendarController extends Controller
{
    public function index(Request $request): View
    {
        $month = $this->boundedInt((int) $request->input('month', now()->month), 1, 12);
        $year = $this->boundedInt((int) $request->input('year', now()->year), 1900, 2200);

        $monthStart = CarbonImmutable::create($year, $month, 1)->startOfMonth();

        $title = trim((string) $request->input('title', 'Chronicle of the Aether')) ?: 'Chronicle of the Aether';
        $description = trim((string) $request->input('description', 'Recorded in brass and bound in parchment.')) ?: 'Recorded in brass and bound in parchment.';

        $schemes = [
            'bronze' => ['name' => 'Bronze Ember', 'accent' => '#c39a4b', 'highlight' => '#f0d38f', 'paper' => '#2e2317'],
            'verdigris' => ['name' => 'Verdigris Patina', 'accent' => '#7f9f8a', 'highlight' => '#b9dac4', 'paper' => '#1f2a26'],
            'royal' => ['name' => 'Royal Brass', 'accent' => '#a07a2f', 'highlight' => '#eac86c', 'paper' => '#251e2f'],
        ];

        $palette = (string) $request->input('palette', 'bronze');
        if (! array_key_exists($palette, $schemes)) {
            $palette = 'bronze';
        }

        $fontOptions = [
            'cinzel' => ['name' => 'Cinzel-style', 'class' => 'font-calendar-display'],
            'serif' => ['name' => 'Classic Serif', 'class' => 'font-serif'],
            'mono' => ['name' => 'Engraver Mono', 'class' => 'font-mono'],
        ];

        $font = (string) $request->input('font', 'cinzel');
        if (! array_key_exists($font, $fontOptions)) {
            $font = 'cinzel';
        }

        $days = $this->buildCalendarDays($monthStart);

        return view('calendar.book', [
            'title' => $title,
            'description' => $description,
            'monthStart' => $monthStart,
            'dayLabels' => ['M', 'S', 'S', 'R', 'K', 'J', 'S'],
            'days' => $days,
            'palette' => $palette,
            'schemes' => $schemes,
            'font' => $font,
            'fontOptions' => $fontOptions,
            'currentOption' => 'book',
            'options' => ['book' => 'Option C · Book Calendar'],
            'prevMonth' => $monthStart->subMonth(),
            'nextMonth' => $monthStart->addMonth(),
        ]);
    }

    /**
     * @return array<int, array<int, array{number:int,isCurrentMonth:bool,isToday:bool}|null>>
     */
    private function buildCalendarDays(CarbonImmutable $monthStart): array
    {
        $firstColumn = $monthStart->dayOfWeekIso - 1;
        $daysInMonth = $monthStart->daysInMonth;
        $today = now();

        $cells = [];

        for ($index = 0; $index < 42; $index++) {
            $day = $index - $firstColumn + 1;

            if ($day < 1 || $day > $daysInMonth) {
                $cells[] = null;

                continue;
            }

            $cells[] = [
                'number' => $day,
                'isCurrentMonth' => true,
                'isToday' => $monthStart->year === $today->year
                    && $monthStart->month === $today->month
                    && $day === $today->day,
            ];
        }

        return array_chunk($cells, 7);
    }

    private function boundedInt(int $value, int $min, int $max): int
    {
        return max($min, min($max, $value));
    }
}
