<?php

echo '<a href="/Tests/users-findAll.php">Выбрать всех пользователей</a><br>';
echo '<a href="/Tests/news-findAll.php">Выбрать все новости</a><br>';
echo '<a href="/Tests/news-findById.php?id=3">Выбрать новость по id</a><br>';
echo '<a href="/Tests/news-delete.php?id=3">Выбрать новость по id и удалить</a><br>';
echo '<a href="/Tests/news-findLatest.php?limit=3">Выбрать последние новости в количестве limit</a><br>';

echo 'Сохранить новую новость:<br>';
echo '<a href="/Tests/news-save.php?title=\'Заголовок новой новости\'&text=&source=">Сохранить новую новость</a><br>';
echo '<a href="/Tests/ob.php">Тестирование output buffer</a><br>';
