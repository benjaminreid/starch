<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?= $charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?= $title ?></title>
    <meta name="description" content="<?= $description ?>">

    <link rel="stylesheet" href="<?= ASSETS; ?>css/css.css">
    <meta name="viewport" content="width=device-width">

    <link rel="shortcut icon" href="<?= ASSETS; ?>favicon.ico" />
    <link rel="apple-touch-icon" href="<?= ASSETS; ?>apple-touch-icon.png" />

    <?php wp_head(); ?>
</head>
<body id="<?= $id ?>" class="<?= $class ?>">
    <?= $content ?>

    <?php wp_footer(); ?>
</body>
</html>