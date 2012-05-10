jQuery(function() {
    jQuery('.socialshareprivacy').socialSharePrivacy({
	info_link: 'http://www.heise.de/ct/artikel/2-Klicks-fuer-mehr-Datenschutz-1333879.html',
	txt_help: 'Wenn Sie diese Felder durch einen Klick aktivieren, werden Informationen an Facebook, Twitter oder Google in die USA &uuml;bertragen und unter Umst&auml;nden auch dort gespeichert. N&auml;heres erfahren Sie durch einen Klick auf das <em>i</em>.',
	settings_perma: 'Dauerhaft aktivieren und Datenübertragung zustimmen:',
	cookie_path: '/CMSimple_XH_151/',
	cookie_domain: 'localhost',
	cookie_expires: 365,
	css_path: '',
	services: {
	    facebook: {
		status: 'on',
		dummy_img: './plugins/socialshareprivacy/css/images/dummy_facebook_en.png',
		txt_info: '2 Klicks f&uuml;r mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie k&ouml;nnen Ihre Empfehlung an Facebook senden. Schon beim Aktivieren werden Daten an Dritte &uuml;bertragen &ndash; siehe <em>i</em>.',
		txt_fb_off: 'nicht mit Facebook verbunden',
		txt_fb_on: 'mit Facebook verbunden',
		perma_option: 'on',
		display_name: 'Facebook',
		referrer_track: '',
		language: 'de_DE', // TODO
		action: 'like'
	    },
	    twitter: {
		status: 'on',
		dummy_img: './plugins/socialshareprivacy/css/images/dummy_twitter.png',
		txt_info: '2 Klicks f&uuml;r mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie k&ouml;nnen Ihre Empfehlung an Twitter senden. Schon beim Aktivieren werden Daten an Dritte &uuml;bertragen &ndash; siehe <em>i</em>.',
		txt_twitter_off: 'nicht mit Twitter verbunden',
		txt_twitter_on: 'mit Twitter verbunden',
		perma_option: 'on',
		display_name: 'Twitter',
		referrer_track: '',
		language: 'de'
	    },
	    gplus: {
		status: 'on',
		dummy_img: './plugins/socialshareprivacy/css/images/dummy_gplus.png',
		txt_info: '2 Klicks f&uuml;r mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie k&ouml;nnen Ihre Empfehlung an Google+ senden. Schon beim Aktivieren werden Daten an Dritte &uuml;bertragen &ndash; siehe <em>i</em>.',
		txt_gplus_off: 'nicht mit Google+ verbunden',
		txt_gplus_on: 'mit Google+ verbunden',
		perma_option: 'on',
		display_name: 'Google+',
		referrer_track: '',
		language: 'de'
	    }
	}
    })
})