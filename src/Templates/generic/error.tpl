{include file='include/header.tpl'}
<div class="container">
    <h1>{APP_NAME}</h1>
    <hr>
    <div>
        <h3>Error {$error_code}{if $error_text} - {$error_text}{/if}</h3>
    </div>
</div>
{include file='include/footer.tpl'}