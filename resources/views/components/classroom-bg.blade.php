{{-- Classroom background. Place inside a parent with "relative isolate overflow-hidden".
     Optional: drop a real photo at public/images/classroom.jpg to replace the illustration. --}}
@php
    $photo = file_exists(public_path('images/classroom.jpg')) ? asset('images/classroom.jpg') : null;
@endphp

<div class="absolute inset-0 -z-10" aria-hidden="true">
    @if ($photo)
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $photo }}')"></div>
    @else
        <svg class="absolute inset-0 h-full w-full" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="wall" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0" stop-color="#2d3656"/>
                    <stop offset="1" stop-color="#1b2540"/>
                </linearGradient>
                <linearGradient id="floor" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0" stop-color="#7b5632"/>
                    <stop offset="1" stop-color="#34230f"/>
                </linearGradient>
                <linearGradient id="beam" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0" stop-color="#ffd98a" stop-opacity=".42"/>
                    <stop offset="1" stop-color="#ffd98a" stop-opacity="0"/>
                </linearGradient>
                <linearGradient id="glass" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0" stop-color="#ffe9b8"/>
                    <stop offset="1" stop-color="#f3c36b"/>
                </linearGradient>

                <g id="desk">
                    <rect x="-30" y="-34" width="4" height="34" fill="#2a1c0f"/>
                    <rect x="26" y="-34" width="4" height="34" fill="#2a1c0f"/>
                    <rect x="-36" y="-46" width="72" height="8" rx="2" fill="#a06f3d"/>
                    <rect x="-32" y="-38" width="64" height="5" fill="#6b4727"/>
                    <rect x="-16" y="-22" width="32" height="5" rx="2" fill="#27355a"/>
                    <rect x="-13" y="-17" width="3" height="17" fill="#1a233f"/>
                    <rect x="10" y="-17" width="3" height="17" fill="#1a233f"/>
                </g>
            </defs>

            <rect width="1600" height="900" fill="url(#wall)"/>
            <rect y="520" width="1600" height="380" fill="url(#floor)"/>
            <rect y="506" width="1600" height="14" fill="#161d33"/>

            <g stroke="#000" stroke-opacity=".16" stroke-width="2">
                <line x1="0" y1="600" x2="1600" y2="600"/>
                <line x1="0" y1="700" x2="1600" y2="700"/>
                <line x1="0" y1="815" x2="1600" y2="815"/>
            </g>

            <g>
                <rect x="110" y="80" width="230" height="300" fill="url(#glass)" stroke="#e8d9b5" stroke-width="8"/>
                <line x1="225" y1="80" x2="225" y2="380" stroke="#e8d9b5" stroke-width="6"/>
                <line x1="110" y1="230" x2="340" y2="230" stroke="#e8d9b5" stroke-width="6"/>

                <rect x="1260" y="80" width="230" height="300" fill="url(#glass)" stroke="#e8d9b5" stroke-width="8"/>
                <line x1="1375" y1="80" x2="1375" y2="380" stroke="#e8d9b5" stroke-width="6"/>
                <line x1="1260" y1="230" x2="1490" y2="230" stroke="#e8d9b5" stroke-width="6"/>
            </g>

            <polygon points="110,380 340,380 640,900 190,900" fill="url(#beam)"/>
            <polygon points="1260,380 1490,380 1410,900 960,900" fill="url(#beam)"/>

            <g opacity=".95">
                <use href="#desk" transform="translate(120 575) scale(.8)"/>
                <use href="#desk" transform="translate(330 575) scale(.8)"/>
                <use href="#desk" transform="translate(540 575) scale(.8)"/>
                <use href="#desk" transform="translate(750 575) scale(.8)"/>
                <use href="#desk" transform="translate(960 575) scale(.8)"/>
                <use href="#desk" transform="translate(1170 575) scale(.8)"/>
                <use href="#desk" transform="translate(1380 575) scale(.8)"/>

                <use href="#desk" transform="translate(60 690) scale(1.15)"/>
                <use href="#desk" transform="translate(330 690) scale(1.15)"/>
                <use href="#desk" transform="translate(600 690) scale(1.15)"/>
                <use href="#desk" transform="translate(870 690) scale(1.15)"/>
                <use href="#desk" transform="translate(1140 690) scale(1.15)"/>
                <use href="#desk" transform="translate(1410 690) scale(1.15)"/>

                <use href="#desk" transform="translate(150 840) scale(1.6)"/>
                <use href="#desk" transform="translate(560 840) scale(1.6)"/>
                <use href="#desk" transform="translate(970 840) scale(1.6)"/>
                <use href="#desk" transform="translate(1380 840) scale(1.6)"/>
            </g>
        </svg>
    @endif

    {{-- keeps the foreground readable --}}
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(16,22,40,0.2),rgba(16,22,40,0.72))]"></div>
</div>