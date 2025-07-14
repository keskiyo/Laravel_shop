<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подтверждение заказа</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 20px; }
        .header { text-align: center; padding: 20px 0; }
        .logo { max-width: 150px; }
        h1 { color: #333; font-size: 24px; margin-bottom: 20px; }
        .order-details { background: #f9f9f9; padding: 15px; border-radius: 5px; }
        .order-details p { margin: 5px 0; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 14px; }
        .footer a { color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('img/logotip1.jpg') }}" alt="Логотип компании" class="logo">
        </div>
        
        <h1>Заказ на {{ $name }} успешно оформлен!</h1>
        
        <div class="order-details">
            <p><strong>Номер заказа:</strong> #{{ $order->id }}</p>
            <p><strong>Дата заказа:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
            <p><strong>Сумма заказа:</strong> {{ number_format($order->calculateFullPrice(), 2, ',', ' ') }} ₽</p>
        </div>

        <p>Мы уже начали обрабатывать ваш заказ. Вы получите уведомление, когда заказ будет готов к отправке.</p>

        <div class="footer">
            <p>Если у вас есть вопросы, свяжитесь с нами:</p>
            <p>Телефон: +7 (982) 542-72-27</p>
            <p>Email: info@example.com</p>
            <p>
                <a href="{{ route('categories') }}">Наш сайт</a> | 
                <a href="#">Политика конфиденциальности</a>
            </p>
        </div>
    </div>
</body>
</html>