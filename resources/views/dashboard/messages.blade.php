<x-app-layout>
    <x-auth-session-status :status="session('success')" class="fixed left-0 top-16 z-50 h-16 w-full" />
    {{-- Powiadomienie --}}
    <div
        id="notification"
        class="fixed left-0 right-0 top-0 hidden h-16 bg-green-600 px-6 py-4 text-lg font-medium text-white transition-all duration-300"
        style="z-index: 1000"
    >
        <span id="notification-message"></span>
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-semibold">Panel użytkownika</h1>
            <h2 class="text-2xl text-gray-200">Witaj, {{ $userName }}! 👋</h2>
            <header class="ml-auto mt-4 flex gap-4 rounded-t-lg px-6 py-4">
                <x-button
                    type="button"
                    style="secondary"
                    :href="route('welcome.index')"
                    class="flex items-center gap-2"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="mr-2 h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7-7l-7 7 7 7"></path>
                    </svg>
                    Strona główna
                </x-button>
            </header>
            <section
                class="mb-16 flex flex-col gap-4 rounded-lg bg-gray-100 p-6 text-gray-800 shadow-md dark:bg-slate-700 dark:text-white"
                x-data="{ showArchive: false }"
            >
                <header class="flex flex-col gap-1">
                    <h3 class="text-xl font-semibold">Twoje wiadomości</h3>
                    <p class="text-semibold text-gray-300">Aby zobaczyć wiadomości, kliknij w wybraną konwersację.</p>
                </header>
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    {{-- Zwykłe konwersacje --}}
                    <div class="flex flex-col gap-2" x-show="!showArchive" x-cloak>
                        <h4 class="text-lg font-semibold">Konwersacje</h4>
                        @if ($normalConversations->isnotEmpty())
                            <div class="custom-scroll flex max-h-[500px] flex-col gap-2 overflow-y-auto">
                                @foreach ($normalConversations as $key => $messages)
                                    @php
                                        $lastMessage = $messages->last();
                                        $otherUser = $lastMessage->sender_id === auth()->user()->id ? $lastMessage->receiver : $lastMessage->sender;
                                        $offer = $lastMessage->offer;
                                    @endphp

                                    <div
                                        class="flex cursor-pointer items-center justify-between gap-1 rounded-md bg-slate-800/60 py-2 pl-2 pr-4 transition-colors duration-300 hover:bg-slate-800"
                                        data-message="{{ $lastMessage->message }}"
                                        data-offer-id="{{ $offer->id }}"
                                        data-user-id="{{ auth()->user()->id }}"
                                        data-isArchived="false"
                                        data-offer-name="{{ $offer->carDetails->carModel->carBrand->name }} {{ $offer->carDetails->carModel->name }} {{ $offer->carDetails->prod_year }}"
                                        data-receiver-name="{{ $otherUser->name }}"
                                        data-receiver-id="{{ $otherUser->id }}"
                                    >
                                        <div class="flex items-center gap-1">
                                            @php
                                                $unreadMessagesCount = $messages
                                                    ->where('read', false)
                                                    ->where('receiver_id', auth()->user()->id)
                                                    ->count();
                                            @endphp

                                            <div class="relative">
                                                @if ($unreadMessagesCount > 0)
                                                    <span
                                                        class="absolute right-0 top-0 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-xs font-semibold text-white"
                                                    >
                                                        {{ $unreadMessagesCount }}
                                                    </span>
                                                @endif

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    class="h-16 w-16 stroke-gray-300"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                                    />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="text-lg font-semibold">{{ $otherUser->name }}</h4>
                                                <p>
                                                    @if ($offer->user_id === auth()->user()->id)
                                                        <strong>Dotyczy Twojej oferty:</strong>
                                                    @else
                                                        <strong>Dotyczy oferty {{ $otherUser->name }}:</strong>
                                                    @endif

                                                    {{ $offer->carDetails->carModel->carBrand->name }}
                                                    {{ $offer->carDetails->carModel->name }}
                                                    {{ $offer->carDetails->prod_year }}
                                                </p>
                                                <p class="text-wrap text-xs text-gray-300">
                                                    <strong>Ostatnia wiadomość:</strong>
                                                    {{ $lastMessage->message }}
                                                </p>
                                            </div>
                                        </div>

                                        <button
                                            type="button"
                                            onclick="event.stopPropagation(); openModal({{ $messages }}, 'archive')"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                class="size-6 stroke-red-500 transition-transform duration-300 hover:scale-110"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"
                                                />
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="flex h-[88px] items-center justify-center rounded-md bg-slate-800/60">
                                <p class="text-lg text-gray-300">Nie masz nowych konwersacji.</p>
                            </div>
                        @endif

                        <button
                            id="show-archive-btn"
                            x-on:click="showArchive = true"
                            class="mt-2 w-fit items-start text-gray-300 underline transition-colors duration-300 hover:text-white"
                        >
                            Archiwum konwersacji ({{ $archivedConversations->count() }})
                        </button>
                    </div>

                    {{-- Archiwum konwersacji --}}
                    <div class="flex flex-col gap-2" x-show="showArchive" x-cloak>
                        <h4 class="text-lg font-semibold">Archiwum</h4>
                        @if ($archivedConversations->isnotEmpty())
                            <div class="custom-scroll flex max-h-[500px] flex-col gap-2 overflow-y-auto">
                                @foreach ($archivedConversations as $key => $messages)
                                    @php
                                        $lastMessage = $messages->last();
                                        $otherUser = $lastMessage->sender_id === auth()->user()->id ? $lastMessage->receiver : $lastMessage->sender;
                                        $offer = $lastMessage->offer;
                                    @endphp

                                    <div
                                        class="flex cursor-pointer items-center justify-between gap-1 rounded-md bg-slate-800/60 py-2 pl-2 pr-4 opacity-80 transition-colors duration-300 hover:bg-slate-800"
                                        data-message="{{ $lastMessage->message }}"
                                        data-offer-id="{{ $offer->id }}"
                                        data-user-id="{{ auth()->user()->id }}"
                                        data-isArchived="true"
                                        data-offer-name="{{ $offer->carDetails->carModel->carBrand->name }} {{ $offer->carDetails->carModel->name }} {{ $offer->carDetails->prod_year }}"
                                        data-receiver-name="{{ $otherUser->name }}"
                                        data-receiver-id="{{ $otherUser->id }}"
                                    >
                                        <div class="flex items-center gap-1">
                                            <div>
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    class="h-16 w-16 stroke-gray-300"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                                    />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="text-lg font-semibold">{{ $otherUser->name }}</h4>
                                                <p>
                                                    @if ($offer->user_id === auth()->user()->id)
                                                        <strong>Dotyczy Twojej oferty:</strong>
                                                    @else
                                                        <strong>Dotyczy oferty {{ $otherUser->name }}:</strong>
                                                    @endif

                                                    {{ $offer->carDetails->carModel->carBrand->name }}
                                                    {{ $offer->carDetails->carModel->name }}
                                                    {{ $offer->carDetails->prod_year }}
                                                </p>
                                                <p class="text-wrap text-xs text-gray-300">
                                                    <strong>Ostatnia wiadomość:</strong>
                                                    {{ $lastMessage->message }}
                                                </p>
                                            </div>
                                        </div>

                                        <button
                                            type="button"
                                            onclick="event.stopPropagation(); openModal({{ $messages }}, 'restore')"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                class="size-6 stroke-red-500 transition-transform duration-300 hover:scale-110"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"
                                                />
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="flex h-[88px] items-center justify-center rounded-md bg-slate-800/60">
                                <p class="text-lg text-gray-300">Nie masz żadnych zarchiwizowanych konwersacji.</p>
                            </div>
                        @endif

                        <button
                            id="show-normal-btn"
                            x-on:click="showArchive = false"
                            class="mt-2 w-fit items-start text-gray-300 underline transition-colors duration-300 hover:text-white"
                        >
                            Zwykłe konwersacje ({{ $normalConversations->count() }})
                        </button>
                    </div>

                    <aside class="flex h-full flex-col gap-2 rounded-md" id="communicator">
                        <h4 class="text-lg font-semibold">Komunikator</h4>
                        <div
                            id="conversation-container"
                            style="display: none"
                            class="relative h-[500px] flex-col gap-4 rounded-md bg-slate-800"
                        >
                            {{-- Nagłówek --}}
                            <header class="flex w-full items-center justify-between rounded-t-md p-2 shadow-xl">
                                <a
                                    class="h-full w-fit cursor-pointer rounded-md bg-slate-700 px-4 py-1 transition-colors duration-300 hover:bg-white hover:text-slate-800"
                                >
                                    <h3 class="font-semibold" id="receiver-name"></h3>
                                </a>

                                <a
                                    class="ml-auto w-fit cursor-pointer rounded-md bg-slate-700 px-4 py-1 transition-colors duration-300 hover:bg-white hover:text-slate-800"
                                >
                                    <h3 class="font-semibold" id="offer-name"></h3>
                                </a>
                            </header>
                            {{-- Wiadomości --}}
                            <div
                                class="custom-scroll relative flex h-full w-full flex-col gap-4 overflow-y-auto p-4"
                                id="message-box"
                            >
                                <div class="absolute left-[50%] top-[50%] translate-x-[-50%] translate-y-[-50%]">
                                    <svg
                                        class="h-6 w-6 animate-spin text-white"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <circle
                                            class="opacity-25"
                                            cx="12"
                                            cy="12"
                                            r="10"
                                            stroke="currentColor"
                                            stroke-width="4"
                                        ></circle>
                                        <path
                                            class="opacity-75"
                                            fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C3.163 0 0 7.163 0 12h4zm2 5.291A7.963 7.963 0 014 12H0c0 2.644 1.053 5.053 2.929 6.929l1.071-1.638z"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                            {{-- Formularz nowej wiadomości --}}
                            <div class="p-4" id="reply-form-container">
                                <form id="reply-form" class="flex flex-col gap-4" method="POST">
                                    @csrf
                                    <input type="hidden" name="sender_id" id="reply-sender-id" />
                                    <input type="hidden" name="receiver_id" id="reply-receiver-id" />
                                    <input type="hidden" name="offer_id" id="reply-offer-id" />
                                    <input type="hidden" name="dashboard" value="true" />

                                    <div class="flex-1">
                                        <x-input-label for="message" value="Nowa wiadomość" />
                                        <textarea
                                            name="message"
                                            id="message"
                                            minlength="10"
                                            maxlength="1000"
                                            title="Wprowadź wiadomość do 1000 znaków"
                                            placeholder="Minimum 10 znaków"
                                            rows="3"
                                            class="custom-scroll mt-1 w-full resize-none overflow-y-scroll rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:opacity-60 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-indigo-600"
                                        >
{{ old('message') }}</textarea
                                        >
                                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-button id="submit-button" type="submit" style="primary">Wyślij</x-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="placeholder" class="relative flex h-[500px] flex-col rounded-md bg-slate-800">
                            <header
                                class="flex h-12 w-full items-center justify-between gap-4 rounded-t-md p-2 shadow-xl"
                            >
                                <div class="h-full w-48 rounded-md bg-slate-700"></div>
                                <div class="h-full w-24 rounded-md bg-slate-600/80"></div>
                            </header>
                            <div class="flex w-full flex-col gap-4 p-4">
                                <div class="mt-4 flex flex-col gap-2">
                                    <span class="animate-gradient h-8 w-[40%] rounded-md bg-slate-700"></span>
                                    <span class="animate-gradient h-12 w-[50%] rounded-md bg-slate-700"></span>
                                </div>
                                <div class="mt-4 flex flex-col items-end gap-2">
                                    <span class="animate-gradient h-8 w-[70%] rounded-md bg-slate-700/60"></span>
                                    <span class="animate-gradient h-12 w-[50%] rounded-md bg-slate-700/60"></span>
                                </div>
                            </div>
                            <div class="mt-auto flex flex-col gap-4 p-4">
                                <div class="flex h-24 w-full rounded-md bg-slate-700 px-4 py-2"></div>
                                <div class="h-8 w-24 rounded-md bg-slate-600/80"></div>
                            </div>
                        </div>
                    </aside>
                </div>
            </section>
        </div>
    </div>
    @auth
        @if ($normalConversations->isnotEmpty())
            <div id="archiveModal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm">
                <div
                    class="absolute left-[50%] top-[50%] w-full max-w-sm translate-x-[-50%] translate-y-[-50%] rounded-lg bg-slate-800 p-6 shadow-lg"
                >
                    <h2 class="mb-4 text-xl font-bold">Potwierdzenie przeniesienia do archiwum</h2>
                    <p class="mb-4">
                        Czy na pewno chcesz przenieść tą konwersację do archiwum? Możliwość wysyłania i otrzymywania
                        wiadomości dotyczących danej oferty zostanie zablokowana!
                    </p>
                    <form id="archiveForm" method="POST" action="placeholder">
                        @csrf
                        @method('PATCH')
                        <div class="flex items-center justify-end gap-4">
                            <x-button type="button" style="secondary" onclick="closeModal('archive')">Anuluj</x-button>
                            <x-button type="submit" class="min-w-[150px]" style="delete">Archiwizuj</x-button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        @if ($archivedConversations->isnotEmpty())
            <div id="restoreModal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm">
                <div
                    class="absolute left-[50%] top-[50%] w-full max-w-sm translate-x-[-50%] translate-y-[-50%] rounded-lg bg-slate-800 p-6 shadow-lg"
                >
                    <h2 class="mb-4 text-xl font-bold">Potwierdzenie przywrócenia konwersacji</h2>
                    <p class="mb-4">Czy na pewno chcesz przywrócić tą konwersację z archiwum?</p>
                    <form id="restoreForm" method="POST" action="placeholder">
                        @csrf
                        @method('PATCH')
                        <div class="flex items-center justify-end gap-4">
                            <x-button type="button" style="secondary" onclick="closeModal('restore')">Anuluj</x-button>
                            <x-button type="submit" class="min-w-[150px]" style="delete">Przywróć</x-button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endauth
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const conv = document.querySelector('#conversation-container');
        const placeholder = document.getElementById('placeholder');
        const messageLinks = document.querySelectorAll('div[data-message]');
        const receiverName = document.getElementById('receiver-name');
        const offerTitle = document.getElementById('offer-name');

        const messageTextarea = document.getElementById('message');
        const submitButton = document.getElementById('submit-button');

        const replyForm = document.getElementById('reply-form');
        const replySender = document.getElementById('reply-sender-id');
        const replyReceiver = document.getElementById('reply-receiver-id');
        const replyOfferId = document.getElementById('reply-offer-id');

        const communicator = document.getElementById('communicator');
        const messageBox = document.getElementById('message-box');

        let activeLink = null;

        messageLinks.forEach((link) => {
            link.addEventListener('click', function (e) {
                e.preventDefault();

                if (activeLink) {
                    activeLink.classList.remove('bg-slate-800', 'hover:bg-slate-900/60');
                    activeLink.classList.add('bg-slate-800/60', 'hover:bg-slate-800');
                }
                activeLink = this;

                const userName = this.getAttribute('data-receiver-name');
                const receiverId = this.getAttribute('data-receiver-id');
                const offerName = this.getAttribute('data-offer-name');
                const isArchived = this.getAttribute('data-isArchived');

                const offerId = this.getAttribute('data-offer-id');
                const userId = this.getAttribute('data-user-id');

                receiverName.textContent = `${userName}`;
                receiverName.parentElement.href = `/reviews/${receiverId}`;
                receiverName.parentElement.target = '_blank';

                offerTitle.textContent = `${offerName}`;
                offerTitle.parentElement.href = `/offers/${offerId}`;
                offerTitle.parentElement.target = '_blank';

                replyForm.action = `/offers/${offerId}/messages/${userId}/${receiverId}`;
                replySender.value = userId;
                replyReceiver.value = receiverId;
                replyOfferId.value = offerId;

                if (isArchived === 'true') {
                    messageTextarea.value = '';
                    messageTextarea.placeholder = 'Nie można wysyłać wiadomości do zarchiwizowanej konwersacji.';
                    messageTextarea.disabled = true;
                    submitButton.disabled = true;
                } else {
                    messageTextarea.placeholder = 'Minimum 10 znaków.';
                    messageTextarea.disabled = false;
                    submitButton.disabled = messageTextarea.value.length < 10;
                }

                fetch(`/api/messages/${userId}/${receiverId}/${offerId}`)
                    .then((response) => response.json())
                    .then((data) => {
                        messageBox.innerHTML = '';

                        let lastSenderId = null;
                        let messageElement = null;

                        data.forEach((msg) => {
                            let sendTime = new Date(msg.created_at)
                                .toLocaleString('pl-PL', {
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    day: '2-digit',
                                    month: '2-digit',
                                })
                                .replace(',', '');
                            if (msg.sender_id !== lastSenderId) {
                                if (messageElement) {
                                    messageBox.appendChild(messageElement);
                                }
                                messageElement = document.createElement('div');
                                messageElement.classList.add('flex', 'flex-col', 'gap-2', 'mt-4');

                                if (msg.sender_id === {{ auth()->user()->id }}) {
                                    messageElement.classList.add('items-end');
                                } else {
                                    messageElement.classList.add('items-start');
                                }
                            }

                            const messageContent = document.createElement('span');
                            const sendTimeContent = document.createElement('span');
                            messageContent.classList.add('rounded-md', 'p-2', 'break-words', 'max-w-full');
                            sendTimeContent.classList.add('text-xs', 'text-gray-300', 'italic');
                            if (msg.sender_id === userId) {
                                messageContent.classList.add('bg-slate-700/60');
                            } else {
                                messageContent.classList.add('bg-slate-700');
                            }
                            messageContent.textContent = `${msg.message}`;
                            sendTimeContent.textContent = `${sendTime}`;

                            messageElement.appendChild(messageContent);
                            messageElement.appendChild(sendTimeContent);
                            lastSenderId = msg.sender_id;
                        });

                        if (messageElement) {
                            messageBox.appendChild(messageElement);
                        }

                        messageBox.scrollTop = messageBox.scrollHeight;
                    })
                    .catch((error) => console.error('Error fetching messages:', error));

                placeholder.style.display = 'none';
                conv.style.display = 'flex';
                link.classList.remove('bg-slate-800/60', 'hover:bg-slate-800');
                link.classList.add('bg-slate-800', 'hover:bg-slate-900/60');

                if (window.innerWidth < 1024) {
                    communicator.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        messageTextarea.addEventListener('input', function () {
            if (this.value.length >= 10) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        });
    });

    function openModal(messages, action) {
        // action = 'archive' or 'restore'

        const offerId = messages[0].offer.id;
        const userId = {{ auth()->user()->id }};

        const modal = document.getElementById(`${action}Modal`);
        const form = document.getElementById(`${action}Form`);
        form.action = `/messages/${action}/${offerId}/${userId}`;

        modal.classList.remove('hidden');
    }

    function closeModal(action) {
        const modal = document.getElementById(`${action}Modal`);
        modal.classList.add('hidden');
    }
</script>
