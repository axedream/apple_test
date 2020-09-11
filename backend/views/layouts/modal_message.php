<?php
use yii\bootstrap\Modal;

$script = <<< JS
function message_form(mhead,mbody) {
    $('#message_form').modal().show();
    $(".head_message_form").html(mhead);
    $(".message_text").html(mbody);
}

JS;

$script_after = <<< JS
$(function(){
   
    $(".message_form_close").on('click', function(e){
        $('#message_form').modal('hide');
        e.preventDefault();
    });
});
JS;

$this->registerJs($script, yii\web\View::POS_HEAD);
$this->registerJs($script_after, yii\web\View::POS_READY);

Modal::begin([
    'size' => 'modal_page_size_message_form',
    'header' => '<h2 class="panel-title head_message_form"><div class="message_form_text"></div></h2>',
    'options'=> [
        'id'    =>  'message_form',
    ],
]);
?>
    <style type="text/css">
        .head_message_form {
            padding-top: 5px;
        }
        .modal_page_size_message_form {
            font-family: SourceSansPro !important;
            font-size: 22px !important;
            color: black !important;
        }
        .head_message_form {
            margin-left: 20px;
            font-family: SourceSansPro !important;
            font-size: 19px !important;
        }
        .modal_page .input-group-addon {
            background-color: #007580 !important;
            border-color: #007580 !important;
            color: #ffffff !important;
        }
        .modal_page input {
            border-color: #007580 !important;
        }
        .message_form_close {
            text-align: center;
        }
        .message_text {
            width: 100%;
        }

        @media only screen and (max-width : 768px) {
            .modal_page_size_message_form {
                margin-right: 0px;
                margin-left:  0px;
                font-family: SourceSansPro !important;
                font-size: 17px !important;
            }
        }

        @media only screen and (max-width : 480px) {
            .modal_page_size_message_form {
                margin-right: 0px;
                margin-left:  0px;
                font-family: SourceSansPro !important;
                font-size: 17px !important;
            }
        }
        @media only screen and (max-width : 320px) {
            .modal_page_size_message_form {
                margin-right: 0px;
                margin-left:  0px;
                font-family: SourceSansPro !important;
                font-size: 17px !important;
            }
        }
        .cont_text {
            text-align: center;
        }
        .message_form_text {
            font-weight: 700;
            color: #ff5c04;
            font-size: 22px;
            text-align: center;
        }

    </style>
    <div class="modal_page">
        <div class="container-fluid cont_text">
            <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 recall-box">
                        <form role="form">
                            <div class="input-group input-group-lg message_text text-center">

                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>

<?php
Modal::end();
?>