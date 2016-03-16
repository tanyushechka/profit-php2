CREATE TABLE news
(
  id         BIGINT(20) UNSIGNED                  NOT NULL,
  author_id  BIGINT(20) UNSIGNED                  NOT NULL,
  title      VARCHAR(100)                         NOT NULL,
  created_at DATETIME DEFAULT 'CURRENT_TIMESTAMP' NOT NULL,
  source     VARCHAR(100),
  text       TEXT                                 NOT NULL,
  CONSTRAINT news_ibfk_1 FOREIGN KEY (author_id) REFERENCES authors (id)
);
CREATE INDEX author_id ON news (author_id);
CREATE UNIQUE INDEX id ON news (id);

INSERT INTO php2.news (id, author_id, title, created_at, source, text) VALUES
  (1, 2, 'Во FreeBSD обнаружены критически опасные уязвимости', '2016-02-02 15:19:43',
   'https://habrahabr.ru/company/pt/blog/275637/', 'Команда проекта FreeBSD сообщает, что в операционной системе обнаружен ряд критически опасных уязвимостей, позволяющих злоумышленникам проводить атаки, направленные на отказ в обслуживании, повышать привилегии и раскрывать важные данные.

Уязвимость, связанная с некорректной обработкой сообщений ICMPv6 в стеке SCTP (CVE-2016-1879)

SCTP (Stream Control Transmission Protocol — «протокол передачи с управлением потоком») — это протокол транспортного уровня, который разработан для передачи сообщений сигнализации телефонных сетей в IP-среде. В основном данный протокол используется в технологических сетях операторов связи.

Этой уязвимости подвержены версии FreeBSD 9.3, 10.1 и 10.2 в том случае, если они сконфигурированы с поддержкой протоколов SCTP и IPv6 (конфигурация по умолчанию). Для эксплуатации ошибки злоумышленнику требуется отправить специально сформированное сообщение ICMPv6. Успешная эксплуатация позволяет реализовать атаку на отказ в обслуживании (DoS).

DoS возникает из-за недостаточной проверки длины заголовка SCTP-пакета, полученного в ICMPv6-сообщении об ошибке. Когда адресат недоступен, маршрутизатор может сгенерировать сообщение об ошибке и переслать его отправителю через ICMPv6.

В такой ICMPv6-пакет вложен оригинальный IPv6-пакет, в котором поле Next Header указывает на то, как протокол верхнего уровня инкапсулируется. В данном случае это SCTP.
Когда ядро получает по ICMPv6 сообщение об ошибке, оно находит в нем пакет протокола верхнего уровня и передает его соответствующему обработчику (в данном случае sctp6_ctlinput()).

Когда ядро получает по ICMPv6 сообщение об ошибке, оно находит в нем пакет протокола верхнего уровня и передает его соответствующему обработчику (в данном случае sctp6_ctlinput()). Обработчик SCTP предполагает, что входной пакет содержит заголовок достаточной длины, пытается скопировать его с помощью m_copydata(), в которую передаются значения смещения и количество байтов, которое требуется считать. Поскольку ожидается блок данных размером 12 байт, если отправить пакет с SCTP-заголовком меньше 12 байт, то происходит разыменование нулевого указателя, что вызывает критический сбой ядра системы (kernel panic).

Для эксплуатации уязвимости наличие открытого SCTP-сокета необязательно.
Создать ICMPv6-пакет для осуществления атаки можно с помощью scapy.');
INSERT INTO php2.news (id, author_id, title, created_at, source, text) VALUES
  (2, 1, 'В защищенных телефонах для спецслужб найдена «закладка» для прослушки', '2016-02-02 15:23:07',
   'https://www.anti-malware.ru/news/2016-01-22/17915',
   'Старший научный сотрудник исследовательской группы в области информационной безопасности при Университетском колледже Лондона Стивен Мердок (Steven Murdoch) раскритиковал протокол защиты, разработанный организацией, контроль над которой принадлежит спецслужбам Великобритании.  Речь идет о протоколе MIKEY-SAKKE для шифрования голосовых звонков. Его автором является CESG — организация, входящая в состав Центра правительственной связи Великобритании (Government Communications Headquarters — GCHQ) и отвечающая за информационную безопасность. Обязательная сертификация Для того чтобы использовать зашифрованные коммуникации, необходимо получить разрешение у правительства, которое должно сертифицировать систему связи. В Великобритании этим органом является GCHQ. И он выдает разрешения только на те продукты, которые поддерживают протокол MIKEY-SAKKE. «В результате протокол MIKEY-SAKKE используется практически во всех системах правительственной связи в Великобритании. Потому что производители, выпускающие телекоммуникационное оборудование с функцией шифрования звонков, должны получить соответствующее разрешение для выхода на рынок», — пояснил эксперт. Принцип работы протокола Принцип работы MIKEY-SAKKE во многом похож на то, как происходит шифрование электронной почты. При установке соединения по защищенному каналу в первый раз инициатор беседы отправляет второму абоненту закрытый ключ шифрования. Получатель, зная уникальный идентификатор инициатора, получив публичный мастер-ключ от оператора связи и имея закрытый ключ от отправителя, может дешифровать звонок. Сформированные собеседниками ключи шифрования существуют в течение месяца. Поэтому оператор должен всегда располагать мастер-ключом, на основе которого формируются закрытые ключи, пишет cnews.ru.  Уязвимая конструкция Конструкцию MIKEY-SAKKE нельзя назвать надежной, утверждает Мердок. Во-первых, его авторам не следовало включать в протокол уникальный идентификатор абонента, который необходим второму абоненту для дешифровки, потому что существуют более надежные механизмы инициации защищенного соединения. Во-вторых, наличие мастер-ключа, который позволяет дешифровать все звонки в прошлом и будущем без обнаружения, представляет собой огромный риск для пользователей защищенной линии и заманчивую цель для хакеров, считает Мердок. Выводы Сами разработчики протокола из CESG подают эти недостатки как его особенность. Наличие мастер-ключа может быть полезно, например, компаниям из финансовой индустрии, которым может потребоваться дешифровать звонки в случае выявления финансовых махинаций или фактов мошенничества. «Однако трудно представить, чтобы финансовые организации желали хранить записи телефонных звонков и записывали все подряд», — указывает эксперт.  На самом деле разработчики MIKEY-SAKKE преследовали другую цель — сделать так, чтобы массовая прослушка телефонных линий была доступна по щелчку пальцев. «Правительство Великобритании продвигает данный протокол, утверждая, что он предлагает более надежную защиту в сравнении с другими доступными на рынке технологиями. В действительности же этот протокол специально спроектирован таким образом, чтобы защита была минимальна, но зато была возможность прослушивать звонки без ограничений и внешнего контроля».');
INSERT INTO php2.news (id, author_id, title, created_at, source, text) VALUES
  (4, 1, 'Обнаружен многофункциональный бэкдор для Linux', '2016-02-02 15:25:20',
   'https://www.anti-malware.ru/news/2016-01-22/17912',
   'Специалисты компании «Доктор Веб» проанализировали многофункционального троянца, способного заражать работающие под управлением ОС Linux устройства. Этот бэкдор имеет широчайший спектр возможностей, среди которых — функции загрузки на инфицированное устройство различных файлов, выполнение операций с файловыми объектами, создание снимков экрана, отслеживание нажатий клавиш и многое другое. Данная вредоносная программа, добавленная в вирусные базы Dr.Web под именем Linux.BackDoor.Xunpes.1, состоит из дроппера и собственно бэкдора, выполняющего на зараженном устройстве основные шпионские функции. Дроппер написан с использованием открытой среды разработки Lazarus для компилятора Free Pascal и при запуске демонстрирует следующее диалоговое окно, в котором содержится упоминание устройств, предназначенных для выполнения операций с криптовалютой Bitcoin:   В теле данного дроппера в незашифрованном виде хранится второй компонент троянца — бэкдор, который при запуске дроппера сохраняется в папку /tmp/.ltmp/. Именно он выполняет основные вредоносные функции на зараженном устройстве. Бэкдор, написанный на языке С, при запуске расшифровывает конфигурационный файл с помощью зашитого в его тело ключа. Среди параметров конфигурации этого компонента вредоносной программы — список управляющих серверов и прокси-серверов, используемых в процессе соединения, а также иные данные, необходимые для работы программы. После этого троянец соединяется с управляющим сервером и ожидает поступления команд от злоумышленников, пишет news.drweb.ru. Всего Linux.BackDoor.Xunpes.1 способен выполнять более 40 команд, среди которых — директива включения функции сохранения нажатий пользователем клавиш (кейлоггинг), загрузки и запуска файла, путь и аргументы которого приходят с удаленного сервера (при этом сам бэкдор завершается), передачи злоумышленникам имен файлов в заданной директории, загрузки на управляющий сервер выбранных файлов, создания, удаления, переименования файлов и папок, создания снимков экрана (скриншотов), выполнения команд bash, а также многие другие.');
INSERT INTO php2.news (id, author_id, title, created_at, source, text) VALUES
  (5, 1, 'Главная Новости 5 Кибератаки на индустриальные системы усиливаются', '2016-02-02 15:26:09',
   'https://www.anti-malware.ru/news/2016-01-21/17908',
   'Cisco опубликовала очередной ежегодный отчет по информационной безопасности. В нем подчеркивается, что лишь 45 % организаций во всем мире уверены в том, что их системы ИБ в состоянии противодействовать современным высокоэффективным киберугрозам. И хотя руководители организаций зачастую не имеют точного представления об истинной эффективности своих систем информационной безопасности, 92 % из них согласны с тем, что надзорные органы и инвесторы ожидают от организаций адекватного реагирования на возросшие риски ИБ. Такие руководители активно усиливают меры по обеспечению безопасности своих организаций, особенно, в том, что касается цифровизации бизнес-процессов.   В отчете Cisco по информационной безопасности за 2016 г. рассматриваются наиболее важные вопросы и тенденции ИБ, выделенные экспертами Cisco, и отражены те изменения, которые произошли в индустрии ИБ и сфере киберпреступности. В отчете также изложены основные результаты второго ежегодного исследования Cisco Security Capabilities Benchmark с акцентом на то, как специалисты сферы ИБ оценивают защищенность своих организаций. Кроме того, отчет содержит геополитические тенденции, прогнозы, касающиеся восприятия рисков ИБ, вопросы доверия, а также основные принципы концепции комплексной защиты от угроз (Cisco Integrated Threat Defense).   В отчете названы и проблемы, с которыми бизнес сталкивается из-за стремительного развития киберпреступности. Злоумышленники все чаще получают доступ к внутренним ресурсам организаций и осуществляют высокоэффективные вредоносные кампании, ориентированные на получение прибыли. Кроме того, киберпреступники получают значительный доход от прямых атак. Например, только кибератаки, основанные на работе программ-вымогателей, приносят киберпреступникам около 34 млн долларов США ежегодно. К сожалению, эта вредоносная деятельность все еще в недостаточной степени регулируется нормативными органами.   Организации уделяют все больше внимания проблемам безопасности, ограничивающим их возможности в областях обнаружения, сдерживания и восстановления после обычных и целенаправленных кибератак, но стареющая ИТ-инфраструктура и несоответствующие современным реалиям бизнес-процессы порождают существенные риски.   Отчет содержит весьма актуальный призыв к организациям всего мира улучшить эффективность совместной работы и увеличить инвестиции в технологии, процессы и кадровые резервы, помогающие противодействовать киберпреступникам.   «Системы ИБ должны разрабатываться с учетом принципов гибкости, конфиденциальности, доверия и прозрачности. Поскольку Интернет вещей и процессы цифровизации проникают во все сферы бизнеса, новые технологические возможности необходимо разрабатывать, внедрять и использовать с обязательным учетом каждого из этих принципов», — подчеркнул Джон Н. Стюарт (John N. Stewart), старший вице-президент и главный директор компании Cisco по информационной безопасности.');
INSERT INTO php2.news (id, author_id, title, created_at, source, text) VALUES
  (6, 1, 'В атаках на энергокомпании Украины используется новое вредоносное ПО', '2016-02-02 15:26:56',
   'https://www.anti-malware.ru/news/2016-01-21/17907',
   'Специалисты вирусной лаборатории ESET зафиксировали новую волну кибератак, нацеленную на энергетический сектор Украины. Сценарий практически не отличается от вектора атак с применением вредоносного ПО BlackEnergy в декабре 2015 года. Злоумышленники рассылают по энергетическим предприятиям Украины фишинговые письма от лица компании «Укрэнерго» с вредоносным  документом Excel во вложении.  Документ-приманка содержит вредоносный макрос. Похожий макрос использовался в киберкампании с применением BlackEnergy. Атакующие пытаются убедить жертву игнорировать сообщение безопасности и включить макрос, выводя на экран поддельное сообщение Microsoft Office. Успешное исполнение макроса приводит к запуску вредоносного ПО – загрузчика (downloader), который пытается загрузить с удаленного сервера исполняемый файл и запустить его. Файл находился на украинском сервере, который был демонтирован после обращения специалистов ESET в организации реагирования на компьютерные инциденты CERT-UA и CyS-CERT. В отличие от предыдущих атак на украинские энергетические объекты, злоумышленники использовали не троян BlackEnergy, а другой тип вредоносного ПО. Они выбрали модифицированную версию бэкдора Gcat с открытыми исходными текстами, написанную на скриптовом языке программирования Python.  Gcat позволяет загружать в зараженную систему другие программы и исполнять команды оболочки. Прочие функции бэкдора (создание скриншотов, перехват нажатия клавиш, отправка файлов на удаленный сервер) были удалены. Управление Gcat осуществляется через аккаунт Gmail, что осложняет обнаружение вредоносного трафика в сети.  По мнению вирусного аналитика ESET Роберта Липовски, использование вредоносного ПО с открытым исходным кодом нехарактерно для кибератак, осуществляющихся при поддержке государства (state-sponsored). Эксперт подчеркнул, что «новые данные не проливают свет на источник атак на энергосектор Украины, лишь предостерегают от поспешных выводов».');
INSERT INTO php2.news (id, author_id, title, created_at, source, text) VALUES
  (7, 8, 'Вышел новый Kaspersky Virus Scanner Pro для Mac', '2016-02-02 15:27:49',
   'https://www.anti-malware.ru/news/2016-01-21/17906',
   '«Лаборатория Касперского» представляет новое решение для компьютеров под управлением OS X – Kaspersky Virus Scanner Pro для Mac. Приложение быстро и эффективно проверяет устройство на наличие вредоносного ПО и может удалять обнаруженные угрозы.  За 2015 год продукты «Лаборатории Касперского» заблокировали 3,5 миллиона попыток заражения компьютеров на OS X. Также за этот период эксперты компании обнаружили более 3000 новых вредоносных программ для этой платформы. Однако, согласно опросу «Лаборатории Касперского», меньше половины компьютеров на OS X (46%) защищены специальными решениями. С помощью Kaspersky Virus Scanner Pro для Mac пользователь может проверить свой компьютер на возможные угрозы даже в том случае, если на нем уже установлено другое защитное решение. Приложение ищет на компьютере следы вредоносных программ с помощью различных типов сканирования, которые легко настраиваются внутри продукта. Решение не только подробно информирует пользователя о результатах, но также позволяет удалить различные найденные опасные приложения. Кроме того, приложение автоматически проверяет все новые загруженные пользователем файлы на наличие вредоносного кода.');