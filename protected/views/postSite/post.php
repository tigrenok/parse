<?php
$this->breadcrumbs = array(
    'Post Sites',
);
?>

<h1>Сайты для постинга</h1>
<?php if(!empty($model)):?>
<pre>
    <?php
    var_dump($model);
    ?>
</pre>
<?php else:?>
Ошибка постинга!
<?php endif; ?>
