ymaps.ready(init);

function init() {
    var myPlacemark,
        myMap = new ymaps.Map('map', {
            center: [62.027221,129.732178],
            zoom: 14,
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
                    <input id="1" name='knopka'type="submit"style='background:lightgreen;padding:4px 20px 4px 20px; fomt-size:20px; border:2px solid green;' value='Сохранить'>
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
    var myPlacemark = new ymaps.Placemark([62.036357912995655,129.74593016711418], {
        balloonContentHeader: "Короленко 6",
        balloonContentBody: "Магазин 'Виктория'",
        balloonContentFooter: "Не работает терминал"
}, {
preset: 'islands#violetDotIconWithCaption'
});
var myPlacemark1 = new ymaps.Placemark([62.02342159823361,129.73241775366503], {
        balloonContentHeader: "Титовская 6",
        balloonContentBody: "Магазин 'У коли'",
        balloonContentFooter: "Картой не принимают"
}, {
preset: 'islands#violetDotIconWithCaption'
});
var myPlacemark2 = new ymaps.Placemark([62.028246416317316,129.7480772526963], {
        balloonContentHeader: "Мамаева 3",
        balloonContentBody: "Магазин 'Топ'",
        balloonContentFooter: "Не терминал работает "
}, {
preset: 'islands#violetDotIconWithCaption'
});
var myPlacemark3 = new ymaps.Placemark([62.031068033547776,129.75230890557089], {
        balloonContentHeader: "Петровского 63",
        balloonContentBody: "Магазин 'Лада'",
        balloonContentFooter: "Нет терминала"
}, {
preset: 'islands#violetDotIconWithCaption'
});
var myPlacemark4 = new ymaps.Placemark([62.03311550823438,129.73986481456117], {
        balloonContentHeader: "Автодорожная 29",
        balloonContentBody: "Магазин 'История'",
        balloonContentFooter: "Нету"
}, {
preset: 'islands#violetDotIconWithCaption'
});
var myPlacemark5 = new ymaps.Placemark([62.030203574435134,129.72189566766318], {
        balloonContentHeader: "Дзержинского 56",
        balloonContentBody: "Магазин 'Фора'",
        balloonContentFooter: "Не работает"
}, {
preset: 'islands#violetDotIconWithCaption'
});
myMap.geoObjects.add(myPlacemark);
myMap.geoObjects.add(myPlacemark1);
myMap.geoObjects.add(myPlacemark2);
myMap.geoObjects.add(myPlacemark3);
myMap.geoObjects.add(myPlacemark4);
myMap.geoObjects.add(myPlacemark5);
    

}
