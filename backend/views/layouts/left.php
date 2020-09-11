<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Яблочное дерево', 'icon' => 'building', 'url' => ['/apple/index']],
                ]
            ]
        ) ?>

    </section>

</aside>
