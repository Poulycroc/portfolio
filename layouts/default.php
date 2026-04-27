<html>
  <head>
    <title><?= relay('title') ?? SITE; ?></title>
    <?= STYLES; ?>
  </head>
  <body>
      <?= CONTENT; ?>
      <aside>
        <?= relay('sidebar') ?>
      </aside>
      <?= SCRIPTS; ?>
  </body>
</html>
