<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Auto-oferta.pl</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* ! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com */
                *,
                ::after,
                ::before {
                    box-sizing: border-box;
                    border-width: 0;
                    border-style: solid;
                    border-color: #e5e7eb;
                }
                ::after,
                ::before {
                    --tw-content: '';
                }
                :host,
                html {
                    line-height: 1.5;
                    -webkit-text-size-adjust: 100%;
                    -moz-tab-size: 4;
                    tab-size: 4;
                    font-family:
                        Figtree,
                        ui-sans-serif,
                        system-ui,
                        sans-serif,
                        Apple Color Emoji,
                        Segoe UI Emoji,
                        Segoe UI Symbol,
                        Noto Color Emoji;
                    font-feature-settings: normal;
                    font-variation-settings: normal;
                    -webkit-tap-highlight-color: transparent;
                }
                body {
                    margin: 0;
                    line-height: inherit;
                }
                hr {
                    height: 0;
                    color: inherit;
                    border-top-width: 1px;
                }
                abbr:where([title]) {
                    -webkit-text-decoration: underline dotted;
                    text-decoration: underline dotted;
                }
                h1,
                h2,
                h3,
                h4,
                h5,
                h6 {
                    font-size: inherit;
                    font-weight: inherit;
                }
                a {
                    color: inherit;
                    text-decoration: inherit;
                }
                b,
                strong {
                    font-weight: bolder;
                }
                code,
                kbd,
                pre,
                samp {
                    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New',
                        monospace;
                    font-feature-settings: normal;
                    font-variation-settings: normal;
                    font-size: 1em;
                }
                small {
                    font-size: 80%;
                }
                sub,
                sup {
                    font-size: 75%;
                    line-height: 0;
                    position: relative;
                    vertical-align: baseline;
                }
                sub {
                    bottom: -0.25em;
                }
                sup {
                    top: -0.5em;
                }
                table {
                    text-indent: 0;
                    border-color: inherit;
                    border-collapse: collapse;
                }
                button,
                input,
                optgroup,
                select,
                textarea {
                    font-family: inherit;
                    font-feature-settings: inherit;
                    font-variation-settings: inherit;
                    font-size: 100%;
                    font-weight: inherit;
                    line-height: inherit;
                    color: inherit;
                    margin: 0;
                    padding: 0;
                }
                button,
                select {
                    text-transform: none;
                }
                [type='button'],
                [type='reset'],
                [type='submit'],
                button {
                    -webkit-appearance: button;
                    background-color: transparent;
                    background-image: none;
                }
                :-moz-focusring {
                    outline: auto;
                }
                :-moz-ui-invalid {
                    box-shadow: none;
                }
                progress {
                    vertical-align: baseline;
                }
                ::-webkit-inner-spin-button,
                ::-webkit-outer-spin-button {
                    height: auto;
                }
                [type='search'] {
                    -webkit-appearance: textfield;
                    outline-offset: -2px;
                }
                ::-webkit-search-decoration {
                    -webkit-appearance: none;
                }
                ::-webkit-file-upload-button {
                    -webkit-appearance: button;
                    font: inherit;
                }
                summary {
                    display: list-item;
                }
                blockquote,
                dd,
                dl,
                figure,
                h1,
                h2,
                h3,
                h4,
                h5,
                h6,
                hr,
                p,
                pre {
                    margin: 0;
                }
                fieldset {
                    margin: 0;
                    padding: 0;
                }
                legend {
                    padding: 0;
                }
                menu,
                ol,
                ul {
                    list-style: none;
                    margin: 0;
                    padding: 0;
                }
                dialog {
                    padding: 0;
                }
                textarea {
                    resize: vertical;
                }
                input::placeholder,
                textarea::placeholder {
                    opacity: 1;
                    color: #9ca3af;
                }
                [role='button'],
                button {
                    cursor: pointer;
                }
                :disabled {
                    cursor: default;
                }
                audio,
                canvas,
                embed,
                iframe,
                img,
                object,
                svg,
                video {
                    display: block;
                    vertical-align: middle;
                }
                img,
                video {
                    max-width: 100%;
                    height: auto;
                }
                [hidden] {
                    display: none;
                }
                *,
                ::before,
                ::after {
                    --tw-border-spacing-x: 0;
                    --tw-border-spacing-y: 0;
                    --tw-translate-x: 0;
                    --tw-translate-y: 0;
                    --tw-rotate: 0;
                    --tw-skew-x: 0;
                    --tw-skew-y: 0;
                    --tw-scale-x: 1;
                    --tw-scale-y: 1;
                    --tw-pan-x: ;
                    --tw-pan-y: ;
                    --tw-pinch-zoom: ;
                    --tw-scroll-snap-strictness: proximity;
                    --tw-gradient-from-position: ;
                    --tw-gradient-via-position: ;
                    --tw-gradient-to-position: ;
                    --tw-ordinal: ;
                    --tw-slashed-zero: ;
                    --tw-numeric-figure: ;
                    --tw-numeric-spacing: ;
                    --tw-numeric-fraction: ;
                    --tw-ring-inset: ;
                    --tw-ring-offset-width: 0px;
                    --tw-ring-offset-color: #fff;
                    --tw-ring-color: rgb(59 130 246 / 0.5);
                    --tw-ring-offset-shadow: 0 0 #0000;
                    --tw-ring-shadow: 0 0 #0000;
                    --tw-shadow: 0 0 #0000;
                    --tw-shadow-colored: 0 0 #0000;
                    --tw-blur: ;
                    --tw-brightness: ;
                    --tw-contrast: ;
                    --tw-grayscale: ;
                    --tw-hue-rotate: ;
                    --tw-invert: ;
                    --tw-saturate: ;
                    --tw-sepia: ;
                    --tw-drop-shadow: ;
                    --tw-backdrop-blur: ;
                    --tw-backdrop-brightness: ;
                    --tw-backdrop-contrast: ;
                    --tw-backdrop-grayscale: ;
                    --tw-backdrop-hue-rotate: ;
                    --tw-backdrop-invert: ;
                    --tw-backdrop-opacity: ;
                    --tw-backdrop-saturate: ;
                    --tw-backdrop-sepia: ;
                }
                ::backdrop {
                    --tw-border-spacing-x: 0;
                    --tw-border-spacing-y: 0;
                    --tw-translate-x: 0;
                    --tw-translate-y: 0;
                    --tw-rotate: 0;
                    --tw-skew-x: 0;
                    --tw-skew-y: 0;
                    --tw-scale-x: 1;
                    --tw-scale-y: 1;
                    --tw-pan-x: ;
                    --tw-pan-y: ;
                    --tw-pinch-zoom: ;
                    --tw-scroll-snap-strictness: proximity;
                    --tw-gradient-from-position: ;
                    --tw-gradient-via-position: ;
                    --tw-gradient-to-position: ;
                    --tw-ordinal: ;
                    --tw-slashed-zero: ;
                    --tw-numeric-figure: ;
                    --tw-numeric-spacing: ;
                    --tw-numeric-fraction: ;
                    --tw-ring-inset: ;
                    --tw-ring-offset-width: 0px;
                    --tw-ring-offset-color: #fff;
                    --tw-ring-color: rgb(59 130 246 / 0.5);
                    --tw-ring-offset-shadow: 0 0 #0000;
                    --tw-ring-shadow: 0 0 #0000;
                    --tw-shadow: 0 0 #0000;
                    --tw-shadow-colored: 0 0 #0000;
                    --tw-blur: ;
                    --tw-brightness: ;
                    --tw-contrast: ;
                    --tw-grayscale: ;
                    --tw-hue-rotate: ;
                    --tw-invert: ;
                    --tw-saturate: ;
                    --tw-sepia: ;
                    --tw-drop-shadow: ;
                    --tw-backdrop-blur: ;
                    --tw-backdrop-brightness: ;
                    --tw-backdrop-contrast: ;
                    --tw-backdrop-grayscale: ;
                    --tw-backdrop-hue-rotate: ;
                    --tw-backdrop-invert: ;
                    --tw-backdrop-opacity: ;
                    --tw-backdrop-saturate: ;
                    --tw-backdrop-sepia: ;
                }
                .absolute {
                    position: absolute;
                }
                .relative {
                    position: relative;
                }
                .-left-20 {
                    left: -5rem;
                }
                .top-0 {
                    top: 0px;
                }
                .-bottom-16 {
                    bottom: -4rem;
                }
                .-left-16 {
                    left: -4rem;
                }
                .-mx-3 {
                    margin-left: -0.75rem;
                    margin-right: -0.75rem;
                }
                .mt-4 {
                    margin-top: 1rem;
                }
                .mt-6 {
                    margin-top: 1.5rem;
                }
                .flex {
                    display: flex;
                }
                .grid {
                    display: grid;
                }
                .hidden {
                    display: none;
                }
                .aspect-video {
                    aspect-ratio: 16 / 9;
                }
                .size-12 {
                    width: 3rem;
                    height: 3rem;
                }
                .size-5 {
                    width: 1.25rem;
                    height: 1.25rem;
                }
                .size-6 {
                    width: 1.5rem;
                    height: 1.5rem;
                }
                .h-12 {
                    height: 3rem;
                }
                .h-40 {
                    height: 10rem;
                }
                .h-full {
                    height: 100%;
                }
                .min-h-screen {
                    min-height: 100vh;
                }
                .w-full {
                    width: 100%;
                }
                .w-\[calc\(100\%\+8rem\)\] {
                    width: calc(100% + 8rem);
                }
                .w-auto {
                    width: auto;
                }
                .max-w-\[877px\] {
                    max-width: 877px;
                }
                .max-w-2xl {
                    max-width: 42rem;
                }
                .flex-1 {
                    flex: 1 1 0%;
                }
                .shrink-0 {
                    flex-shrink: 0;
                }
                .grid-cols-2 {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
                .flex-col {
                    flex-direction: column;
                }
                .items-start {
                    align-items: flex-start;
                }
                .items-center {
                    align-items: center;
                }
                .items-stretch {
                    align-items: stretch;
                }
                .justify-end {
                    justify-content: flex-end;
                }
                .justify-center {
                    justify-content: center;
                }
                .gap-2 {
                    gap: 0.5rem;
                }
                .gap-4 {
                    gap: 1rem;
                }
                .gap-6 {
                    gap: 1.5rem;
                }
                .self-center {
                    align-self: center;
                }
                .overflow-hidden {
                    overflow: hidden;
                }
                .rounded-\[10px\] {
                    border-radius: 10px;
                }
                .rounded-full {
                    border-radius: 9999px;
                }
                .rounded-lg {
                    border-radius: 0.5rem;
                }
                .rounded-md {
                    border-radius: 0.375rem;
                }
                .rounded-sm {
                    border-radius: 0.125rem;
                }
                .bg-\[\#FF2D20\]\/10 {
                    background-color: rgb(255 45 32 / 0.1);
                }
                .bg-white {
                    --tw-bg-opacity: 1;
                    background-color: rgb(255 255 255 / var(--tw-bg-opacity));
                }
                .bg-gradient-to-b {
                    background-image: linear-gradient(to bottom, var(--tw-gradient-stops));
                }
                .from-transparent {
                    --tw-gradient-from: transparent var(--tw-gradient-from-position);
                    --tw-gradient-to: rgb(0 0 0 / 0) var(--tw-gradient-to-position);
                    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
                }
                .via-white {
                    --tw-gradient-to: rgb(255 255 255 / 0) var(--tw-gradient-to-position);
                    --tw-gradient-stops: var(--tw-gradient-from), #fff var(--tw-gradient-via-position),
                        var(--tw-gradient-to);
                }
                .to-white {
                    --tw-gradient-to: #fff var(--tw-gradient-to-position);
                }
                .stroke-\[\#FF2D20\] {
                    stroke: #ff2d20;
                }
                .object-cover {
                    object-fit: cover;
                }
                .object-top {
                    object-position: top;
                }
                .p-6 {
                    padding: 1.5rem;
                }
                .px-6 {
                    padding-left: 1.5rem;
                    padding-right: 1.5rem;
                }
                .py-10 {
                    padding-top: 2.5rem;
                    padding-bottom: 2.5rem;
                }
                .px-3 {
                    padding-left: 0.75rem;
                    padding-right: 0.75rem;
                }
                .py-16 {
                    padding-top: 4rem;
                    padding-bottom: 4rem;
                }
                .py-2 {
                    padding-top: 0.5rem;
                    padding-bottom: 0.5rem;
                }
                .pt-3 {
                    padding-top: 0.75rem;
                }
                .text-center {
                    text-align: center;
                }
                .font-sans {
                    font-family:
                        Figtree,
                        ui-sans-serif,
                        system-ui,
                        sans-serif,
                        Apple Color Emoji,
                        Segoe UI Emoji,
                        Segoe UI Symbol,
                        Noto Color Emoji;
                }
                .text-sm {
                    font-size: 0.875rem;
                    line-height: 1.25rem;
                }
                .text-sm\/relaxed {
                    font-size: 0.875rem;
                    line-height: 1.625;
                }
                .text-xl {
                    font-size: 1.25rem;
                    line-height: 1.75rem;
                }
                .font-semibold {
                    font-weight: 600;
                }
                .text-black {
                    --tw-text-opacity: 1;
                    color: rgb(0 0 0 / var(--tw-text-opacity));
                }
                .text-white {
                    --tw-text-opacity: 1;
                    color: rgb(255 255 255 / var(--tw-text-opacity));
                }
                .underline {
                    -webkit-text-decoration-line: underline;
                    text-decoration-line: underline;
                }
                .antialiased {
                    -webkit-font-smoothing: antialiased;
                    -moz-osx-font-smoothing: grayscale;
                }
                .shadow-\[0px_14px_34px_0px_rgba\(0\2c 0\2c 0\2c 0\.08\)\] {
                    --tw-shadow: 0px 14px 34px 0px rgba(0, 0, 0, 0.08);
                    --tw-shadow-colored: 0px 14px 34px 0px var(--tw-shadow-color);
                    box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000),
                        var(--tw-shadow);
                }
                .ring-1 {
                    --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width)
                        var(--tw-ring-offset-color);
                    --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width))
                        var(--tw-ring-color);
                    box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
                }
                .ring-transparent {
                    --tw-ring-color: transparent;
                }
                .ring-white\/\[0\.05\] {
                    --tw-ring-color: rgb(255 255 255 / 0.05);
                }
                .drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.06\)\] {
                    --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, 0.06));
                    filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale)
                        var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
                }
                .drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.25\)\] {
                    --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, 0.25));
                    filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale)
                        var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
                }
                .transition {
                    transition-property:
                        color,
                        background-color,
                        border-color,
                        fill,
                        stroke,
                        opacity,
                        box-shadow,
                        transform,
                        filter,
                        -webkit-text-decoration-color,
                        -webkit-backdrop-filter;
                    transition-property: color, background-color, border-color, text-decoration-color, fill, stroke,
                        opacity, box-shadow, transform, filter, backdrop-filter;
                    transition-property:
                        color,
                        background-color,
                        border-color,
                        text-decoration-color,
                        fill,
                        stroke,
                        opacity,
                        box-shadow,
                        transform,
                        filter,
                        backdrop-filter,
                        -webkit-text-decoration-color,
                        -webkit-backdrop-filter;
                    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                    transition-duration: 150ms;
                }
                .duration-300 {
                    transition-duration: 300ms;
                }
                .selection\:bg-\[\#FF2D20\] *::selection {
                    --tw-bg-opacity: 1;
                    background-color: rgb(255 45 32 / var(--tw-bg-opacity));
                }
                .selection\:text-white *::selection {
                    --tw-text-opacity: 1;
                    color: rgb(255 255 255 / var(--tw-text-opacity));
                }
                .selection\:bg-\[\#FF2D20\]::selection {
                    --tw-bg-opacity: 1;
                    background-color: rgb(255 45 32 / var(--tw-bg-opacity));
                }
                .selection\:text-white::selection {
                    --tw-text-opacity: 1;
                    color: rgb(255 255 255 / var(--tw-text-opacity));
                }
                .hover\:text-black:hover {
                    --tw-text-opacity: 1;
                    color: rgb(0 0 0 / var(--tw-text-opacity));
                }
                .hover\:text-black\/70:hover {
                    color: rgb(0 0 0 / 0.7);
                }
                .hover\:ring-black\/20:hover {
                    --tw-ring-color: rgb(0 0 0 / 0.2);
                }
                .focus\:outline-none:focus {
                    outline: 2px solid transparent;
                    outline-offset: 2px;
                }
                .focus-visible\:ring-1:focus-visible {
                    --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width)
                        var(--tw-ring-offset-color);
                    --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width))
                        var(--tw-ring-color);
                    box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
                }
                .focus-visible\:ring-\[\#FF2D20\]:focus-visible {
                    --tw-ring-opacity: 1;
                    --tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity));
                }
                @media (min-width: 640px) {
                    .sm\:size-16 {
                        width: 4rem;
                        height: 4rem;
                    }
                    .sm\:size-6 {
                        width: 1.5rem;
                        height: 1.5rem;
                    }
                    .sm\:pt-5 {
                        padding-top: 1.25rem;
                    }
                }
                @media (min-width: 768px) {
                    .md\:row-span-3 {
                        grid-row: span 3 / span 3;
                    }
                }
                @media (min-width: 1024px) {
                    .lg\:col-start-2 {
                        grid-column-start: 2;
                    }
                    .lg\:h-16 {
                        height: 4rem;
                    }
                    .lg\:max-w-7xl {
                        max-width: 80rem;
                    }
                    .lg\:grid-cols-3 {
                        grid-template-columns: repeat(3, minmax(0, 1fr));
                    }
                    .lg\:grid-cols-2 {
                        grid-template-columns: repeat(2, minmax(0, 1fr));
                    }
                    .lg\:flex-col {
                        flex-direction: column;
                    }
                    .lg\:items-end {
                        align-items: flex-end;
                    }
                    .lg\:justify-center {
                        justify-content: center;
                    }
                    .lg\:gap-8 {
                        gap: 2rem;
                    }
                    .lg\:p-10 {
                        padding: 2.5rem;
                    }
                    .lg\:pb-10 {
                        padding-bottom: 2.5rem;
                    }
                    .lg\:pt-0 {
                        padding-top: 0px;
                    }
                    .lg\:text-\[\#FF2D20\] {
                        --tw-text-opacity: 1;
                        color: rgb(255 45 32 / var(--tw-text-opacity));
                    }
                }
                @media (prefers-color-scheme: dark) {
                    .dark\:block {
                        display: block;
                    }
                    .dark\:hidden {
                        display: none;
                    }
                    .dark\:bg-black {
                        --tw-bg-opacity: 1;
                        background-color: rgb(0 0 0 / var(--tw-bg-opacity));
                    }
                    .dark\:bg-zinc-900 {
                        --tw-bg-opacity: 1;
                        background-color: rgb(24 24 27 / var(--tw-bg-opacity));
                    }
                    .dark\:via-zinc-900 {
                        --tw-gradient-to: rgb(24 24 27 / 0) var(--tw-gradient-to-position);
                        --tw-gradient-stops: var(--tw-gradient-from), #18181b var(--tw-gradient-via-position),
                            var(--tw-gradient-to);
                    }
                    .dark\:to-zinc-900 {
                        --tw-gradient-to: #18181b var(--tw-gradient-to-position);
                    }
                    .dark\:text-white\/50 {
                        color: rgb(255 255 255 / 0.5);
                    }
                    .dark\:text-white {
                        --tw-text-opacity: 1;
                        color: rgb(255 255 255 / var(--tw-text-opacity));
                    }
                    .dark\:text-white\/70 {
                        color: rgb(255 255 255 / 0.7);
                    }
                    .dark\:ring-zinc-800 {
                        --tw-ring-opacity: 1;
                        --tw-ring-color: rgb(39 39 42 / var(--tw-ring-opacity));
                    }
                    .dark\:hover\:text-white:hover {
                        --tw-text-opacity: 1;
                        color: rgb(255 255 255 / var(--tw-text-opacity));
                    }
                    .dark\:hover\:text-white\/70:hover {
                        color: rgb(255 255 255 / 0.7);
                    }
                    .dark\:hover\:text-white\/80:hover {
                        color: rgb(255 255 255 / 0.8);
                    }
                    .dark\:hover\:ring-zinc-700:hover {
                        --tw-ring-opacity: 1;
                        --tw-ring-color: rgb(63 63 70 / var(--tw-ring-opacity));
                    }
                    .dark\:focus-visible\:ring-\[\#FF2D20\]:focus-visible {
                        --tw-ring-opacity: 1;
                        --tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity));
                    }
                    .dark\:focus-visible\:ring-white:focus-visible {
                        --tw-ring-opacity: 1;
                        --tw-ring-color: rgb(255 255 255 / var(--tw-ring-opacity));
                    }
                }
            </style>
        @endif
    </head>
    <body class="relative flex min-h-screen w-full flex-col bg-white text-gray-800 dark:bg-zinc-800 dark:text-gray-200">
        @include('layouts.navigation', ['unreadMsgs' => $unreadMsgs, 'favoritedOffers' => $favoritedOffers])

        <x-auth-session-status :status="session('success')" />

        {{-- Powiadomienie --}}
        <div
            id="notification"
            class="fixed left-0 right-0 top-0 mt-16 hidden h-16 bg-green-600 px-6 py-4 text-lg font-medium text-white transition-all duration-300"
            style="z-index: 1000"
        >
            <span id="notification-message"></span>
        </div>

        {{-- Wyszukiwarka --}}
        <section class="mx-auto mb-6 mt-24 w-full rounded-lg bg-slate-600 px-4 py-4 sm:px-6 lg:max-w-7xl">
            {{-- Nagłowek --}}
            <header class="mx-auto w-full px-4 py-4 lg:max-w-7xl">
                <h1 class="text-3xl font-semibold">Znajdź auto idealne dla siebie!</h1>
                <p class="text-xl text-gray-300">
                    Przeglądaj setki ofert samochodów i znajdź idealny pojazd dla siebie. Skorzystaj z naszej
                    wyszukiwarki, aby szybko i łatwo znaleźć samochód spełniający Twoje wymagania.
                </p>
            </header>
            <form
                method="GET"
                action="{{ route('offers.search') }}"
                class="grid grid-cols-1 gap-4 p-4 lg:grid-cols-3 lg:gap-6"
            >
                <h3 class="col-span-full text-xl font-semibold">Wyszukiwarka</h3>
                {{-- Select marka --}}
                <div x-init="init()" x-data="fetchModelsHandler()" class="flex flex-col gap-4">
                    <div>
                        <x-select
                            :options="$carBrands"
                            :validationName="'carBrand'"
                            :placeholder="'Wybierz markę'"
                            :label="'Marka pojazdu'"
                            x-on:x-select-change="handleBrandChange($event.detail)"
                        />
                    </div>
                    {{-- Select model --}}
                    <div
                        class="relative"
                        x-data="{
                            open: false,
                            activeIndex: -1,
                            validationName: 'carModel',
                            placeholder: 'Wybierz model',
                            toggle() {
                                if (this.open) {
                                    return this.close()
                                }
                                this.$refs.button.focus()
                                this.open = true
                            },
                            close(focusAfter) {
                                if (! this.open) return
                                this.open = false
                                this.activeIndex = -1
                                focusAfter && focusAfter.focus()
                            },
                            selectOption(index) {
                                this.selectedModel = models[index].slug
                                this.close(this.$refs.button)
                            },
                            handleKeydown(event) {
                                if (! this.open) {
                                    if (event.key === 'Enter') {
                                        this.toggle()
                                    }
                                    return
                                }
                                if (event.key === 'ArrowDown') {
                                    this.activeIndex = (this.activeIndex + 1) % models.length
                                } else if (event.key === 'ArrowUp') {
                                    this.activeIndex =
                                        (this.activeIndex - 1 + models.length) % models.length
                                } else if (event.key === 'Enter' && this.activeIndex !== -1) {
                                    this.selectOption(this.activeIndex)
                                } else if (event.key === 'Escape') {
                                    this.close(this.$refs.button)
                                }
                            },
                        }"
                        x-on:keydown.escape.prevent.stop="close($refs.button)"
                        x-on:keydown.arrow-down.prevent.stop="handleKeydown"
                        x-on:keydown.arrow-up.prevent.stop="handleKeydown"
                        x-on:keydown.enter.prevent.stop="handleKeydown"
                        x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                        x-id="['dropdown-button']"
                    >
                        <label
                            x-bind:for="validationName"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        >
                            Model pojazdu
                        </label>
                        {{-- Hidden Input --}}
                        <input
                            type="text"
                            class="hidden appearance-none border-none bg-transparent focus:outline-none"
                            x-bind:name="validationName"
                            x-bind:id="validationName"
                            x-bind:value="selectedModel"
                        />
                        <button
                            x-ref="button"
                            type="button"
                            x-bind:disabled="secondDisabled"
                            x-bind:aria-expanded="open"
                            x-bind:aria-controls="$id('dropdown-button')"
                            x-on:click="toggle()"
                            class="mt-1 flex w-full min-w-48 items-center justify-between gap-2 rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:opacity-25 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        >
                            <span x-text="slugToName(selectedModel) || placeholder"></span>
                            <svg
                                x-bind:class="{
                                    'rotate-180': open,
                                    'duration-300': true,
                                    'transition-transform': true,
                                }"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-5 dark:text-gray-300"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <menu
                            x-show="open"
                            x-ref="panel"
                            x-transition.origin.top.left
                            x-on:click.outside="close($refs.button)"
                            x-bind:id="$id('dropdown-button')"
                            style="display: none"
                            role="menu"
                            class="custom-scroll absolute z-10 mt-2 max-h-56 w-full min-w-48 overflow-y-auto rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                        >
                            <template x-for="(option, index) in models" x-bind:key="index">
                                <li
                                    role="menuitem"
                                    class="cursor-pointer px-4 py-2 transition duration-150 first-of-type:rounded-t-md last-of-type:rounded-b-md hover:bg-indigo-600"
                                    x-bind:class="{
                                        'bg-indigo-600': activeIndex === index || selectedModel === option.slug,
                                    }"
                                    x-on:click="selectOption(index)"
                                    x-on:mouseenter="activeIndex = index"
                                    x-on:mouseleave="activeIndex = -1"
                                    x-text="option.name"
                                ></li>
                            </template>
                        </menu>
                    </div>
                </div>

                {{-- Ceny --}}
                <div class="flex flex-col gap-4">
                    {{-- Cena min --}}

                    <div class="flex flex-col">
                        <x-input-label for="price_min" value="Cena minimalna [zł]" />
                        <x-text-input
                            id="price_min"
                            class="mt-1 block w-full"
                            type="text"
                            name="price_min"
                            :value="old('price_min') ?? request('price_min')"
                            placeholder="4000"
                            title="Podaj cenę w zł"
                            minLength="1"
                            maxLength="8"
                        />
                        <x-input-error :messages="$errors->get('price_min')" class="mt-2" />
                    </div>
                    {{-- Cena max --}}
                    <div class="flex flex-col">
                        <x-input-label for="price_max" value="Cena maksymalna [zł]" />
                        <x-text-input
                            id="price_max"
                            class="mt-1 block w-full"
                            type="text"
                            name="price_max"
                            :value="old('price_max') ?? request('price_max')"
                            placeholder="25000"
                            title="Podaj cenę w zł"
                            minLength="1"
                            maxLength="8"
                        />
                        <x-input-error :messages="$errors->get('price_max')" class="mt-2" />
                    </div>
                </div>
                {{-- Rok produkcji --}}
                <div class="flex flex-col gap-4">
                    <div>
                        <x-input-label for="prod_year" value="Rok produkcji" />
                        <x-text-input
                            id="prod_year"
                            class="mt-1 block w-full"
                            type="number"
                            :value="old('prod_year', request('prod_year'))"
                            name="prod_year"
                            min="1900"
                            max="2024"
                            placeholder="2012"
                            title="Podaj rok w odpowiedniej formule YYYY"
                        />
                        <x-input-error :messages="$errors->get('prod_year')" class="mt-2" />
                    </div>
                    {{-- Typ paliwa --}}
                    <div>
                        <x-select
                            :options="$fuelTypes"
                            :placeholder="'Wybierz paliwo'"
                            :validationName="'fuel_type'"
                            :label="'Rodzaj paliwa'"
                        ></x-select>
                    </div>
                </div>

                {{-- Sortowanie --}}
                <div class="mt-4 flex flex-col gap-4">
                    @php
                        $sortOptions = collect([
                            (object) ['slug' => 'popular', 'name' => 'Popularne'],
                            (object) ['slug' => 'new', 'name' => 'Najnowsze'],
                            (object) ['slug' => 'price_desc', 'name' => 'Cena: od najwyższej'],
                            (object) ['slug' => 'price_asc', 'name' => 'Cena: od najniższej'],
                            (object) ['slug' => 'mileage_min', 'name' => 'Najniższy przebieg'],
                            (object) ['slug' => 'mileage_max', 'name' => 'Najwyższy przebieg'],
                        ]);
                    @endphp

                    <x-select
                        :label="'Sortowanie ofert'"
                        :options="$sortOptions"
                        :validationName="'sortBy'"
                        :placeholder="'Sortuj według'"
                        x-on:x-select-change="setTimeout(() => ($event.target.closest('form')).submit(), 100)"
                    />
                </div>

                <div class="col-span-full mt-4 flex w-full items-end justify-end gap-6 lg:col-span-2">
                    <x-button
                        type="button"
                        class="h-[40px] min-w-[100px]"
                        onClick="window.location.href='{{route('welcome.index')}}'"
                        style="secondary"
                    >
                        Wyczyść
                    </x-button>
                    <x-button type="submit" style="primary" class="h-[40px] min-w-[200px]">Wyszukaj</x-button>
                </div>
            </form>
        </section>

        {{-- Oferty --}}
        <main
            class="mx-auto mb-16 flex min-h-full w-full max-w-7xl flex-col gap-4 rounded-lg px-4 pb-14 text-gray-800 lg:px-0 dark:text-white"
        >
            @if ($offers->count() > 0)
                @foreach ($offers as $offer)
                    <article
                        data-id="{{ $offer->id }}"
                        class="mx-auto flex w-full max-w-[500px] flex-col overflow-hidden rounded-lg bg-slate-700 shadow-lg lg:max-w-full lg:flex-row"
                    >
                        <div
                            class="relative flex w-full overflow-hidden lg:w-1/3"
                            x-data="slider({{ $offer->images->count() }})"
                            id="img-slider"
                        >
                            <div
                                class="flex transition-transform duration-500"
                                :style="`transform: translateX(-${currentIndex * 100}%);`"
                            >
                                @foreach ($offer->images as $image)
                                    <img
                                        loading="lazy"
                                        class="h-64 w-full flex-shrink-0 rounded-t-lg object-cover lg:rounded-l-lg lg:rounded-tr-none"
                                        src="{{ asset('storage/' . $image->path) }}"
                                        alt="Ofeta {{ $offer->carDetails->carModel->carBrand->name }} {{ $offer->carDetails->carModel->name }}-{{ $image->id }}"
                                    />
                                @endforeach
                            </div>

                            <div
                                class="absolute top-[50%] flex w-full translate-y-[-50%] items-center justify-between px-2"
                            >
                                <button
                                    type="button"
                                    class="rounded-md bg-black/20 p-2 hover:bg-black/60"
                                    x-on:click="prev"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        class="size-6 stroke-white stroke-[3]"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.75 19.5 8.25 12l7.5-7.5"
                                        />
                                    </svg>
                                </button>
                                <button
                                    type="button"
                                    class="rounded-md bg-black/20 p-2 hover:bg-black/60"
                                    x-on:click="next"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        class="size-6 stroke-white stroke-[3]"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="m8.25 4.5 7.5 7.5-7.5 7.5"
                                        />
                                    </svg>
                                </button>
                            </div>
                            <div
                                id="pagination"
                                class="absolute bottom-0 flex w-full items-center justify-center gap-2 bg-black/40 p-2"
                            >
                                @foreach ($offer->images as $index => $image)
                                    <button
                                        :class="{'bg-indigo-600': currentIndex === {{ $index }}, 'bg-white': currentIndex !== {{ $index }}}"
                                        class="h-3 w-3 rounded-full border-2"
                                        x-on:click="goTo({{ $index }})"
                                    ></button>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex w-full flex-1 flex-col justify-between p-4 sm:flex-row lg:p-6">
                            {{-- Detale --}}
                            <div class="flex flex-col justify-between">
                                <div>
                                    <h4 class="text-xl font-semibold">
                                        {{ $offer->carDetails->carModel->carBrand->name }}
                                        {{ $offer->carDetails->carModel->name }}
                                    </h4>
                                    <p class="text-sm text-gray-300">
                                        {{ $offer->carDetails->engine_capacity }} cm3 •
                                        {{ $offer->carDetails->engine_power }} KM
                                    </p>
                                </div>
                                <div class="my-2 grid grid-cols-1 text-sm lg:my-0 lg:grid-cols-2 lg:gap-4">
                                    <p>• Przebieg: {{ number_format($offer->carDetails->mileage, 0, '', ' ') }} km</p>
                                    <p>• Rodzaj paliwa: {{ $offer->carDetails->fuel_type }}</p>
                                    <p>• Skrzynia biegów: {{ $offer->carDetails->transmission }}</p>
                                    <p>• Rok produkcji: {{ $offer->carDetails->prod_year }}</p>
                                </div>
                                <div class="text-gray-300">
                                    <div class="flex items-center gap-1 text-sm">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="size-4"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"
                                            />
                                        </svg>
                                        <p>{{ $offer->city }}</p>
                                    </div>
                                    <p class="mt-1 text-xs">Opublikowano {{ $offer->created_at->diffForHumans() }}</p>
                                    <a
                                        class="mt-2 text-xs font-medium underline transition-colors duration-300 hover:text-white"
                                        href="{{ route('reviews.profile', $offer->user_id) }}"
                                    >
                                        Osoba prywatna - {{ $offer->user->name }}
                                    </a>
                                </div>
                            </div>
                            {{-- Cena i przycisk --}}
                            <div class="flex flex-col items-end justify-between gap-4">
                                <p class="mt-4 text-right text-2xl font-semibold sm:mt-0">
                                    {{ number_format($offer->price, 0, '', ' ') }} PLN
                                </p>

                                <div class="flex items-center gap-4 sm:flex-row">
                                    @auth
                                        <button
                                            type="button"
                                            data-offer-id="{{ $offer->id }}"
                                            class="favorite-button transition-all duration-200 hover:scale-125"
                                            aria-pressed="{{ auth()->user() && auth()->user()->favorites->contains($offer->id) ? 'true' : 'false' }}"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="{{ auth()->user() && auth()->user()->favorites->contains($offer->id) ? 'currentColor' : 'none' }}"
                                                viewBox="0 0 24 24"
                                                class="size-6"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                                                />
                                            </svg>
                                        </button>
                                    @endauth

                                    <x-button style="secondary" type="button" :href="route('offers.show', $offer->id)">
                                        Zobacz ogłoszenie
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach

                <div class="mt-6">
                    {{ $offers->links('pagination::tailwind') }}
                </div>
            @else
                <div
                    class="mt-2 flex min-h-[150px] w-full flex-1 flex-col items-center justify-center gap-4 rounded-lg bg-slate-700/80"
                >
                    <h4 class="text-2xl font-semibold">Brak ofert z pasującymi filtrami!</h4>
                    <p class="text-sm text-gray-300">Zmień lub wyczyść filtry.</p>
                </div>
            @endif
        </main>

        {{-- Dekoracja --}}
        <x-bg-decoration />
        {{-- Stopka --}}
        <x-footer />
    </body>
</html>

<script>
    function fetchModelsHandler() {
        return {
            // Wybrany model i marka - pobierany ze starej wartości formularza w PHP/Laravel
            selectedModel: {!! json_encode(request()->old('carModel', request()->get('carModel', ''))) !!},
            selectedBrand: {!! json_encode(request()->old('carBrand', request()->get('carBrand', ''))) !!},

            // Flaga, która kontroluje, czy pole wyboru modelu jest zablokowane
            secondDisabled: true,
            // Tablica przechowująca dostępne modele dla wybranej marki
            models: [],

            // Asynchroniczna funkcja do pobierania modeli na podstawie slug-a marki
            async fetchModels(brandSlug) {
                // Reset wartości na domyślne
                this.secondDisabled = true;
                this.models = [];

                try {
                    const response = await fetch(`/api/get-models?slug=${brandSlug}`);
                    const data = await response.json();

                    if (data.error) {
                        return;
                    }

                    this.models = data;
                    this.secondDisabled = false;
                } catch (error) {
                    console.error(error);
                }
            },
            // Funkcja konwertująca nazwę (np. "Example Name") na slug (np. "example-name")
            nameToSlug(name) {
                return name
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            },
            // Funkcja konwertująca slug (np. "example-name") na czytelną nazwę (np. "Example Name")
            slugToName(slug) {
                if (!slug) return '';
                return slug
                    .replace(/-/g, ' ')
                    .replace(/\s+/g, ' ')
                    .trim()
                    .replace(/\b\w/g, (char) => char.toUpperCase());
            },
            // Funkcja inicjalizująca, wywoływana przy załadowaniu komponentu
            init() {
                // Jeśli jest wybrana marka, pobieramy modele dla tej marki
                if (this.selectedBrand) {
                    this.fetchModels(this.nameToSlug(this.selectedBrand));
                }
            },
            // Funkcja obsługująca zmianę wybranej marki
            handleBrandChange(brandSlug) {
                // Ustawiamy nową wybraną markę i pobieramy dla niej marki
                this.selectedBrand = brandSlug;
                this.fetchModels(brandSlug);

                // Sprawdzamy, czy wybrany wcześniej model istnieje w nowej liście modeli
                if (this.selectedModel) {
                    const modelExists = this.models.some((model) => model.slug === this.selectedModel);
                    // Jeśli model nie istnieje, resetujemy wybór modelu
                    if (!modelExists) {
                        this.selectedModel = '';
                    }
                }
            },
        };
    }
    function slider(totalSlides) {
        return {
            currentIndex: 0,
            total: totalSlides,
            next() {
                this.currentIndex = (this.currentIndex + 1) % this.total;
            },
            prev() {
                this.currentIndex = (this.currentIndex - 1 + this.total) % this.total;
            },
            goTo(index) {
                this.currentIndex = index;
            },
        };
    }

    document.addEventListener('DOMContentLoaded', () => {
        const notification = document.getElementById('notification');
        const notificationMessage = document.getElementById('notification-message');

        function showNotification(message, type = 'success') {
            notificationMessage.textContent = message;

            notification.classList.remove('bg-green-600', 'bg-red-600', 'bg-blue-600');
            if (type === 'success') {
                notification.classList.add('bg-green-600');
            } else if (type === 'error') {
                notification.classList.add('bg-red-600');
            } else if (type === 'info') {
                notification.classList.add('bg-blue-600');
            }

            notification.classList.remove('hidden', 'opacity-0');
            notification.classList.add('opacity-100');

            setTimeout(() => {
                hideNotification();
            }, 5000);
        }

        function hideNotification() {
            notification.classList.add('opacity-0');
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 300);
        }

        // Przyciski dodwanie do ulubionych
        const buttons = document.querySelectorAll('.favorite-button');

        buttons.forEach((button) => {
            button.addEventListener('click', function () {
                const offerId = this.getAttribute('data-offer-id');
                const svgIcon = this.querySelector('svg');
                const isPressed = this.getAttribute('aria-pressed') === 'true';

                this.disabled = true;

                fetch('{{ route('favorite.toggle') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ offer_id: offerId }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        showNotification(data.message, 'success');

                        if (data.favorited) {
                            svgIcon.setAttribute('fill', 'currentColor');
                            this.setAttribute('aria-pressed', 'true');
                        } else {
                            svgIcon.setAttribute('fill', 'none');
                            this.setAttribute('aria-pressed', 'false');
                        }
                    })
                    .catch((error) => console.error('Error:', error))
                    .finally(() => {
                        this.disabled = false;
                    });
            });
        });
    });
</script>
