<?php

$lang = array
(
    'title' =>  Kohana::config('config.site_name'),
    'title_main' => 'Flight Tickets Online',
    'title_avia' => 'Tickets online',
    'title_gd' => 'Railway tickets online',
    'title_bus' => 'Bus tickets online',
    'title_hotels' => 'Hotels online',
    'title_tours' => 'Tours',
    'title_travel' => 'Travel and tourism',
    'title_rent' => 'Apartments',
    'title_rating' => 'Rating airlines',
    'title_my' => 'My account',
    'title_insurance' => 'Insurance online',

    'description_main' => 'Best prices ★★★★★ Booking airline tickets, convenient payment Visa/Mastercard, instant extract e-ticket. Cheap flights on all airlines. Special offers, promotions airlines season discounts on airline tickets. Airfare, airline ticketing, electronic airline tickets.',
    'description_avia' => 'Best prices ★★★★★ lights Online: booking airline tickets online all the directions on the prices of airlines. Fares without commissions. Cheap flights to all flights. Online Payment Cards Visa/Mastercard',
    'description_gd' => 'Best prices ★★★★★ Train tickets online: sales, reservations and booking train tickets. Prices of railway tickets online.',
    'description_bus' => 'Best prices ★★★★★ Bus tickets: online sale of bus tickets to Ukraine and Europe, all bus carriers. Bus schedule online. All buses in one place.',
    'description_hotels' => 'Best prices ★★★★★ Online hotel booking. The largest selection of hotels and hotel reservation online, the payment card Visa / Mastercard, Cash in the bank.',
    'description_tours' => 'Best prices ★★★★★ Search tours on the actual proposals of tour operators. Best prices for tours in Egypt, tours in Turkey, tours in Greece, tours to Thailand tours to the UAE, tours to the Dominican Republic, tours to the Maldives.',
    'description_travel' => 'Best prices ★★★★★ Service reference information about recreation and travel. Travel guides and guidebooks on the countries and cities, tourism news, world resorts and cuisine of the world, travel videos, travel routes. All necessary travel information!',
    'description_rent' => 'Rent.tickets.ua – easy search of apartment rent. Here you can easily find and book a suitable accommodation in any city of Ukraine, directly contacting its owner. No commissions, agents and problems!',
    'description_rating' => 'Rating airlines',
    'description_my' => '',
    'description_insurance' => 'Online service of insurance for traveling abroad. Buy insurance policy online using a convenient metodamiV payment!',
    
    'keywords_main' => 'flights, airline tickets, plane tickets, train tickets, train tickets',
    'keywords_avia' => 'flights, airline tickets, plane tickets, train tickets, train tickets',
    'keywords_gd' => '',
    'keywords_bus' => '',
    'keywords_hotels' => '',
    'keywords_tours' => '',
    'keywords_rent' => '',
    'keywords_rating' => 'rating airlines',
    'keywords_my' => '',

    
    'seo_rent' => array(
        'title_result' => 'Apartments %%city%% / ',
        'description_result' => 'Apartments %%city%%',
        'keyword_result' => '',
    
        'title_apartment' => 'Apartments %%city%%, %%street%% / ',
        'description_apartment' => 'Apartments %%city%%, %%street%%',        
    ),
        
    
    'seo_title_avia' => 'Airline tickets %cityname%, %country%/Airline tickets online/',
    'seocity_description_avia' => 'Flights from %cityname% (%country%): prices on flights %cityname%, %cityname% flight reservations, ticket sales at prices %cityname% flights',

    'seo_title_gd' => 'Railway tickets %s online, train tickets %s, railway station %s/'.Kohana::config('config.site_name'),
    'seo_description_gd' => 'Railway tickets %s online, railway tickets prices %s, buy railway tickets %s, railway tickets availability %s, order railway tickets %s, railway station %s.',

    'seo_title_hotel' => 'Hotel %hotel_name%/Hotels %city_name%/Hotels online/',

    'copyright' => "© 2008 &ndash; ".date('Y')." %s&trade;<br/>Design by ".'<a rel="nofollow" href="http://thetrand.com">TRAND</a>.',
    'contact_inf' => 'Сontact information',
	'feedback' => 'Feedback',
    'feedback_close' => 'Close',
    'feedback_descr' => 'We value your opinion',
    'feedback_msg' => 'Your message',
    'feedback_email' => 'Your E-mail',
    'feedback_success' => 'Your message has been sent, our operator will contact you as soon as possible',
    'send' => 'Send',
    'header_tabs' => array(
        'avia' => 'Airline',
        'gd' => 'Railway',
        'bus' => 'Buses',
        'my' => 'My  account',
        'hotels' => 'Hotels',
        'tours' => 'Tours',
        'rent' => 'Apartments',
		'rouming' => 'Roaming',
        'loguottitle' => 'Logout',
        'do_logout' => 'Do you really want to logout?',
        'insurance' => 'Insurance',
		'free' => '<p>Free from fixed phones</p>',
		'multichannel' => '<p> Multi cell </p> 
							<p> Contact us<br/>',
		'feedback' => 'feedback',
		'ask' => 'Ask a question',
		'chat' => 'online chat',
		'support' => 'CUSTOMER SERVICE'
    ),
    'header_tabs_logo' => array(
        'avia' => 'Airline tickets',
        'gd' => 'Railway tickets',
        'bus' => 'Bus tickets',
        'my' => 'My  account',
        'hotels' => 'Hotels',
        'tours' => 'Tours',
        'rent' => 'Apartments',
        'agents' => 'Agents',
        'travel' => 'Travels',
        'insurance' => 'Insurance'
    ),
    'loader_text_avia' => 'Flights search is in progress',
    'loader_text_gd' => 'Trains search is in progress',
    'loader_text_bus' => 'Buses search is in progress',
    'loader_text_my' => '',
    'loader_text_hotels' => '',
    'loader_text_travel' => '',
    'loader_text_rent' => 'Search apartments',
    'loader_text_tours' => 'Search tours',
    'loader_text_insurance' => 'Calculating the cost of insurance',
    'loader_close' => 'Close',
    'phone_descr' => '* free for Ukraine using fixed telephones<br />** calls from your mobile operator at the rate of',
    'chat' => 'Live chat',
    'chat_descr' => 'Operator online',
    'support_descr' => '24 hours support',
    'logout' => 'Loguot',
    'footer_menu' => array(
        0 => array(
            'title' => 'My account',
            'elems' => array(
                'Airline tickets online',
                'Railway tickets online',
                'Bus tickets',
                'Hotels Reservation',
                'Airline tickets',
                'Tours',
                'Travel and tourism',
				'Roaming online',
				'Insurance online'
            )
        ),
        1 => array(
            'title' => 'Information',
            'elems' => array(
                'Airline tickets FAQ',
                'Railway tickets FAQ',
                'Flights Timetable',
                'Airports information',
                'Bus tickets FAQ',
                'Railway Timetable',
                'Hotels booking FAQ',
                'Airlines rating'
            )
        ),
        2 => array(
            'title' =>  Kohana::config('config.site_name'),
            'elems' => array(
                'Profile Service',
                'Affiliates',
                'Support',
                'Blog'
            )
        ),
        3 => array(
            'title' => 'Information',
            'elems' => array(
                'Tours FAQ'
            )
        ),
        4 => array(
            'title' => 'Information',
            'elems' => array('Insurance FAQ', 'Insurance online')
        )          
        
    ),
    'aviatitle' => 'Flights search and booking',
    'gdtitle' => 'Trains search and booking',
    'blogtitle' =>  Kohana::config('config.site_name') . ' blog',
    'chattitle' => 'Online support',
    'hotelstitle' => 'Hotels Reservation',
    'tourstitle' => 'Tours', 
    'traveltitle' => 'Travel and tourism',
    'insurancetitle' => 'Insurance travel abroad',

    'months' => array(
        '01' => 'January',
        '02' => 'February',
        '03' => 'March',
        '04' => 'April',
        '05' => 'May',
        '06' => 'June',
        '07' => 'July',
        '08' => 'August',
        '09' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December'
    ),

    'days' => array(
        0 => 'Sunday',
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday',
        7 => 'Sunday',
    ),

    'air_steps' => array(
        0 => 'SELECT',
        1 => 'BOOK',
        2 => 'PAY',
        3 => 'PRINT'
    ),

    'currency' => array('EUR' => 'Euro',
                        'USD' => 'US Dollars',
                        'UAH' => 'Hryvnia',
                        'RUR' => 'Ruble'),

    'currency_short' => array('USD' => 'USD',
                              'UAH' => 'UAH',
                              'RUR' => 'RUR',
                              'EUR' => 'EUR'),
    'error_404' => 'Error 404. Requested page not found',
    'error_session_expired' => 'You are not logged in or session expired',

    'login_tip' => 'Enter your e-mail, specified at the first booking on ' . Kohana::config('config.site_name').' and password',

    'login_form' => array(
        'main_header' => 'My account',
        'authorization' => 'Authorization',
        'remind_header' => 'Restore password',
        'error' => 'Error!',
        'main_message' => "Enter your e-mail and password specified at the first booking on %s",
        'remind_message' => 'Enter your e-mail to receive restoration link',
        'restore_message' => 'Link to reset your password will be sent to your email in few minutes',
        'main_error' => 'Incorrect login or password',
        'remind_error' => 'E-mail is not valid',
        'forgot_password' => 'Forgot password?',
        'login_button' => 'ENTER',
        'send_button' => 'SEND',
        'password' => 'Password',
        'login_label' => 'Login',
		'login_soc' => '<h3>ENTER THROUGH<br/> SOCIAL NETWORKS',
		'remember_me' => 'REMEMBER ME',
		'login' => 'login',
		'register' => 'Sign up',
		'pass_2' => 'Repeat Password',
		'registration' => 'registration'
    ),
  'go_home' => 'Back to main page',
  'pub_company' => 'Company',
  'pub_terms' => 'Terms of use',
  'pub_contacts' => 'Contact us',
  'pub_payment' => 'Payment',
  'pub_for_user' => 'Customer\'s info',
  'copyright_e2m' => '&copy; 2012 Ltd. "Express-2"',
    'tickets_kiev' => 'Airline tickets Kiev',
    'tickets_donetsk' => 'Airline tickets Donetsk',
    'tickets_simferopol' => 'Airline tickets Simferopol',
    'tickets_kharkov' => 'Airline tickets Kharkov',
    'tickets_dnepr' => 'Airline tickets Dnepropetrovsk',
    'tickets_telaviv' => 'Airline tickets Tel Aviv',
    'booking_service' => 'Online booking service №1',
    'select_another' => 'select another operator',
    'for_odessa' => 'for Odessa',
    'for_donetsk' => 'for Donetsk',
    'for_kharkov' => 'for Kharkov',
    'for_ukraine' => 'for Ukraine',
    'for_lvov' => 'for Lvov',
    'for_kiev' => 'for Kiev',
    'ourprojects' => 'Our Projects',
    'supportchat' => 'Online Chat',

    
    'seo_tour_title_result' => 'Tours to %%resort%% %%country%%/Tours/',
    'seo_tour_description_result' => 'Tours to %%resort%% %%country%%, hotels %%resort%% %%country%%, current offers of tour operators to %%resort%% %%country%%, rest in %%resort%% %%country%%.',
    
    'seo_tour_title_hotel' => 'Tour of the hotel %%hotel%%, %%resort%%, %%country%%/Tours %%resort%%, %%country%%/Tours/',
    'seo_tour_description_hotel' => 'Tour of the hotel %%hotel%%, %%resort%%, %%country%%, hotel %%hotel%%, price of the tour at the hotel %%hotel%%, %%resort%%, %%country%%, rest in %%hotel%%, %%resort%%, %%country%%, reviewed hotel %%hotel%%.',    

    'seo_hotel_title_result' => 'Hotels %%city%% online. Booking hotels %%city%% (%%country%%)/',
    'seo_hotel_description_result' => 'All hotels %%city%% with discounts. Book hotels %%city%%! Hotel rooms %%city%%, hotels review %%city%%, payment cards Visa/Mastercard. We guarantee the lowest prices on hotels %%city%%.',    

    'seo_hotel_title_show' => 'Book hotel %%hotel%%, %%city%%, %%country%% online/', 
    'seo_hotel_description_show' => 'Book hotel %%hotel%% , %%city%%, %%country%% online at the best price. Availability hotel %%hotel%%, reviews hhotel %%hotel%%, room review for hotel %%hotel%%. Payment cards Visa/MasterCard.',        
    
    'seo_travel_title_direction' => 'Recreation %%city%%, guide %%city%% dowload, resorts %%city%%, tourist destinations %%city%% /',
    'seo_travel_description_direction' => 'Online guides %%city%%, recreation %%city%%, cuisine %%city%%, information %%city%%, tourist guide %%city%%, shopping in %%city%%, photo %%city%%, museums %%city%%. Download guide %%city%% free.',        

    'seo_rating_title_main' => 'Рейтинги авиакомпаний Украины, России и мира',
    'seo_rating_description_main' => 'Единственный в Украине рейтинг авиакомпаний, который составлен путешественниками. Все авиакомпании Украины, России и мира в нашем рейтинге. Только достоверные результаты и максимальный набор критериев для оценки.',
    
    
    
    'seo_travel_title_country' => 'Recreation %%country%%, guide %%country%% download, resorts %%country%%/',
    'seo_travel_description_country' => 'Online guides %%city%%, recreation %%city%%, cuisine %%city%%, information %%city%%, tourist guide %%city%%, shopping in %%city%%, photo %%city%%, museums %%city%%, tourist destinations %%country%% . Download guide %%city%% free.',
    'breadcrumbs_main' => 'Online booking service №❶',
    'breadcrumbs_avia' => 'Airline tickets online№❶',
    'breadcrumbs_gd' => 'Railway tickets online №❶',
    'breadcrumbs_city_avia' => 'Airline tickets %s',
    'breadcrumbs_city_gd' => 'Railway tickets %s',
    'breadcrumbs_bus' => 'Bus tickets online №❶',
    'breadcrumbs_hotels' => 'Hotels online №❶',
    'breadcrumbs_tours' => 'Tours online №❶',
    'breadcrumbs_travel' => 'Travels №❶',
    'breadcrumbs_my' => 'Online booking service №❶',
    'breadcrumbs_rent' => 'Apartments №❶',
    'breadcrumbs_insurance' => 'Online insurance service №❶',        
	'footer_address' => '2, V.Chornovola str., office 83, Kyiv, 01135, Ukraine',
	'phones_data' => '0 800 501 600 (free from all fixed phones in Ukraine)<br/>
050 444 02 94 (multichannel mobile)',
	'footer_email' => 'Email:',
	'footer_address2' => '194017, Russian Federation, St. Petersburg, ul. Drezdenskaya, 8/2',
    
    'exchange_drivers' => array('0' => 'NBU', '1' => 'site xe.com', '2' => 'NBU'),
	'footer_skype' => 'CALL OPERATOR',
	'footer_skype_descr' => 'ticketshelp',
	'skype_title' => 'Click to call free operators ' . Kohana::config('config.site_name'),
	'reis_head' => array( 
		'follow_us' => '<p>Follow us <br /> in social networks</p>',
		'welcome' => 'welcome',
		'login' => 'Log in / Register',
		'about' => 'About',
		'coop' => 'cooperation',
		'service_book' => 'Online service booking',
		'ooo' => 'Ltd "Reisburo".',
		'info' => 'information',
		'my_trip' => 'My flight',
	),
	'frequently_questions' => 'Frequently asked questions',
	'our_address' => 'our address',
	'phones' => 'phones',
	'operator_book' => 'operators booking',
	'quality_control' => 'Quality Control Service',
	'bus_tickets_f' => 'bus Tickets',
	'service_profile' => 'Service profile',
	'corp_clients' => 'For corporate clients',
	'vacancy' => 'Vacancies',
	'online_chat' => 'If you need help with online service, you can use <a  onclick="$(\'#sh_button\').click();return false;" href="#" rel="nofollow">online chat</a> with service agent.<br />
We will be glad to help in solving any of your questions!',
	
	'air_ticket_h' => 'Airline tickets online',
	'rail_ticket_h' => 'Railway tickets online',
	'bus_ticket_h' => 'Bus tickets',
	'ins_ticket_h' => 'Insurance online',
	'roaming_ticket_h' => 'Roaming online',
	'coop_ticket_h' => 'Cooperation',
	'control_ticket_h' => 'Quality Control Service'
)

?>
