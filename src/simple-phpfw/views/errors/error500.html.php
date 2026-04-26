<?= $this->render('errors.begin') ?>

<h2>500 Error</h2>
<?= $this->render('errors.partials.trace', $data) ?>

<?= $this->render('errors.end') ?>