<div class="message">
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <p>Внимание! Произошли ошибки операции.</p>
        </div>
    @endif
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
</div>
<script>
    $(document).ready(function () {
        var success =  $('.message').find('.alert');
        success.effect( 'bounce', 'slow');
        success.fadeOut(7000);
    });
</script>