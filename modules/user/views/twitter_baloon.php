<div class="sinhro_twiter">
        <p>Синхронизируя свой микроблогинг с вашим твитер акаунтом, ваш статус на проекте Yapidoo будет меняться автоматически при изменении его в твитере и использовании хеш-тега #yapidoo.<br /><br />
        И в твитере будет изменяться при добавлении мысли на Yapidoo.</p>
        <br />
        <?php if($redirect_url): ?>
        <form name="twitter_sync" class="loginform" method="post" action="<?php echo $redirect_url ?>">
        <? endif; ?>
            <a href="javascript: void(0)" onclick="<?php echo $redirect_url ? 'document.twitter_sync.submit()' : 'stopTwitterSync()' ?>" class="but_green2">
        	    <em class="l"></em>
        	    <em class="r"></em>
        	    <span>
                <?php if($redirect_url): ?>
                    Синхронизировать
                <?php else: ?>
                    Прекратить синхронизацию
                <?php endif; ?>
                </span>
            </a>
        <?php if($redirect_url): ?>
        </form>
        <?php endif; ?>
</div>

<?php if(!$redirect_url): ?>
<script type="text/javascript">
    function stopTwitterSync(){
        $.ajax({
            url: "/user/stopTwitterSync",
            success: function(){
                $(document).trigger("close.facebox");
                return false;
            }
       });
    } 
</script>
<?php endif; ?>