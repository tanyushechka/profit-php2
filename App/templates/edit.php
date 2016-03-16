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
                <li>
                    <a href="/admin/all/">Админ-панель</a>
                </li>
                <li>
                    <a href="/Tests/test.php">Тесты</a>
                </li>
                <!--<li>-->
                <!--<a href="#">Services</a>-->
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
                Страница редактирования:
                <small> создание / редактирование новости</small>
            </h1>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php if (!empty($errors)) : ?>
                            <?php foreach ($errors as $error) : ?>
                                <p>
                                    <?php echo $error->getMessage(); ?>
                                </p>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <form action="/admin/edit/" method="post" class="form">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span
                                                    class="glyphicon glyphicon-file">
                            </span>EDIT ARTICLE</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Title</span>
                                                        <input name="title" type="text" class="form-control"
                                                               placeholder="Title"
                                                               value="<?php echo $article->title; ?>">
                                                    </div>
                                                    <br>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Author</span>
                                                        <select class="form-control" name="author_id">
                                                            <option></option>
                                                            <?php
                                                            foreach ($authors as $author): ?>
                                                                <option
                                                                    value="<?= $author->id ?>" <?= $author->id === $article->author_id ? 'selected' : '' ?>><?= $author->name ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                    <textarea name="text" class="form-control" placeholder="Text"
                                                              rows="15"><?php echo $article->text; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="well well-sm">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Source</span>
                                                            <input name="source" type="text" class="form-control"
                                                                   placeholder="Custom url"
                                                                   value="<?php echo $article->source; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="well well-sm well-primary">
                                                        <div class="input-group">
                                                            <input name="created_at" type="text" class="form-control"
                                                                   style="width: 40%; margin-right: 3%;"
                                                                   value="<?php echo $article->created_at; ?>"
                                                                   placeholder="Date">

                                                            <input name="id" type="text" class="form-control"
                                                                   value="<?php echo $article->id; ?>"
                                                                   style="display: none;"
                                                            >

                                                                <button type="submit" class="btn btn-success btn-sm"
                                                                        style="margin-right: 3%;">
                                                                    Save
                                                                </button>
                                                            <button type="reset" class="btn btn-warning btn-sm"
                                                                    style="margin-right: 3%;">
                                                                    Reset
                                                                </button>
                                                            <a href="/admin/delete/?id=<?php echo $article->id; ?>"
                                                               class="btn btn-danger btn-sm active"
                                                               role="button">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


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
