document.addEventListener('DOMContentLoaded', function () {
    // Переключение вкладок
    const tabs = document.querySelectorAll('.tab-btn');
    const deliveryFields = document.getElementById('deliveryFields');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            if (tab.dataset.tab === 'delivery') {
                deliveryFields.style.display = 'block';

                // Инициализируем подсказки при активации вкладки доставки
                if (addressInput && !suggestView) {
                    ymaps.ready(function () {
                        initSuggest();
                    });
                }
            } else {
                deliveryFields.style.display = 'none';
            }
        });
    });

    // Обработка выбора способа оплаты
    const paymentMethod = document.getElementById('payment_method');
    const cardFields = document.getElementById('cardFields');

    paymentMethod.addEventListener('change', () => {
        if (paymentMethod.value === 'card') {
            cardFields.style.display = 'block';
        } else {
            cardFields.style.display = 'none';
        }
    });

    // Инициализация Яндекс Карты
    const addressInput = document.getElementById('address');
    const mapButton = document.getElementById('mapButton');
    const mapContainer = document.getElementById('map');

    let map;
    let currentPlacemark;
    let suggestView;

    // Функция для получения геолокации
    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    updateMap([latitude, longitude]);

                    ymaps.geocode([latitude, longitude]).then(function (res) {
                        const firstGeoObject = res.geoObjects.get(0);
                        if (firstGeoObject) {
                            addressInput.value = firstGeoObject.getAddressLine();
                        }
                    });
                },
                (error) => {
                    console.error('Ошибка получения геолокации:', error);
                    alert('Не удалось определить ваше местоположение. Пожалуйста, выберите адрес на карте вручную.');
                }
            );
        } else {
            alert('Ваш браузер не поддерживает геолокацию');
        }
    }

    // Инициализация подсказок для поля адреса
    function initSuggest() {
        if (!addressInput) {
            return;
        }

        suggestView = new ymaps.SuggestView(addressInput, {
            offset: [0, 5],
            provider: {
                suggest: function (request, options) {
                    return ymaps.suggest(`Барнаул, ${request}`);
                }
            },
            results: 5 // Количество подсказок
        });

        // Обработка выбора подсказки
        suggestView.events.add('select', function (e) {
            const value = e.get('item').value;
            addressInput.value = value;

            // Геокодирование выбранного адреса
            ymaps.geocode(value).then(function (res) {
                const firstGeoObject = res.geoObjects.get(0);
                if (firstGeoObject) {
                    const coords = firstGeoObject.geometry.getCoordinates();
                    updateMap(coords);
                }
            });
        });
    }

    // Инициализация карты
    function initMap() {
        map = new ymaps.Map('map', {
            center: [53.354779, 83.769737], // Барнаул
            zoom: 12,
            controls: ['zoomControl', 'fullscreenControl']
        });

        const searchControl = new ymaps.control.SearchControl({
            options: {
                float: 'right',
                floatIndex: 200,
                noPlacemark: true
            }
        });
        map.controls.add(searchControl);

        const geolocationControl = new ymaps.control.Button({
            data: {
                content: 'Моё местоположение',
                image: 'https://yastatic.net/s3/home-static/_/37/37a98d42b1c51abac55d8a5911d7b9f8.svg'
            },
            options: {
                selectOnClick: false,
                position: {
                    top: 10,
                    right: 10
                }
            }
        });

        geolocationControl.events.add('click', function () {
            getCurrentLocation();
        });

        map.controls.add(geolocationControl);

        // Обработка клика по карте
        map.events.add('click', function (e) {
            const coords = e.get('coords');
            updateMap(coords);
        });
    }

    // Обновление маркера на карте
    function updateMap(coords) {
        if (currentPlacemark) {
            map.geoObjects.remove(currentPlacemark);
        }

        currentPlacemark = new ymaps.Placemark(coords, {}, {
            preset: 'islands#redDotIcon',
            draggable: true
        });

        // Добавляем обработчик перетаскивания маркера
        currentPlacemark.events.add('dragend', function (e) {
            const newCoords = currentPlacemark.geometry.getCoordinates();
            ymaps.geocode(newCoords).then(function (res) {
                const firstGeoObject = res.geoObjects.get(0);
                if (firstGeoObject) {
                    addressInput.value = firstGeoObject.getAddressLine();
                }
            });
        });

        map.geoObjects.add(currentPlacemark);
        map.setCenter(coords);

        // Получаем адрес по координатам и обновляем поле ввода
        ymaps.geocode(coords).then(function (res) {
            const firstGeoObject = res.geoObjects.get(0);
            if (firstGeoObject) {
                const address = firstGeoObject.getAddressLine();
                addressInput.value = address;
            }
        });
    }

    mapButton.addEventListener('click', function () {
        if (mapContainer.style.display === 'none') {
            mapContainer.style.display = 'block';
            if (!map) {
                ymaps.ready(function () {
                    initMap();
                    initSuggest();
                    getCurrentLocation();
                });
            }
        } else {
            mapContainer.style.display = 'none';
        }
    });

    ymaps.ready(function () {
        initSuggest();
    });

    const form = document.getElementById('orderForm');
    form.addEventListener('submit', (e) => {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (deliveryFields.style.display === 'block' && !addressInput.value) {
            isValid = false;
            alert('Пожалуйста, укажите адрес доставки');
        }

        if (paymentMethod.value === 'card') {
            const cardNumber = document.getElementById('cardNumber');
            const cardExpiry = document.getElementById('cardExpiry');
            const cardCvv = document.getElementById('cardCvv');

            if (!cardNumber.value || !cardExpiry.value || !cardCvv.value) {
                isValid = false;
                alert('Пожалуйста, заполните все поля данных карты');
            }
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
}); 