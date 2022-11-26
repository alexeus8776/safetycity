ymaps.ready(init);

function init() {
    var myPlacemark,
        myMap = new ymaps.Map('map', {
            center: [62.027221,129.732178],
            zoom: 13,
			controls: []
        }, {
            searchControlProvider: 'yandex#search'
        });

    // Слушаем клик на карте.
    myMap.events.add('click', function (e) {
        var coords = e.get('coords');

		// Создание метки.
		function createPlacemark(coords) {
			return new ymaps.Placemark(coords, {
				iconCaption: '',
				balloonContent:
				`
				<div id="menu">\
				<?
				
				?>
					<h3 align='center'>Комментирование</h3>
					<form method='post' style='font-size:16px;'>
                    <ul id="menu_list">\
                        <li>Адрес: <br /> <input type="text" name="address" /></li>\
                        <li>Организация: <br /> <input type="text" name="organiz" /></li>\
                        <li>Коментарий: <br /> <input type="text" name="koment" /></li>\
						<li>Фото: <br /> <input type="file" name="foto" /></li>\
                    </ul>\
                    <div align="center">
                    <button id="1" name='knopka'type="submit"style='background:lightgreen;padding:4px 20px 4px 20px; fomt-size:20px; border:2px solid green;' />Сохранить</button>
                </div>'
				`
				
			}, {
				preset: 'islands#violetDotIconWithCaption',
				draggable: true
			});
		}
        myPlacemark = createPlacemark(coords);
        myMap.geoObjects.add(myPlacemark);
    });

    

}
