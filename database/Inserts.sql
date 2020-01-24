use Cronose;

insert into Language values ('es'),('ca'),('en');

INSERT INTO Languages_Offerted (`id`) VALUES ('en'),('aa'),('ab'),('af'),('am'),('ar'),
('as'),('ay'),('az'),('ba'),('be'),('bg'),('bh'),('bi'),('bn'),('bo'),('br'),
('ca'),('co'),('cs'),('cy'),('da'),('de'),('dz'),('el'),('eo'),('es'),('et'),
('eu'),('fa'),('fi'),('fj'),('fo'),('fr'),('fy'),('ga'),('gd'),('gl'),('gn'),
('gu'),('ha'),('hi'),('hr'),('hu'),('hy'),('ia'),('ie'),('ik'),('in'),('is'),
('it'),('iw'),('ja'),('ji'),('jw'),('ka'),('kk'),('kl'),('km'),('kn'),('ko'),
('ks'),('ku'),('ky'),('la'),('ln'),('lo'),('lt'),('lv'),('mg'),('mi'),('mk'),
('ml'),('mn'),('mo'),('mr'),('ms'),('mt'),('my'),('na'),('ne'),('nl'),('no'),
('oc'),('om'),('pa'),('pl'),('ps'),('pt'),('qu'),('rm'),('rn'),('ro'),('ru'),
('rw'),('sa'),('sd'),('sg'),('sh'),('si'),('sk'),('sl'),('sm'),('sn'),('so'),
('sq'),('sr'),('ss'),('st'),('su'),('sv'),('sw'),('ta'),('te'),('tg'),('th'),
('ti'),('tk'),('tl'),('tn'),('to'),('tr'),('ts'),('tt'),('tw'),('uk'),('ur'),
('uz'),('vi'),('vo'),('wo'),('xh'),('yo'),('zh'),('zu');

insert into Languages_Translation (language_id, translation, language_translated) values ('en', 'English', 'en'),
('en', 'Afar', 'aa'), ('en', 'Abkhazian', 'ab'),('en', 'Azerbaijani', 'az'), ('en', 'Bashkir', 'ba'),
('en', 'Belarusian', 'be'), ('en', 'Bulgarian', 'bg'),('en', 'Bihari', 'bh'), ('en', 'Bislama', 'bi'),
('en', 'Bengali/Bangla', 'bn'), ('en', 'Tibetan', 'bo'),('en', 'Breton', 'br'), ('en', 'Catalan', 'ca'),
('en', 'Corsican', 'co'), ('en', 'Czech', 'cs'),('en', 'Welsh', 'cy'), ('en','Danish', 'da'),('en', 'German', 'de'),
('en', 'Bhutani', 'dz'),('en', 'Greek', 'el'),('en', 'Esperanto', 'eo'),('en','Spanish', 'es'),('en', 'Estonian', 'et'),
('en', 'Basque', 'eu'),('en', 'Persian', 'fa'),('en', 'Finnish', 'fi'),('en', 'Fiji', 'fj'),('en','Faeroese', 'fo'),
('en', 'French', 'fr'),('en', 'Frisian', 'fy'),('en', 'Irish', 'ga'),('en', 'Scots/Gaelic', 'gd'),('en', 'Galician', 'gl'),
('en', 'Guarani', 'gn'),('en', 'Gujarati', 'gu'),('en', 'Hausa', 'ha'),('en', 'Hindi', 'hi'),('en', 'Croatian', 'hr'),
('en', 'Hungarian', 'hu'),('en', 'Armenian', 'hy'),('en', 'Interlingua', 'ia'),('en', 'Interlingue', 'ie'),('en','Inupiak', 'ik'),
('en', 'Indonesian', 'in'),('en', 'Icelandic', 'is'),('en', 'Italian', 'it'),('en', 'Hebrew', 'iw'),('en', 'Japanese', 'ja'),
('en', 'Yiddish', 'ji'),('en', 'Javanese', 'jw'),('en', 'Georgian', 'ka'),('en', 'Kazakh', 'kk'),('en','Greenlandic', 'kl'),
('en','Cambodian', 'km'),('en', 'Kannada', 'kn'),('en', 'Korean', 'ko'),('en', 'Kashmiri', 'ks'),('en', 'Kurdish', 'ku'),
('en', 'Kirghiz', 'ky'),('en', 'Latin', 'la'),('en', 'Lingala', 'ln'),('en', 'Laothian', 'lo'),('en', 'Lithuanian', 'lt'),
('en', 'Latvian/Lettish', 'lv'),('en', 'Malagasy', 'mg'),('en', 'Maori', 'mi'),('en', 'Macedonian', 'mk'),('en', 'Malayalam', 'ml'),
('en', 'Mongolian', 'mn'),('en','Moldavian', 'mo'),('en', 'Marathi', 'mr'),('en', 'Malay', 'ms'),('en', 'Maltese', 'mt'),
('en', 'Burmese', 'my'),('en', 'Nauru', 'na'),('en', 'Nepali', 'ne'),('en', 'Dutch', 'nl'),('en', 'Norwegian', 'no'),
('en', 'Occitan', 'oc'),('en', '(Afan)/Oromoor/Oriya', 'om'),('en', 'Punjabi', 'pa'),('en', 'Polish', 'pl'),('en', 'Pashto/Pushto', 'ps'),
('en', 'Portuguese', 'pt'),('en', 'Quechua', 'qu'),('en', 'Rhaeto-Romance', 'rm'),('en', 'Kirundi', 'rn'),('en', 'Romanian', 'ro'),('en', 'Russian', 'ru'),
('en', 'Kinyarwanda', 'rw'),('en', 'Sanskrit', 'sa'),('en', 'Sindhi', 'sd'),('en', 'Sangro', 'sg'),('en', 'Serbo-Croatian', 'sh'),
('en', 'Singhalese', 'si'),('en', 'Slovak', 'sk'),('en', 'Slovenian', 'sl'),('en', 'Samoan', 'sm'),('en', 'Shona', 'sn'),
('en', 'Somali', 'so'),('en', 'Albanian', 'sq'),('en', 'Serbian', 'sr'),('en', 'Siswati', 'ss'),('en', 'Sesotho', 'st'),
('en', 'Sundanese', 'su'),('en', 'Swedish', 'sv'),('en', 'Swahili', 'sw'),('en', 'Tamil', 'ta'),('en', 'Telugu', 'te'),
('en', 'Tajik', 'tg'),('en', 'Thai', 'th'),('en', 'Tigrinya', 'ti'),('en', 'Turkmen', 'tk'),('en', 'Tagalog', 'tl'),
('en', 'Setswana', 'tn'),('en', 'Tonga', 'to'),('en', 'Turkish', 'tr'),('en', 'Tsonga', 'ts'),('en', 'Tatar', 'tt'),
('en', 'Twi', 'tw'),('en', 'Ukrainian', 'uk'),('en', 'Urdu', 'ur'),('en', 'Uzbek', 'uz'),('en', 'Vietnamese', 'vi'),
('en', 'Volapuk', 'vo'),('en', 'Wolof', 'wo'),('en', 'Xhosa', 'xh'),('en', 'Yoruba', 'yo'),('en', 'Chinese', 'zh'),
('en', 'Zulu', 'zu');

insert into Languages_Translation (language_id, translation, language_translated) values  ('es', 'inglés', 'en'),
('es', 'Afar', 'aa'), ('es', 'abjasio', 'ab'), ('es', 'azerbaiyano', 'az'), ('es', 'Bashkir', 'ba'),
('es', 'bielorruso', 'be'), ('es', 'búlgaro', 'bg'), ('es', 'Bihari', 'bh'), ('es', 'Bislama', 'bi'),
('es', 'bengalí / bengalí', 'bn'), ('es', 'tibetano', 'bo'), ('es', 'bretón', 'br'), ('es', 'catalán', 'ca'),
('es', 'corso', 'co'), ('es', 'checo', 'cs'), ('es', 'galés', 'cy'), ('es', 'danés', 'da'), ('es', 'alemán', 'de'),
('es', 'Bhutani', 'dz'), ('es', 'griego', 'el'), ('es', 'esperanto', 'eo'), ('es', 'español', 'es'), ('es', 'estonio', 'et'),
('es', 'vasco', 'eu'), ('es', 'persa', 'fa'), ('es', 'finlandés', 'fi'), ('es', 'Fiji', 'fj'), ('es', 'faeroese', 'fo'),
('es', 'francés', 'fr'), ('es', 'frisón', 'fy'), ('es', 'irlandés', 'ga'), ('es', 'escocés / gaélico', 'gd'), ('es', 'gallego', 'gl'),
('es', 'guaraní', 'gn'), ('es', 'gujarati', 'gu'), ('es', 'hausa', 'ha'), ('es', 'hindi', 'hi'), ('es', 'croata', 'hr'),
('es', 'húngaro', 'hu'), ('es', 'armenio', 'hy'), ('es', 'interlingua', 'ia'), ('es', 'interlingue', 'es decir'), ('es', 'inupiak', 'ik'),
('es', 'indonesio', 'in'), ('es', 'islandés', 'is'), ('es', 'italiano', 'it'), ('es', 'hebreo', 'iw'), ('es', 'japonés', 'ja'),
('es', 'yiddish', 'ji'), ('es', 'javanés', 'jw'), ('es', 'georgiano', 'ka'), ('es', 'kazajo', 'kk'), ('es', 'groenlandés', 'kl'),
('es', 'camboyano', 'km'), ('es', 'kannada', 'kn'), ('es', 'coreano', 'ko'), ('es', 'Kashmiri', 'ks'), ('es', 'kurdo', 'ku'),
('es', 'Kirghiz', 'ky'), ('es', 'latín', 'la'), ('es', 'Lingala', 'ln'), ('es', 'Laothian', 'lo'), ('es', 'lituano', 'lt'),
('es', 'letón / letón', 'lv'), ('es', 'malgache', 'mg'), ('es', 'maorí', 'mi'), ('es', 'macedonio', 'mk'), ('es', 'malayalam', 'ml'),
('es', 'mongol', 'mn'), ('es', 'moldavo', 'mo'), ('es', 'marathi', 'mr'), ('es', 'malayo', 'ms'), ('es', 'maltés', 'mt'),
('es', 'birmano', 'my'), ('es', 'Nauru', 'na'), ('es', 'nepalí', 'ne'), ('es', 'holandés', 'nl'), ('es', 'noruego', 'no'),
('es', 'occitano', 'oc'), ('es', '(Afan) / Oromoor / Oriya', 'om'), ('es', 'Punjabi', 'pa'), ('es', 'polaco', 'pl'), ('es', 'Pashto / Pushto', 'ps'),
('es', 'portugués', 'pt'), ('es', 'quechua', 'qu'), ('es', 'Rhaeto-Romance', 'rm'), ('es', 'Kirundi', 'rn'), ('es', 'rumano', 'ro'), ('es', 'ruso', 'ru'),
('es', 'Kinyarwanda', 'rw'), ('es', 'sánscrito', 'sa'), ('es', 'Sindhi', 'sd'), ('es', 'Sangro', 'sg'), ('es', 'serbocroata', 'sh'),
('es', 'Singhalese', 'si'), ('es', 'Slovak', 'sk'), ('es', 'Slovenian', 'sl'), ('es', 'Samoan', 'sm'), ('es', 'Shona', 'sn'),
('es', 'somalí', 'so'), ('es', 'albanés', 'sq'), ('es', 'serbio', 'sr'), ('es', 'Siswati', 'ss'), ('es', 'Sesotho', 'st'),
('es', 'Sundanese', 'su'), ('es', 'sueco', 'sv'), ('es', 'swahili', 'sw'), ('es', 'tamil', 'ta'), ('es', 'telugu', 'te'),
('es', 'tayiko', 'tg'), ('es', 'tailandés', 'th'), ('es', 'Tigrinya', 'ti'), ('es', 'turcomano', 'tk'), ('es', 'tagalo', 'tl'),
('es', 'Setswana', 'tn'), ('es', 'Tonga', 'to'), ('es', 'turco', 'tr'), ('es', 'Tsonga', 'ts'), ('es', 'tártaro', 'tt'),
('es', 'Twi', 'tw'), ('es', 'ucraniano', 'uk'), ('es', 'urdu', 'ur'), ('es', 'uzbeko', 'uz'), ('es', 'vietnamita', 'vi'),
('es', 'Volapuk', 'vo'), ('es', 'Wolof', 'wo'), ('es', 'Xhosa', 'xh'), ('es', 'Yoruba', 'yo'), ('es', 'chino', 'zh'),
('es', 'zulú', 'zu');

insert into Languages_Translation (language_id, translation, language_translated) values  ('ca', 'anglès', 'en'),
('ca', 'Afar', 'aa'), ('ca', 'Abkhazian', 'ab'), ('ca', 'Azerbaidjan', 'az'), ('ca', 'Bashkir', 'ba'),
('ca', 'bielorús', 'be'), ('ca', 'búlgar', 'bg'), ('ca', 'Bihari', 'bh'), ('ca', 'Bislama', 'bi'),
('ca', 'bengalí / Bangla', 'bn'), ('ca', 'tibetà', 'bo'), ('ca', 'bretó', 'br'), ('ca', 'català', 'ca'),
('ca', 'cors', 'co'), ('ca', 'txec', 'cs'), ('ca', 'gal·lès', 'cy'), ('ca', 'danès', 'da'), ('ca', 'alemany', 'de'),
('ca', 'Bhutani', 'dz'), ('ca', 'grec', 'el'), ('ca', 'esperanto', 'eo'), ('ca', 'espanyol', 'es'), ('ca', 'estonià', 'et'),
('ca', 'basc', 'eu'), ('ca', 'persa', 'fa'), ('ca', 'finès', 'fi'), ('ca', 'Fiji', 'fj'), ('ca', 'faeroès', 'fo'),
('ca', 'francès', 'fr'), ('ca', 'frisó', 'fy'), ('ca', 'irlandès', 'ga'), ('ca', 'escocès / gaèlic', 'gd'), ('ca', 'gallec', 'gl'),
('ca', 'Guarani', 'gn'), ('ca', 'gujarat', 'gu'), ('ca', 'Hausa', 'ha'), ('ca', 'hindi', 'hi'), ('ca', 'croat', 'hr'),
('ca', 'hongarès', 'hu'), ('ca', 'armeni', 'hy'), ('ca', 'interlingua', 'ia'), ('ca', 'Interlingue', 'és a dir'), ('ca', 'Inupiak', 'ik'),
('ca', 'indonèsia', 'in'), ('ca', 'islandès', 'is'), ('ca', 'italià', 'it'), ('ca', 'hebreu', 'iw'), ('ca', 'japonès', 'ja'),
('ca', 'yidis', 'ji'), ('ca', 'javanès', 'jw'), ('ca', 'georgià', 'ka'), ('ca', 'kazakh', 'kk'), ('ca', 'groenlandès', 'kl'),
('ca', 'cambodjana', 'km'), ('ca', 'Kannada', 'kn'), ('ca', 'coreà', 'ko'), ('ca', 'Caixmir', 'ks'), ('ca', 'kurd', 'ku'),
('ca', 'Kirghiz', 'ky'), ('ca', 'llatí', 'la'), ('ca', 'Lingala', 'ln'), ('ca', 'Laothian', 'lo'), ('ca', 'lituà', 'lt'),
('ca', 'letó / Lettish', 'lv'), ('ca', 'malgaix', 'mg'), ('ca', 'maori', 'mi'), ('ca', 'macedoni', 'mk'), ('ca', 'malaià', 'ml'),
('ca', 'mongol', 'mn'), ('ca', 'moldav', 'mo'), ('ca', 'marathi', 'mr'), ('ca', 'malai', 'ms'), ('ca', 'maltès', 'mt'),
('ca', 'birmà', 'my'), ('ca', 'Nauru', 'na'), ('ca', 'nepalí', 'ne'), ('ca', 'holandès', 'nl'), ('ca', 'noruec', 'no'),
('ca', 'occità', 'oc'), ('ca', '(Afan) / Oromoor / Oriya', 'om'), ('ca', 'punjabi', 'pa'), ('ca', 'polonès', 'pl'), ('ca', 'Pashto / Pushto', 'ps'),
('ca', 'portuguès', 'pt'), ('ca', 'quechua', 'qu'), ('ca', 'Rhaeto-Romanç', 'rm'), ('ca', 'Kirundi', 'rn'), ('ca', 'romanès', 'ro'), ('ca', 'rus', 'ru'),
('ca', 'kinyarwanda', 'rw'), ('ca', 'sànscrit', 'sa'), ('ca', 'Sindhi', 'sd'), ('ca', 'Sangro', 'sg'), ('ca', 'serbocroata', 'sh'),
('ca', 'singhalese', 'si'), ('ca', 'eslovac', 'sk'), ('ca', 'eslovè', 'sl'), ('ca', 'samoà', 'sm'), ('ca', 'shona', 'sn'),
('ca', 'somali', 'so'), ('ca', 'albanès', 'sq'), ('ca', 'serbi', 'sr'), ('ca', 'Siswati', 'ss'), ('ca', 'Sesotho', 'st'),
('ca', 'sundanès', 'su'), ('ca', 'suec', 'sv'), ('ca', 'suav', 'sw'), ('ca', 'tamil', 'ta'), ('ca', 'telugu', 'te'),
('ca', 'Tajik', 'tg'), ('ca', 'tailandès', 'th'), ('ca', 'tigrinya', 'ti'), ('ca', 'turcomani', 'tk'), ('ca', 'tagalog', 'tl'),
('ca', 'Setswana', 'tn'), ('ca', 'Tonga', 'to'), ('ca', 'turc', 'tr'), ('ca', 'Tsonga', 'ts'), ('ca', 'tàtar', 'tt'),
('ca', 'Twi', 'tw'), ('ca', 'ucraïnès', 'uk'), ('ca', 'urdu', 'ur'), ('ca', 'uzbek', 'uz'), ('ca', 'vietnamita', 'vi'),
('ca', 'Volapuk', 'vo'), ('ca', 'wolof', 'wo'), ('ca', 'Xhosa', 'xh'), ('ca', 'ioruba', 'yo'), ('ca', 'xinès', 'zh'),
('ca', 'zulu', 'zu');

insert into Province(name) values ('Illes Balears');

insert into City values(07500,1,'Manacor',3.20142,39.57434);

insert into Veteranity values (1,100,0),(2,250,0),(3,450,0),(4,700,0),(5,1000,0);

insert into Media(extension,url) values('.jpg','admmin_avatar');
insert into Media(extension,url) values('.jpg','admmin_dni');

insert into DNI_Photo(status,media_id) values ('accepted',2);

insert into User(dni, name, surname, surname_2, email, password, tag, initials, coins, registration_date, points, private, city_cp, province_id, avatar_id, dni_photo_id) values ('12345678A','Admin','Cronose','Cronose','admin@cronose.dawman.info','202cb962ac59075b964b07152d234b70',1254,'ACC',0.00,date(now()),200,0,07500,1,1,1);
insert into User(dni, name, surname, surname_2, email, password, tag, initials, coins, registration_date, points, private, city_cp, province_id, avatar_id, dni_photo_id) values ('87654321Z','Anastasia','Guiterrez','Marcos','Anastasi@cgmail.com','202cb962ac59075b964b07152d234b70',9875, 'AGC' ,0.00,date(now()),80,0,07500,1,1,1);
insert into User(dni, name, surname, surname_2, email, password, tag, initials, coins, registration_date, points, private, city_cp, province_id, avatar_id, dni_photo_id) values ('45612387J','Josep','Oliver','Sanso','josep.oliverr@gmail.com','202cb962ac59075b964b07152d234b70',1313, 'JOS',3.00,date(now()),999,0,07500,1,1,1);

insert into Change_Veteranity values (2,1,date(now())),(1,2,date(now())),(5,3,date(now()));

select * from User;

insert into Category(coin_price) values (1.2),(1);

insert into Category_Language values ('es',1,'Educación'),('ca',1,'Educació'),('en',1,'Education'),('es',2,'Mantenimiento'),('ca',2,'Manteniment'),('en',2,'Maintenance');

select * from Category;

insert into Specialization(category_id) values (1),(2);

insert into Specialization_Language 
values ('es',1,'Profesor Programación'),('ca',1,'Professor Programació'),('en',1,'Programming Professor'),
('es',2,'Fontanero'),('ca',2,'Lampista'),('en',2,'Plumber');

INSERT INTO Offer(user_id, specialization_id, valoration_avg, personal_valoration, coin_price, offered_at, visibility) VALUES 
('1', '1', '90', '70', '1.2', '2019-12-21', '1'),
('2', '2', '50', '50', '1', '2019-12-22', '1');
INSERT INTO Offer_Language (language_id, user_id, specialization_id, title, description) 
VALUES ('es', '1', '1', 'Profesor de programación', 'Programación básica de c++, Programación avanzada de Java, '),
('ca', '1', '1', 'Professor de programació', 'Programació básica de c++, Programació avançada de Java, '),
('en', '1', '1', 'Programming Professor', 'Basic programming of c++, Advanced programming of Java, ');
INSERT INTO Offer_Language (language_id, user_id, specialization_id, title, description) 
VALUES ('es', '2', '2', 'Fontanero', 'No hay ni uno igual ');

insert into Media(extension, url) values ('.jpg','profesor'),('.jpg','fontanero');

INSERT INTO Load_Media (user_id, specialization_id, media_id) VALUES ('1', '1', '3'), ('1', '2', '4');

INSERT INTO `Achievement` VALUES (),(),(),(),();


INSERT INTO `Achievement_Language` (`language_id`, `achievement_id`, `name`, `description`) VALUES
('ca', 1, 'a1', 'Registrarse a la pàgina'),
('ca', 2, 'a2', 'Xatetja amb algú'),
('ca', 3, 'a3', 'Publica una oferta'),
('ca', 4, 'a4', 'Realitza el teu primer trevall'),
('ca', 5, 'a5', 'Contracta algú'),
('en', 1, 'a1', 'Register in page'),
('en', 2, 'a2', 'Chat with someone'),
('en', 3, 'a3', 'Publish an offer'),
('en', 4, 'a4', 'Do your first job'),
('en', 5, 'a5', 'Contract someone'),
('es', 1, 'a1', 'Registrarse en la página'),
('es', 2, 'a2', 'Chatea con alguien'),
('es', 3, 'a3', 'Publica una oferta'),
('es', 4, 'a4', 'Realiza tu primer trabajo'),
('es', 5, 'a5', 'Contrata a alguien');

INSERT INTO `Obtain` (`achievement_id`, `user_id`, `obtained_at`) VALUES
(1, '1', '2020-01-08'),
(3, '1', '2020-01-02');

