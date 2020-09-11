<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>
<div class="content-wrapper">
    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs"><b>Version</b> 1.0</div>
    <div style="text-align: center;"><strong>Copyright &copy; 2020 AXE_DREAM</strong> All rights reserved.</div>
</footer>