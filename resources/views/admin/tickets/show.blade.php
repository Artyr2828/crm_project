<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Просмотр заявки #{{ $ticket->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Информация о клиенте --}}
                <div class="mb-8 border-b pb-4">
                    <h3 class="text-lg font-bold mb-2">Данные клиента</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <span class="text-gray-500">Имя:</span>
                            <p class="font-medium">{{ $ticket->customer->name }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500">Email:</span>
                            <p class="font-medium">{{ $ticket->customer->email }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500">Телефон:</span>
                            <p class="font-medium">{{ $ticket->customer->phone }}</p>
                        </div>
                    </div>
                </div>

                {{-- Контент тикета --}}
                <div class="mb-8">
                    <h3 class="text-lg font-bold mb-2 text-gray-800">Тема: {{ $ticket->subject }}</h3>
                    <div class="p-4 bg-gray-50 rounded-lg border text-gray-700 leading-relaxed">
                        {{ $ticket->message }}
                    </div>
                </div>

                {{-- Файлы (Spatie Media Library) --}}
                <div class="mb-8" style="margin-bottom: 32px;">
          <h3 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 12px; color: #1f2937;">
              Прикрепленные файлы
          </h3>

          <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 16px;">
              @forelse($ticket->getMedia('attachments') as $media)
                  <div style="display: flex; align-items: center; justify-content: space-between; padding: 16px; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">

                      <div style="display: flex; align-items: center; overflow: hidden;">
                          {{-- Маленькая иконка документа --}}
                          <div style="padding: 8px; background: #eff6ff; border-radius: 8px; margin-right: 12px;">
                              <svg style="width: 24px; height: 24px; color: #2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="C7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                              </svg>
                          </div>

                          <div style="overflow: hidden;">
                              <p style="font-size: 0.875rem; font-weight: 600; color: #111827; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;">
                                  {{ $media->file_name }}
                              </p>
                              <p style="font-size: 0.75rem; color: #6b7280; margin: 0; text-transform: uppercase;">
                                  {{ $media->extension }} • {{ $media->human_readable_size }}
                              </p>
                          </div>
                      </div>

                      {{-- КНОПКА КОТОРУЮ ТОЧНО БУДЕТ ВИДНО --}}
                      <a href="{{ $media->getUrl() }}"
                         target="_blank"
                         style="display: inline-block; background-color: #2563eb; color: #ffffff; padding: 8px 16px; border-radius: 8px; font-size: 0.75rem; font-weight: 700; text-decoration: none; text-transform: uppercase; transition: background 0.2s; border: none; cursor: pointer; min-width: 80px; text-align: center;">
                          ОТКРЫТЬ
                      </a>
                  </div>
              @empty
                  <p style="color: #9ca3af; font-style: italic; background: #f9fafb; padding: 16px; border-radius: 8px; border: 1px dashed #d1d5db;">
                      Файлы не прикреплены
                  </p>
              @endforelse
          </div>
      </div>


      <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
    <a href="{{ route('admin.tickets.index') }}" style="color: #6b7280; text-decoration: none; font-size: 0.875rem;">
        ← Вернуться к списку
    </a>

    {{-- ФОРМА ИЗМЕНЕНИЯ СТАТУСА --}}
    <form action="{{ route('admin.tickets.updateStatus', $ticket) }}" method="POST" style="display: flex; items-center; gap: 10px;">
        @csrf
        @method('PATCH')

        <label style="font-size: 0.875rem; font-weight: 600; color: #374151; margin-top: 8px;">Статус:</label>

        <select name="status" style="padding: 8px; border-radius: 8px; border: 1px solid #d1d5db; background-color: #f9fafb; font-size: 0.875rem; min-width: 140px;">
            <option value="new" {{ $ticket->status == 'new' ? 'selected' : '' }}>Новая</option>
            <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>В работе</option>
            <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Закрыта</option>
        </select>

        <button type="submit" style="background-color: #059669; color: white; padding: 8px 16px; border-radius: 8px; border: none; font-weight: 700; cursor: pointer; font-size: 0.75rem; text-transform: uppercase;">
            ОБНОВИТЬ
        </button>
    </form>
</div>

                <div class="flex justify-between items-center mt-6 pt-4 border-t">
                    

                    {{-- Здесь можно позже добавить кнопку смены статуса --}}
                    <span class="px-4 py-2 rounded-full font-bold text-sm {{ $ticket->status == 'new' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                        Статус: {{ $ticket->status }}
                    </span>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
