<style>
    .remindModal {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        display: none;
        overflow: auto;
        background-color: #000000;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 9999;
    }

    .remindModal-window {
        position: relative;
        background-color: #FFFFFF;
        width: 50%;
        margin: 10% auto;
        padding: 20px;
    }

    .remindModal-window.small {
        width: 30%;
    }

    .remindModal-window.large {
        width: 75%;
    }

    .close {
        position: absolute;
        top: 0;
        right: 0;
        color: rgba(0,0,0,0.3);
        height: 30px;
        width: 30px;
        font-size: 30px;
        line-height: 30px;
        text-align: center;
    }

    .close:hover,
    .close:focus {
        color: #000000;
        cursor: pointer;
    }

    .open {
        display: block;
    }
    .remindModal button {
        position: absolute;
        right: 10px;
        bottom: 10px;
        padding: 7px;
        font-size: 12px;
        background: indianred;
        color: #FFF;
        border: none;
        cursor: pointer;
    }
    .remindModal h4 {
        font-weight:bold;
        margin-top: 0;
    }
    .remindModal p {
        font-size: 14px;
        width: 80%;
        margin: 15px;
    }
</style>
<script>
    window.onload = function() {
        document.addEventListener('click', function (e) {
            e = e || window.event;
            var target = e.target || e.srcElement;

            e.preventDefault();

            if (target.hasAttribute('data-toggle') && target.getAttribute('data-toggle') == 'remindModal') {
                if (target.hasAttribute('data-target')) {
                    var m_ID = target.getAttribute('data-target');
                    document.getElementById(m_ID).classList.add('open');
                }
            }

            // Close remindModal window with 'data-dismiss' attribute or when the backdrop is clicked
            if ((target.hasAttribute('data-close') && target.getAttribute('data-close') == 'remindModal') || target.classList.contains('remindModal')) {
                var remindModal = document.querySelector('[class="remindModal open"]');
                remindModal.classList.remove('open');
                window.location.reload();
            }
        }, false);
    }
</script>
<?php
$title = 'Напоминание по объекту #' . $objectId . ' (' . $objectName . ')';
?>
<div class="remindModal open">
    <div class="remindModal-window small">
        <span class="close" data-close="remindModal">&times;</span>
        <h4><?=\Lema\Common\Helper::enc($title);?></h4>
        <p><?=nl2br(\Lema\Common\Helper::enc($text));?></p>
        <br>
        <button data-close="remindModal">Закрыть</button>
    </div>
</div>