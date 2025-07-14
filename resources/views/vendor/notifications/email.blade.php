<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Товар появился в наличии</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        table {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            border-collapse: collapse;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background-color: #ffffff;
        }
        .header {
            padding: 30px 20px;
            background-color: #f7b37f;
            color: #ffffff;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 25px 20px;
        }
        .product-info {
            margin: 20px 0;
            padding: 15px;
            background-color: #f8f8f8;
            border-radius: 4px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            color: #ffffff;
            background-color: #f7b37f;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .footer {
            padding: 15px 20px;
            background-color: #f8f8f8;
            text-align: center;
            border-radius: 0 0 8px 8px;
        }
    </style>
</head>
<body>
    <table>
        <!-- Header -->
        <tr>
            <td class="header">
                <h1 style="margin: 0; font-size: 24px;">Товар появился в наличии 🎉</h1>
            </td>
        </tr>

        <!-- Content -->
        <tr>
            <td class="content">
                <p style="font-size: 16px; line-height: 1.6; color: #333;">Здравствуйте!</p>
                <p style="font-size: 16px; line-height: 1.6; color: #333;">Товар, на который вы подписались, теперь доступен:</p>
                
                <!-- Product Info -->
                <div class="product-info">
                    <h2 style="margin: 0 0 10px; font-size: 20px; color: #222;">{{ $product->name }}</h2>
                    <p style="margin: 0; font-size: 14px; color: #555;">Цена: {{ $product->price }} ₽</p>
                </div>

                <!-- Button -->
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center" style="padding: 20px 0;">
                            <a href="{{ route('product', [$product->category->code, $product->code]) }}" class="button">Перейти к товару</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td class="footer">
                <p style="margin: 0; font-size: 13px; color: #777;">© {{ date('Y') }} Ваш интернет-магазин. Все права защищены.</p>
            </td>
        </tr>
    </table>
</body>
</html>