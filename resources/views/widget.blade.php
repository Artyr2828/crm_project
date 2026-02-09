<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Widget</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-transparent p-4">
    <div id="widget-container" class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-lg border border-gray-200">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Оставить заявку</h2>

        <form id="ticket-form" class="space-y-4">
            @csrf
            <div>
                <input type="text" name="name" placeholder="Ваше имя" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                <span class="text-red-500 text-xs error-msg" id="error-name"></span>
            </div>
            <div>
                <input type="email" name="email" placeholder="Электронная почта" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                <span class="text-red-500 text-xs error-msg" id="error-email"></span>
            </div>
            <div>
                <input type="text" name="phone" placeholder="Номер телефона (E.164)" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                <span class="text-red-500 text-xs error-msg" id="error-phone"></span>
            </div>
            <div>
                <input type="text" name="subject" placeholder="Тема сообщения" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                <span class="text-red-500 text-xs error-msg" id="error-subject"></span>
            </div>
            <div>
                <textarea name="message" placeholder="Ваш текст..." rows="3" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
                <span class="text-red-500 text-xs error-msg" id="error-message"></span>
            </div>
            <button type="submit" id="submit-btn"
                class="w-full bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition">
                ОТПРАВИТЬ
            </button>
        </form>

        <div id="success-msg" class="hidden text-center py-8">
            <div class="text-green-500 text-5xl mb-4">✅</div>
            <h3 class="text-lg font-bold">Спасибо!</h3>
            <p class="text-gray-600">Ваша заявка принята в работу.</p>
        </div>
    </div>

    <script>
        document.getElementById('ticket-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = document.getElementById('submit-btn');
            const form = e.target;
            const formData = new FormData(form);

            // Очистка ошибок
            document.querySelectorAll('.error-msg').forEach(el => el.innerText = '');
            btn.disabled = true;
            btn.innerText = 'Отправка...';

            try {
                const response = await fetch('/api/tickets', {
                    method: 'POST',
                    body: formData,
                    headers: { 'Accept': 'application/json' }
                });

                const result = await response.json();

                if (response.ok) {
                    form.classList.add('hidden');
                    document.getElementById('success-msg').classList.remove('hidden');
                } else {
                    // Вывод ошибок валидации от FormRequest
                    for (let key in result.errors) {
                        document.getElementById('error-' + key).innerText = result.errors[key][0];
                    }
                }
            } catch (error) {
                alert('Ошибка соединения с сервером');
            } finally {
                btn.disabled = false;
                btn.innerText = 'ОТПРАВИТЬ';
            }
        });
    </script>
</body>
</html>
