<x-chats-layout>
    <div class="flex h-full">
        <!-- Contacts Sidebar -->
        <div class="w-80 bg-white border-r border-gray-200 flex flex-col">
            <!-- Search Bar -->
            <div class="p-4 border-b border-gray-200">
                <div class="relative">
                    <input 
                        type="text" 
                        id="contact-search"
                        placeholder="Search contacts..." 
                        class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                    >
                    <i class='bx bx-search absolute left-3 top-2.5 text-orange-400 text-xl'></i>
                </div>
            </div>

            <!-- Contacts List -->
            <div class="flex-1 overflow-y-auto">
                @foreach($users as $user)
                    @php
                        $unread = $unreadCounts[$user->id] ?? 0;
                    @endphp
                    <div class="relative contact-item" data-name="{{ strtolower($user->name) }}">
                        <div onclick="window.location='{{ route('chats.index', ['receiver_id' => $user->id]) }}'" class="cursor-pointer p-4 flex justify-between items-center {{ $receiver_id == $user->id ? 'bg-orange-100' : 'hover:bg-orange-50' }}">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-orange-500 text-white rounded-full flex justify-center items-center font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $user->role }}</p>
                                </div>
                            </div>
                            @if($unread > 0)
                                <span class="bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                    {{ $unread }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Current User Profile -->
            <div class="p-4 border-t border-gray-200 bg-orange-50">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-orange-600 to-orange-700 flex items-center justify-center text-white font-semibold text-lg shadow-md">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</h3>
                        <p class="text-xs text-orange-600">Online</p>
                    </div>
                    <button class="text-orange-400 hover:text-orange-600">
                        <i class='bx bx-cog text-xl'></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="flex-1 flex flex-col bg-white {{ !$receiver_id ? 'hidden md:flex' : '' }}">
            @if($receiver_id)
                @php
                    $receiver = $users->firstWhere('id', $receiver_id);
                @endphp

                <!-- Chat Header -->
                <div class="p-4 border-b border-gray-200 flex items-center justify-between bg-orange-50">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 flex items-center justify-center text-white font-semibold text-lg shadow-md">
                                {{ substr($receiver->name, 0, 1) }}
                            </div>
                            <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $receiver->name }}</h3>
                            <p class="text-sm text-orange-600">{{ $receiver->role }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="text-orange-400 hover:text-orange-600">
                            <i class='bx bx-search text-xl'></i>
                        </button>
                        <button class="text-orange-400 hover:text-orange-600">
                            <i class='bx bx-phone text-xl'></i>
                        </button>
                        <button class="text-orange-400 hover:text-orange-600">
                            <i class='bx bx-video text-xl'></i>
                        </button>
                        <button class="text-orange-400 hover:text-orange-600">
                            <i class='bx bx-dots-vertical-rounded text-xl'></i>
                        </button>
                    </div>
                </div>

                <!-- Messages Area -->
                <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-4" style="background-image: url('your-background.png')">
                    @foreach($chats as $chat)
                        <div class="flex {{ $chat->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[70%] {{ $chat->sender_id === Auth::id() ? 'bg-orange-500 text-white' : 'bg-orange-50 text-gray-900' }} rounded-2xl px-4 py-2 shadow-sm">
                                <p class="text-sm">{{ $chat->message }}</p>
                                <div class="flex items-center justify-end mt-1 space-x-1">
                                    <span class="text-xs {{ $chat->sender_id === Auth::id() ? 'text-orange-100' : 'text-orange-500' }}">
                                        {{ $chat->created_at->format('h:i A') }}
                                    </span>
                                    @if($chat->sender_id === Auth::id())
                                        <i class='bx bx-check-double text-sm {{ $chat->read_at ? 'text-orange-100' : 'text-orange-200' }}'></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Message Input -->
                <div class="p-4 border-t border-gray-200 bg-orange-50">
                    <form id="chat-form" method="POST" action="{{ route('chats.store') }}">
                        @csrf
                        <div class="flex items-center space-x-2">
                            <input type="text" name="message" class="w-full p-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Type a message...">
                            <button type="submit" class="bg-orange-500 text-white p-2 rounded-lg hover:bg-orange-600">
                                <i class="bx bx-send"></i>
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="text-center flex justify-center items-center h-full">
                    <p class="text-lg text-gray-500">Select a user to start chatting</p>
                </div>
            @endif
        </div>
    </div>
</x-chats-layout>

<script src="{{ mix('js/app.js') }}"></script>
<script>
    // JavaScript for search box
    document.getElementById('contact-search').addEventListener('input', function() {
        let searchValue = this.value.toLowerCase();
        let contactItems = document.querySelectorAll('.contact-item');

        contactItems.forEach(function(item) {
            let name = item.getAttribute('data-name');
            if (name.indexOf(searchValue) !== -1) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });

        // Listen for chat messages in real-time
        window.Echo.private('chat.{{ Auth::id() }}')
        .listen('ChatMessageSent', (event) => {
            // Get the chat message data
            const chatMessage = event.message;
            const senderId = event.sender_id;
            const receiverId = event.receiver_id;

            // Append the new message to the chat
            const messageContainer = document.getElementById('chat-messages');

            // Create the new message element
            const messageElement = document.createElement('div');
            messageElement.classList.add('flex', senderId === {{ Auth::id() }} ? 'justify-end' : 'justify-start');
            messageElement.innerHTML = `
                <div class="max-w-[70%] ${senderId === {{ Auth::id() }} ? 'bg-orange-500 text-white' : 'bg-orange-50 text-gray-900'} rounded-2xl px-4 py-2 shadow-sm">
                    <p class="text-sm">${chatMessage}</p>
                    <div class="flex items-center justify-end mt-1 space-x-1">
                        <span class="text-xs ${senderId === {{ Auth::id() }} ? 'text-orange-100' : 'text-orange-500'}">
                            ${event.created_at}
                        </span>
                        ${senderId === {{ Auth::id() }} ? '<i class="bx bx-check-double text-sm text-orange-100"></i>' : ''}
                    </div>
                </div>
            `;

            // Append the new message to the chat area
            messageContainer.appendChild(messageElement);

            // Scroll to the bottom of the chat
            messageContainer.scrollTop = messageContainer.scrollHeight;
        });
</script>
