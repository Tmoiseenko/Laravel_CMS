# Laravel CMS

Необходимо разработать сайт на Laravel, состоящий из следующих страниц:

- Главная — адрес страницы /.
- О нас — адрес страницы /about.
- Контакты — адрес страницы /contacts.
- Страница добавления новой статьи — адрес страницы /articles/create.
- Детальная страница статьи — адрес страницы /articles/{slug} (slug — символьный код статьи).
- Список обращений — адрес страницы /admin/feedback.


## Состав страниц

### Главная
На этой странице выводится список опубликованных статей в порядке убывания даты создания. В каждом элементе выводятся его название, краткое описание и дата публикации.

### Детальная страница статьи
На этой странице выводятся: название, дата создания, подробный текст статьи и ссылка на главную страницу со списком статей.

### Страница создания статьи
Выводится форма для создания статьи со следующими полями и правилами валидации:
Символьный код — обязательное текстовое поле, должно состоять только из латинских символов, цифр и символов тире и подчеркивания. Должно быть уникальным на все статьи: нельзя создать две статьи с одинаковым символьным кодом.
Название статьи — обязательное текстовое поле не менее 5 и не более 100 символов.
Краткое описание статьи — обязательное текстовое поле не более 255 символов.
Детальное описание — обязательное текстовое поле.
Опубликовано — чекбокс.

### Контакты
На этой странице выводится форма для создания статьи со следующими полями и правилами валидации:
Email — обязательное поле.
Сообщение — обязательное поле.

### Список обращений
На этой странице выводится список сообщений, оставленных в форме обратной связи в виде простой таблицы. Список отсортирован по убыванию даты получения сообщения. В таблице выводится три колонки: email, сообщение, дата получения.

### Доработка механизма управления статьями
Сделайте из статей полноценный ресурс, добавьте возможность изменения и удаления статьи, а также реализуйте показ всплывающих уведомлений о том, что изменения прошли успешно.
Поля формы создания и редактирования статьи одинаковые, это уже созданные вами ранее поля:
Символьный код — обязательное текстовое поле, должно состоять только из латинских символов, цифр и символов тире и подчеркивания. Должно быть уникальным на все статьи: нельзя создать две статьи с одинаковым символьным кодом.
Название статьи — обязательное текстовое поле не менее 5 не более 100 символов.
Краткое описание статьи — обязательное текстовое поле не более 255 символов.
Детальное описание — обязательное текстовое поле.
Опубликовано — чекбокс.

### Оптимизация валидации
Для организации правильной валидации создайте отдельный класс FormRequest и примените его как при создании, так и при обновлении статьи.
Внутри этого класса вы сможете реализовать логику корректировки правила валидации уникального символьного кода, ведь если статья уже существует, то нужно исключить ее из проверки на уникальность. Сделайте это исключение, убедившись с помощью готовых методов класса FormRequest, что в текущем запросе статья передана в качестве параметра запроса.

### Оптимизация форм управления статьями
Так как набор полей одинаков и для формы создания, и для формы редактирования, этот набор полей правильно вынести в отдельный blade-шаблон. Вынесите поля формы в такой шаблон и подключите его и в форме создания, и в форме редактирования статьи.

### Тегирование

### Реализуйте функционал тегов к статьям на сайте.

### Привязка тегов
Добавьте возможность привязывать к статье любое количество тегов. При этом теги можно указывать как в форме создания, так и в форме редактирования статьи.

### Облако тегов
В боковой колонке сайта должно отображаться облако тегов, а при переходе на тег — список статей, привязанных к этому тегу.

### Оптимизация кода работы с тегами.
Код для привязки тегов при создании и при обновлении статьи будет очень похож. Поэтому вынесите эту обработку в отдельный класс-сервис. Полное имя класса должно быть: App\Services\TagsSynchronizer.
У этого класса должен быть метод:
public function sync(Collection $tags, Model $model)
- $tags — объект-коллекция с тегами, в виде строк, которые должны быть привязаны к модели.
- $model — объект модели, к которой нужно привязать теги.
  Внедрите этот сервис в нужные методы контроллеров с помощью Автоматического разрешения зависимостей (Dependency Injection) и используйте его для сохранения тегов статьи.

### Реализуйте авторизацию

Реализуйте стандартные страницы: Авторизация, Регистрация, Восстановление пароля.
Метод, продемонстрированный в уроках, актуален только для Laravel 5, для версий 6+ выберите следующий вариант:
- для простого создания авторизации как в уроке вы можете использовать пакет (рекомендуется): laravel/ui;
- также вы можете использовать пакет для реализации авторизации: laravel/fortify;
- или его реализацию вместе с ui: zacksmash/fortify-ui.

### Уровни доступа
Реализуйте ограничение доступов на создание и изменение задач. Теперь только авторизованный пользователь может добавлять статьи на сайт и только пользователь, который написал статью, может её изменить или удалить.

### Уведомления
После создания, изменения и удаления статьи отправляйте почтовое уведомление администратору сайта (email указывается в конфигурации).
В уведомлении должна быть указана статья, текст, содержащий вид произошедшего события (статья создана, изменена, удалена) и дана ссылка на эту статью, если она не удалена.

## Администрирование

Добавьте модель «Роль» на проект. Создайте новую роль — «Администратор». Сделайте так, чтобы только администратор мог войти в административный раздел.
Добавьте ссылку в меню на страницу административного раздела и отображайте её только администраторам. Для этого используйте свою условную blade-директиву @admin.

### Администрирование статей

Реализуйте раздел управления статьями в административном разделе. В нём должны отображаться все статьи.
Администратор в этом разделе может изменить любую статью, опубликовать или снять с публикации.
В публичной части сайта в списке или на детальной странице сделайте так, чтобы отображались только опубликованные статьи. При этом автор статьи или администратор могут зайти на детальную страницу даже неопубликованной статьи.
На детальной странице статьи добавьте ссылку на редактирование этой статьи (для администратора это должна быть ссылка в административный раздел).

### Создание Админа
Создайте новую миграцию, в которой будете создавать предустановленного администратора сайта. Email администратора должен задаваться отдельной конфигурацией.

### Предустановленные данные
- Создайте фабрики моделей на вашем сайте.
- Реализуйте Seeder, с помощью которого создайте минимум двух пользователей и не менее 20 статей, разделённых между ними. У статей должны быть теги, и должны быть статьи c совпадающими тегами.

### Рассылка
- Реализуйте команду, которая рассылает всем пользователям сообщение о новых статьях за период, указанный в аргументах этой команды. Команда должна рассылать все статьи, опубликованные за период.
- Установите задачу, используя компонент Расписание, отправлять рассылку со всеми опубликованными за неделю новостями каждый понедельник, час выберите сами.

### Комментирование
Добавьте возможность создавать комментарии к статьям. Комментарии реализуйте простые, одноуровневые, без модерации. Оставить комментарий может любой авторизованный пользователь.
У каждого комментария должны отображаться дата, автор и текст.

### История изменений
Реализуйте сохранение истории изменений статьи. Записывайте автора изменений, дату изменения и какие поля были изменены.

### Новости
Добавьте новый раздел на сайте — «Новости». В нём создайте список новостей и детальную страницу каждой новости.
Также создайте административный раздел, в котором можно создавать и управлять новостями.

### Постраничная навигация
Реализуйте постраничную навигацию статей и новостей в публичной части сайта. Выводите по 10 элементов на странице.
Реализуйте постраничную навигацию в административном разделе для статей и новостей. Выводите по 20 элементов на странице.

### Тегирование
Реализуйте возможность привязывать теги к любым моделям (полиморфные связи).
Добавьте возможность указывать теги для новостей.
На странице создания и редактирования новости примените созданный ранее сервис для сохранения и привязки тегов.
На странице отображения по тегам теперь видны и новости, и статьи двумя отдельными списками без постраничной навигации. При этом отображаются только эти две модели.  Если привязать теги ещё и, например, к пользователям, то они не должны появиться на этой странице.


### Комментарии к новостям
К новостям теперь также можно добавить комментарии с теми же правилами, что и к статьям.

### Статистика портала
Добавьте на сайт страницу, в которой отображается любопытная статистика на сайте. Для её реализации используйте Eloquent-модели и методы связей между ними, а также компонент Query Builder.Старайтесь не применять методы коллекций там, где можно обойтись без них (почти во всех пунктах статистики ниже).
- Общее количество статей.
- Общее количество новостей.
- ФИО автора, у которого больше всего статей на сайте.
- Самая длинная статья — название, ссылка на статью и длина статьи в символах.
- Самая короткая статья — название, ссылка на статью и длина статьи в символах.
- Средние количество статей у активных пользователей (пользователь считается активным, если у него более 1 статьи).
- Самая непостоянная — название, ссылка на статью, которую меняли больше всего раз.
- Самая обсуждаемая статья — название, ссылка на статью, у которой больше всего комментариев.
- Можете придумать и другие статистические выкладки, которые можно сформировать одним запросом с помощью компонента Query Builder.

### Очередь

Добавьте в административном разделе раздел «Отчёты». Добавьте в нём отдельную ссылку на отчёт «Итого».
На странице создания этого отчёта должен выводиться выпадающий список с возможностью множественного выбора (или группа чекбоксов, как вам покажется удобнее).
Внутри этого списка администратор может выбрать, что посчитать на вашем сайте: новости, статьи, комментарии, теги, пользователей.
После выбора необходимой комбинации администратор нажимает на кнопку «Сгенерировать отчёт» и этим запускает процесс генерации отчёта.
Отчёт должен быть сгенерирован в фоновом режиме (используйте очередь и класс работы Job) и отправлен на почту запросившему его администратору. В отчёте должна быть следующая информация: количество элементов для каждого выбранного типа.
Например, если выбрать галочками «Новости» и «Теги», в сообщении-отчёте должно быть содержимое такого вида:

Новостей: 3
Тегов: 13
Вы можете сгенерировать файл .pdf или .xlsx (используйте готовые решения), но это не обязательно в этом задании.

### Web-Socket
Подключите администраторов к отдельному web-socket — каналу уведомлений.
Каждый раз, когда на сайте происходит изменение статьи, отправляйте в этот канал следующую информацию:
- какая статья была изменена,
- какие поля были изменены,
- ссылку на эту статью.
  При получении такого сообщения покажите всплывающее уведомление всем подписчикам этого канала, внутри которого будет выведена вся полученная информация.

### Кеширование
Проведите оптимизацию проекта — реализуйте кеширование информации на всех списках и детальных страницах вашего сайта. Не забудьте про раздел со статистикой и облако тегов.
Кеш должен сбрасываться сразу при изменении соответствующих элементов. Например, если изменить/добавить/удалить новость, то должен сброситься кеш на всех страницах, где могла быть задействована эта новость.
Для реализации сброса кеша используйте тегированный кеш.

------------

## Установка и настройка проекта

- git clone https://github.com/Tmoiseenko/Laravel_CMS.git
- cd to the app directory
- cp .env.example .env or windows command copy .env.example .env
- update the .env database connection
- composer install
- php artisan key:generate
- php artisan migrate or if you want use demo data, use command with key --seed
- login and password you may find in migration fails
