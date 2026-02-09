<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Список заявок
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 ml-4">Список заявок (Менеджер)</h1>
        </div>

        {{-- СТАТИСТИКА --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 mx-4">
            <div class="bg-white p-4 rounded-lg shadow border-l-4 border-blue-500">
                <p class="text-xs font-bold text-gray-500 uppercase">Сутки</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['last_24h'] ?? 0 }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow border-l-4 border-green-500">
                <p class="text-xs font-bold text-gray-500 uppercase">Неделя</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['last_week'] ?? 0 }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow border-l-4 border-yellow-500">
                <p class="text-xs font-bold text-gray-500 uppercase">Месяц</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['last_month'] ?? 0 }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow border-l-4 border-purple-500">
                <p class="text-xs font-bold text-gray-500 uppercase">Всего</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total'] ?? 0 }}</p>
            </div>
        </div>

        {{-- БЛОК ФИЛЬТРОВ --}}
        <div class="bg-white p-4 rounded-lg shadow mb-6 mx-4">
            <form action="{{ route('admin.tickets.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="text" name="email" value="{{ request('email') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="example@mail.com">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Телефон</label>
                    <input type="text" name="phone" value="{{ request('phone') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="+7...">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Статус</label>
                    <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Все</option>
                        <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Новая</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>В работе</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Закрыта</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Дата</label>
                    <input type="date" name="date" value="{{ request('date') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div class="flex items-end gap-3 mt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-bold transition">
                        НАЙТИ
                    </button>
                    <a href="{{ route('admin.tickets.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition text-center text-sm flex items-center">
                        Сброс
                    </a>
                </div>
            </form>
        </div>

        {{-- ТАБЛИЦА --}}
        <div class="bg-white shadow overflow-hidden rounded-lg mx-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Дата</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Клиент</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Тема</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Статус</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Действия</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($tickets as $ticket)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $ticket->created_at->format('d.m.Y H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $ticket->customer->name ?? 'Н/Д' }}</div>
                            <div class="text-sm text-gray-500">{{ $ticket->customer->email ?? '' }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ Str::limit($ticket->subject, 40) }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $colors = [
                                    'new' => 'bg-green-100 text-green-800',
                                    'in_progress' => 'bg-blue-100 text-blue-800',
                                    'closed' => 'bg-gray-100 text-gray-800',
                                ];
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colors[$ticket->status] ?? 'bg-gray-100' }}">
                                {{ $ticket->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <a href="{{ route('admin.tickets.show', $ticket) }}" class="text-blue-600 hover:text-blue-900 font-bold">Открыть</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Заявок не найдено</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ПАГИНАЦИЯ --}}
        <div class="mt-6 px-4">
            {{ $tickets->appends(request()->input())->links() }}
        </div>
    </div>
</x-app-layout>
