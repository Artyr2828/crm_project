<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Widget</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <div class="flex items-center mb-6">
            <div class="bg-blue-600 p-2 rounded-lg mr-3">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="浸 8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Служба поддержки</h2>
        </div>

        <form id="ticketForm" class="space-y-4" enctype="multipart/form-data">
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Ваше имя</label>
                    <input type="text" name="name" required placeholder="Иван Иванов"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2.5 border focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email (только Gmail)</label>
                        <input type="email" name="email" required placeholder="example@gmail.com"
                            pattern=".+@gmail\.com" title="Используйте только @gmail.com"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2.5 border focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Телефон</label>
                        <input type="text" name="phone" required placeholder="+77001234567"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2.5 border focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Тема</label>
                    <input type="text" name="subject" required placeholder="Краткое название проблемы"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2.5 border focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Сообщение</label>
                    <textarea name="message" rows="3" required placeholder="Опишите детали..."
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2.5 border focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 text-blue-600">Прикрепить файл</label>
                    <input type="file" name="file"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
            </div>

            <button type="submit" id="submitBtn" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-md hover:bg-blue-700 transition duration-200">
                Отправить запрос
            </button>
        </form>

        <div id="responseMessage" class="mt-4 hidden p-4 rounded-md text-sm font-medium"></div>
    </div>

    <script>
        document.getElementById('ticketForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const form = e.target;
            const btn = document.getElementById('submitBtn');
            const msgDiv = document.getElementById('responseMessage');

            // Используем FormData для поддержки файлов
            const formData = new FormData(form);

            // Блокируем кнопку на время загрузки
            btn.disabled = true;
            btn.textContent = "Отправка...";
            msgDiv.classList.add('hidden');

            try {
                const response = await fetch('/api/tickets', {
                    method: 'POST',
                    headers: {
                        // Важно: для FormData НЕ УКАЗЫВАЕМ Content-Type вручную
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    msgDiv.innerHTML = `<strong>Успех!</strong><br>Ваш тикет #${result.data.id} создан.`;
                    msgDiv.className = "mt-4 p-4 rounded-md text-green-700 bg-green-100 block";
                    form.reset();
                } else {
                    // Обработка ошибок валидации (например, если не gmail.com)
                    const errorText = result.message || "Проверьте введенные данные";
                    msgDiv.innerHTML = `<strong>Ошибка!</strong><br>${errorText}`;
                    msgDiv.className = "mt-4 p-4 rounded-md text-red-700 bg-red-100 block";
                }
            } catch (error) {
                msgDiv.innerHTML = "<strong>Ошибка!</strong><br>Не удалось связаться с сервером.";
                msgDiv.className = "mt-4 p-4 rounded-md text-red-700 bg-red-100 block";
            } finally {
                btn.disabled = false;
                btn.textContent = "Отправить запрос";
            }
        });
    </script>
</body>
</html>
