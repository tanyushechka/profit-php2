<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>php2-lessons</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/App/templates/css/index-view.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">PHP-2</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!--<li>-->
                <!--<a href="index.php">Главная страница</a>-->
                <!--</li>-->
                <li>
                    <a href="/Tests/test.php">Тесты</a>
                </li>
                <!--<li>-->
                <!--<a href="article-view.html">Admin-panel</a>-->
                <!--</li>-->
                <!--<li>-->
                <!--<a href="#">Contact</a>-->
                <!--</li>-->
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-12">

            <h1 class="page-header">
                Админ-панель:
                <small> все новости</small>
            </h1>

            <a href="/admin/edit/" class="btn btn-info active" role="button">Добавить новую новость</a>

            <hr>
            <div class="row">
                <?php if (!empty($news)): ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>created_at</th>
                            <th>source</th>
                            <th>text</th>
                            <th>author</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($news as $row): ?>
                            <tr>
                                <?php foreach ($row as $column): ?>
                                    <td><?= $column ?></td>
                                <?php endforeach; ?>
                                <td>
                                    <a class="btn btn-danger btn-sm" style="margin-right: 20px"
                                       href="/admin/delete/?id=<?php echo $row[0]; ?>">
                                        Удалить </a>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" style="margin-right: 20px"
                                       href="/admin/edit/?id=<?php echo $row[0]; ?>">
                                        Изменить <span class="glyphicon glyphicon-chevron-right"></span></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="alert alert-warning" role="alert">Новостей не найдено</div>
                <?php endif ?>
            </div>

            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; tagedo 2016</p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </footer>

</div>
<!-- /.container -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>
