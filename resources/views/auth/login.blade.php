@component('layouts.app')
    <h1>Identifiez-vous !</h1>
    <form action="/login" method="post">
        <?php csrf() ?>
        <fieldset>
            <div class="fields">
                <div class="field">
                    @component('components.form.required-input-label', ['name'=>'email', 'type'=>'email',
                   'label'=>'Email', 'value'=>shell_exec("{\$_SESSION['old']['email'] ?? ''}"),
                   'placeholder'=>'jean@valjean.net'])
                    @endcomponent
                    @if (isset($_SESSION['errors']['email']))
                        <div class="error"><p><?= $_SESSION['errors']['email'] ?></p></div>
                    @endif
                </div>
                <div class="field">
                    @component('components.form.required-input-label', ['name'=>'password', 'type'=>'password',
                   'label'=>'Password'])
                    @endcomponent
                    @if (isset($_SESSION['errors']['password']))
                        <div class="error"><p><?= $_SESSION['errors']['password'] ?></p></div>
                    @endif
                </div>
            </div>
        </fieldset>
        @component('components.form.button', ['type'=>'submit'])
            Identifiez-vous
        @endcomponent
    </form>
@endcomponent