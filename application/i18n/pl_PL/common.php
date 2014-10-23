<?php

$lang = array
(
    'title' =>  Kohana::config('config.site_name'),
    'title_main' => 'Bilety lotnicze, bilety kolejowe on-line',
    'title_avia' => 'Bilety lotnicze on-line: ceny na bilety lotnicze, koszt biletów lotniczych, tanie bilety lotnicze, zarezerwowania biletów lotniczych',
    'title_gd' => 'Bilety  kolejowe on-line',
    'title_my' => 'Mój bilet',
    'title_hotel' => 'Hotele',
    
    'description_main' => 'Tanie bilety lotnicze on-line: sprzedaż, zarezerwowanie i zamówienie biletów lotniczych. Ceny na bilety lotnicze on-line. Specjalne propozycje, akcje kompanii lotniczych, sezonowe rabaty na bilety lotnicze. Koszt biletów lotniczych na samoloty. Sprzedaż biletów lotniczych za cenami kompanii lotniczych bez marży. Elektronowe bilety na samolot',
    'description_avia' => 'On-line zarezerwowania biletów lotniczych na całe kierunki za cenami kompanii lotniczych. Ceny na bilety lotnicze bez komisji. Tanie bilety lotnicze na całe przeloty. Opłata on-line kartkami Visa / Mastercard',
    'description_gd' => 'Bilety kolejowe on-line: sprzedaż, zarezerwowanie i zamówienie biletów kolejowych. Ceny na bilety kolejowe on-line.',    
    'description_my' => '',
    'description_hotels' => 'Hotel Rezerwacja: Rezerwacja hoteli w Kijowie, hotele na Ukrainie i na świecie przewoźnik ceny. Rezerwacje bez prowizji. Tanie ceny rezerwacje hoteli. Karty płatnicze online Visa / Mastercard',
    
    'keywords_main' => 'bilety lotnicze, lotnicze bilety, bilety na samolot, bilety kolejowe, kolejowe bilety',
    'keywords_avia' => 'bilety lotnicze, lotnicze bilety, bilety na samolot, bilety kolejowe, kolejowe bilety',
    'keywords_gd' => '',
    'keywords_my' => '',    
    
    'seo_title_avia' => 'Bilety lotnicze % cityname%, %country %/bilety lotnicze, bilety kolejowe on-line/',
    'seocity_description_avia' => 'Bilety %lotnicze cityname% (%country%) : ceny na bilety lotnicze % cityname%, zarezerwowania biletów lotniczych % cityname%, sprzedaż biletów lotniczych % cityname% za cenami kompanii lotniczych',
    
    'copyright' => "© 2008 &ndash; ".date('Y')." %s&trade;<br/>Designe ".'<a rel="nofollow" href="http://thetrand.com">TRAND</a>.',
    'feedback' => 'Sprzężenie zwrotne',
    'feedback_close' => 'Zamknąć',
    'feedback_descr' => 'Dla nas jest ważna Twoja opinia',
    'feedback_msg' => 'Twoje zawiadomienie',
    'feedback_email' => 'Twój E - mail',
    'feedback_success' => 'Twoje zawiadomienie nadesłano, nasz operator skontaktuje się z Tobą jak najszybciej',
    'send' => 'Nadesłać',
    'header_tabs' => array(
        'avia' => 'Bilety lotnicze',
        'gd' => 'Kolejowe bilety',
        'my' => 'Мój bilet',
        'bus' => 'Bus',
        'hotel' => 'Hotele',
		'loguottitle' => 'Wzloguj',
        'do_logout' => 'Czy na pewno chcesz wyjść?',
        'insurance' => 'Страховки'
    ),
    'header_tabs_logo' => array(
        'avia' => 'Bilety lotnicze',
        'gd' => 'Kolejowe bilety',
        'my' => 'Мój bilet',
        'bus' => 'Bus',
        'hotels' => 'Hotele',
        'tours' => 'Trasy',
        'insurance' => 'Страховки'
    ),
    'loader_text_avia' => 'Poszukiwanie wariantów przelotu',
    'loader_text_gd' => 'Poszukiwanie wariantów przejazdu',
    'loader_text_my' => '',
    'loader_text_hotel' => '',
    'loader_text_tours' => 'Wycieczki Szukaj',
    'loader_close' => 'Zamknąć',
	'phone_descr' => '* Bezpłatny dla Ukrainy za pomocą telefonów stacjonarnych<br />** Rozmowy z operatorem telefonii komórkowej w wysokości',
    'chat' => 'On-line czat',
    'chat_descr' => 'Operator w sieci',
    'support_descr' => 'Całodobowe wsparcie',
	'logout' => 'Wyloguj',
    'footer_menu' => array(
        0 => array(
            'title' => 'Mój bilet',
            'elems' => array(
                'Bilety lotnicze on-line',
                'Kolejowe bilety on-line',
                'Kolejowe bilety on-line'.
                'Rezerwowanie hotelów'
            )
        ),
        1 => array(
            'title' => 'Zaświadczenie',
            'elems' => array(
                'FAQ po biletach lotniczych',
                'FAQ po kolejowych biletach',
                'Rozkład samolotów',
                'Informator portów lotniczych',
                'Bus tickets FAQ',
                'Railway Timetable',
                'FAQ na temat rezerwacji hotelowej'
            )
        ),
        2 => array(
            'title' =>  Kohana::config('config.site_name'),
            'elems' => array(
                'Profil serwu',
                'Partnerom',
                'Służba podtrzymania',
                'Blog'
            )
        )
    ) 
    ,
	'aviatitle' => 'Poszukiwanie i zarezerwowanie biletów lotniczych',
	'gdtitle' => 'Poszukiwanie i zarezerwowanie kolejowych biletów',
	'blogtitle' => 'Blog ' . Kohana::config('config.site_name'),   
	'chattitle' => 'On-line czat z operatorem służby wsparcia',   
	'hotelstitle' => 'Rezerwowanie hotelów',
    
    'months' => array(
        '01' => 'Stycznia',
        '02' => 'Lutego',
        '03' => 'Marca',
        '04' => 'Kwietnia',
        '05' => 'Maja',
        '06' => 'Czerwca',
        '07' => 'Lipca',
        '08' => 'Sierpnia',
        '09' => 'Września',
        '10' => 'Października',
        '11' => 'Listopada',
        '12' => 'Grudnia'
    ),
    
    'days' => array(
        0 => 'Niedziela',
        1 => 'Poniedziałek',
        2 => 'Wtorek',
        3 => 'Środa',
        4 => 'Czwartek',
        5 => 'Piątek',
        6 => 'Sobota',
        7 => 'Niedziela'
    ),
    
    'air_steps' => array(
        0 => 'Wybór Przelotu',
        1 => 'Zarezerwowanie',
        2 => 'Opłata Usługi',
        3 => 'DRUK'
    ),
    
    'currency' => array('USD' => 'dolarów',
                        'UAH' => 'hrywien',
                        'RUR' => 'rubli',
                        'EUR' => 'euro'),
                        
    'currency_short' => array('USD' => 'USD',
                              'UAH' => 'HRN',
                              'RUR' => 'RUB',
                              'EUR' => 'EUR'),
    'error_404' => 'Błąd 404. Nie znaleziono stronę prośby',
    'error_session_expired' => 'Albo nie jesteś autoryzowany, albo czas sesji wyczerpano',
    
    'login_tip' => 'Wprowadźcie E - mail, wskazany przy pierwszym zarezerwowaniu biletów na ' . Kohana::config('config.site_name').', hasło.',
    
    'login_form' => array(
        'main_header' => 'Mój bilet',
        'authorization' => 'Autoryzacja',
        'remind_header' => 'Odzyskanie hasła',
        'error' => 'Błąd!',
        'main_message' => "Podaj e-mail wskazany przy pierwszej rezerwacji na %s, hasło.",
        'remind_message' => 'Podaj nazwę użytkownika i wyślemy hasło na e-mail.',
        'restore_message' => 'Link do odzyskania hasła wysłana do Ciebie na e-mai.',
        'main_error' => 'Nazwa użytkownika i / lub hasło jest nieprawidłowe.',
        'remind_error' => 'E-mail jest nieprawidłowy.',
        'forgot_password' => 'Nie pamiętasz hasła?',
        'login_button' => 'Zaloguj',
        'send_button' => 'Wyślij',
        'password' => 'Hasło',
        'login_label' => 'Login'
    ),
    'go_home' => 'Strona główna',
    'pub_company' => 'Firma',
    'pub_terms' => 'Regulamin',
    'pub_contacts' => 'Kontakt',
    'pub_payment' => 'Płatność',
    'pub_for_user' => 'Kupującemu',
    'copyright_e2m' => '&copy; 2012 Ltd. "Express-2"',
    'tickets_kiev' => 'Airline tickets Kiev',
    'tickets_donetsk' => 'Airline tickets Donetsk',
    'tickets_simferopol' => 'Airline tickets Simferopol',
    'tickets_kharkov' => 'Airline tickets Kharkov',
    'tickets_dnepr' => 'Airline tickets Dnepropetrovsk',
    'tickets_telaviv' => 'Airline tickets Tel Aviv',
	'ourprojects' => 'Nasze projekty',
	'supportchat' => 'Czat Wsparcie',
	'footer_address' => '79017, Ukraine, Lviv,  Zelena, 44',
	'footer_email' => 'Email:',
	'footer_address2' => '194017, Russian Federation, St. Petersburg, ul. Drezdenskaya, 8/2',
	'footer_skype' => 'zadzwonić do operatora',
	'footer_skype_descr' => 'ticketshelp',
	'skype_title' => 'Kliknij, aby zadzwonić pod bezpłatny operatorzy ' . Kohana::config('config.site_name')
)

?>
