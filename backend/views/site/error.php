<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = 'Ошибка';
?>
<section class="content">

    <div class="error-page">
        <h2 class="headline text-info"><i class="fa fa-warning text-yellow"></i></h2>

        <div class="error-content">
            <div id="error_messages">
                Данный контен недоступен. Связитесь с администрацией сайта:

                    <div id="error_contacts">
                        <p>тел: +7 929-385-50-50</p>
                        <p>email: axe_dream@list.ru</p>

                    </div>
            </div>
        </div>
    </div>

</section>
<pre>
    <?php var_dump($exception)?>
</pre>
<style type="text/css">
    #error_messages {
        padding-top: 30px;
    }
    #error_contacts {
        text-align: center;
    }
    #error_contacts p {
        margin: 0;
        padding: 0
    }
</style>
