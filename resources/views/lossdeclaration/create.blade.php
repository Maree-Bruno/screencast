@component('components.layouts.app', ['title'=> 'J’ai perdu mon animal'])
    <h1>Déclaration de perte d'animal</h1>
    <form action="/loss-declaration"
          method="post">
        <?php csrf() ?>
        <fieldset>
            <legend>Vos coordonn&eacute;es</legend>
            <div class="fields">
                <!-- First Name -->
                <div class="field">
                    @component('components.form.input-label', ['name'=>'first-name', 'type'=>'text',
                    'label'=>'Prénom', 'value'=>shell_exec("{\$_SESSION['old']['first-name'] ?? ''}"),
                    'placeholder'=>'Jean'])
                    @endcomponent
                    @if (isset($_SESSION['errors']['first-name']))
                        <div class="error"><p><?= $_SESSION['errors']['first-name'] ?></p></div>

                    @endif
                </div>
                <!-- Last Name -->
                <div class="field">
                    @component('components.form.input-label', ['name'=>'last-name', 'type'=>'text',
                    'label'=>'Nom', 'value'=>shell_exec("{\$_SESSION['old']['last-name'] ?? ''}"),
                    'placeholder'=>'Valjean'])
                    @endcomponent
                    @if (isset($_SESSION['errors']['last-name']))
                        <div class="error"><p><?= $_SESSION['errors']['last-name'] ?></p></div>
                    @endif
                </div>
                <!-- Email field -->
                <div class="field">
                    @component('components.form.required-input-label', ['name'=>'email', 'type'=>'email',
                   'label'=>'Email', 'value'=>shell_exec("{\$_SESSION['old']['email'] ?? ''}"),
                   'placeholder'=>'jean@valjean.net'])
                    @endcomponent
                    @if (isset($_SESSION['errors']['email']))
                        <div class="error"><p><?= $_SESSION['errors']['email'] ?></p></div>
                    @endif
                </div>
                <!-- Email verification -->
                <div class="field">
                    @component('components.form.required-input-label', ['name'=>'vemail', 'type'=>'vemail',
                 'label'=>'Vérification de l’email', 'value'=>shell_exec("{\$_SESSION['old']['vemail'] ?? ''}")])
                    @endcomponent
                    @if (isset($_SESSION['errors']['vemail']))
                        <div class="error"><p><?= $_SESSION['errors']['vemail'] ?></p></div>
                    @endif

                </div>
                <!-- Phone number -->
                <div class="field">

                    @component('components.form.required-input-label', ['name'=>'phone', 'type'=>'phone',
                   'label'=>'Téléphone', 'value'=>shell_exec("{\$_SESSION['old']['phone'] ?? ''}"),
                   'placeholder'=>'+32 (0)4 279 75 01'])
                    @endcomponent

                    @if (isset($_SESSION['errors']['phone']))
                        <div class="error"><p><?= $_SESSION['errors']['phone'] ?></p></div>
                    @endif

                </div>
                <!-- Country -->
                <div class="field">
                    @component('components.form.select', ['name'=>'country', 'label'=>'Pays'])
                        @foreach ($countries as $country)
                            <option value="<?= $country->code ?>"
                                    @if (isset($_SESSION['old']['country']) && $country->code ===
                                    $_SESSION['old']['country'])
                                        selected
                                    @endif
                            ><?= COUNTRIES[$country->code] ?></option>
                        @endforeach
                    @endcomponent
                    @if (isset($_SESSION['errors']['country']))
                        <div class="error"><p><?= $_SESSION['errors']['country'] ?></p></div>
                    @endif
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Description de l&rsquo;animal disparu</legend>
            <div class="fields">
                <!-- Pet Type -->
                <div class="field">
                    @component('components.form.select', ['name'=>'$pet_type', 'label'=>'Type d&rsquo;animal'])
                        @foreach ($pet_types as $type)
                            <option value="<?= $type->code ?>"
                                    @if (isset($_SESSION['old']['pet-type']) && $type->code === $_SESSION['old']['pet-type'])
                                        selected
                                    @endif
                            ><?= PET_TYPES[$type->code] ?></option>
                        @endforeach
                    @endcomponent
                    @if (isset($_SESSION['errors']['pet-type']))
                        <div class="error"><p><?= $_SESSION['errors']['pet-type'] ?></p></div>
                    @endif
                </div>
                <!-- Pet Name -->
                <div class="field">
                    @component('components.form.required-input-label', ['name'=>'pet-name', 'type'=>'text',
                  'label'=>'&nbsp;Nom de l&rsquo;animal', 'value'=>shell_exec("{\$_SESSION['old']['pet-name'] ?? ''}"),
                  'placeholder'=>'Rex'])
                    @endcomponent
                    @if (isset($_SESSION['errors']['pet-name']))
                        <div class="error"><p><?= $_SESSION['errors']['pet-name'] ?></p></div>
                    @endif
                </div>
                <!-- Pet chip -->
                <div class="field">
                    @component('components.form.required-input-label', ['name'=>'pet-chip', 'type'=>'text',
                 'label'=>'&nbsp;Puce', 'value'=>shell_exec("{\$_SESSION['old']['pet-chip'] ?? ''}")])
                    @endcomponent
                    @if (isset($_SESSION['errors']['pet-chip']))
                        <div class="error"><p><?= $_SESSION['errors']['pet-chip'] ?></p></div>
                    @endif
                </div>
                <!-- Pet Gender -->
                <div class="field row-radio">
                    <p>Sexe</p>
                    @component('components.form.radio-input', ['name'=>'pet-gender', 'id'=>'pet-gender-female',
                    'value'=> 'Femelle'])
                    @endcomponent
                    @component('components.form.radio-input', ['name'=>'pet-gender', 'id'=>'pet-gender-male',
                                        'value'=> 'Male'])
                    @endcomponent

                    @if (isset($_SESSION['errors']['pet-gender']))
                        <div class="error"><p><?= $_SESSION['errors']['pet-gender'] ?></p></div>
                    @endif
                </div>
                <!-- Pet Age -->
                <div class="field">
                    @component('components.form.input-label', ['name'=>'pet-age', 'type'=>'number',
                  'label'=>'&Acirc;ge de l&rsquo;animal','text'=>'Approximativement en ann&eacute;es', 'value'=>shell_exec("{\$_SESSION['old']['pet-age'] ??
                  ''}"),
                  'placeholder'=>'5'])
                    @endcomponent
                    @if (isset($_SESSION['errors']['pet-age']))
                        <div class="error"><p><?= $_SESSION['errors']['pet-age'] ?></p></div>
                    @endif
                </div>
                <!-- Pet Race -->
                <div class="field">
                    @component('components.form.input-label', ['name'=>'pet-race', 'type'=>'text',
                    'label'=>'Race de l&rsquo;animal', 'value'=>shell_exec("{\$_SESSION['old']['pet-race'] ?? ''}"),
                    'placeholder'=>'Caniche'])
                    @endcomponent
                    @if (isset($_SESSION['errors']['pet-race']))
                        <div class="error"><p><?= $_SESSION['errors']['pet-race'] ?></p></div>
                    @endif
                </div>
                <!-- Pet tatoo -->
                <div class="field row-radio">
                    @component('components.form.select', ['name'=>'pet-tatoo-location', 'label'=>'Tatouage'])
                        <option value="0">Pas de tatouage</option>
                        <option value="left-ear">Oreille gauche</option>
                        <option value="right-ear">Oreille droite</option>
                        <option value="mouth">Bouche</option>
                    @endcomponent
                    @component('components.form.input-label', ['name'=>'pet-tatoo', 'type'=>'text',
                    'label'=>'code','value'=>shell_exec("{\$_SESSION['old']['pet-tatoo'] ??''}"), 'placeholder'=>'898HH0'])
                    @endcomponent
                    @if (isset($_SESSION['errors']['pet-tatoo']))
                        <div class="error"><p><?= $_SESSION['errors']['pet-tatoo'] ?></p></div>
                    @endif
                </div>
                <!-- Pet Description -->
                <div class="field">
                    @component('components.form.textarea', ['name'=>'pet-description', 'row'=> '10',
                    'label'=>'Description / Signes particuliers', 'placeholder'=>shell_exec("{\$_SESSION['old']['pet-description'] ?? '' }")])
                    @endcomponent
                    @if (isset($_SESSION['errors']['pet-description']))
                        <div class="error"><p><?= $_SESSION['errors']['pet-description'] ?></p></div>
                    @endif
                </div>
                <!-- Pet Picture -->
                <div class="field">
                    @component('components.form.input-label',['type'=>'file', 'name'=>'pet-picture', 'label'=>'Photo de l&rsquo;animal'])
                    @endcomponent
                    @if (isset($_SESSION['errors']['pet-picture']))
                        <div class="error">
                            <p><?= $_SESSION['errors']['pet-picture'] ?></p>
                        </div>

                    @elseif (!empty($_SESSION['errors']))
                        <div class="error">
                            <p>Il faut res&eacute;lectionner l&rsquo;image que vous aviez choisie, sinon, elle sera
                                perdue.</p>
                        </div>
                    @endif
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Date et localit&eacute; de la disparition</legend>
            <div class="fields">
                <!-- Date field -->
                <div class="field">
                    @component('components.form.required-input-label', ['name'=>'disparition-date', 'type'=>'date',
                   'label'=>'Date de la disparition','text'=>'Ann&eacute;e/mois/jour ou s&eacute;lection dans le calendrier', 'value'=>shell_exec
                   ("{\$_SESSION['old']['disparition-date'] ??''}")])
                    @endcomponent
                    @if (isset($_SESSION['errors']['disparition-date']))
                        <div class="error"><p><?= $_SESSION['errors']['disparition-date'] ?></p></div>
                    @endif
                </div>
                <!-- Disparition time -->
                <div class="field">
                    @component('components.form.input-label', ['name'=>'disparition-time', 'type'=>'time',
                'label'=>'Heure','text'=>'Heures:minutes ou s&eacute;lection de l&rsquo;heure', 'value'=>shell_exec
                ("{\$_SESSION['old']['disparition-time'] ??''}")])
                    @endcomponent
                    @if (isset($_SESSION['errors']['disparition-time']))
                        <div class="error"><p><?= $_SESSION['errors']['disparition-time'] ?></p></div>
                    @endif
                </div>
                <!-- Disparition postal code -->
                <div class="field">
                    @component('components.form.required-input-label', ['name'=>'disparition-postal-code',
                    'type'=>'number','label'=>'Code postal','minLenght'=>'4','maxLenght'=>'5', 'placeholder'=>'4000','value'=>shell_exec("{\$_SESSION['old']['disparition-postal-code'] ??''}")])
                    @endcomponent
                    @if (isset($_SESSION['errors']['disparition-postal-code']))
                        <div class="error"><p><?= $_SESSION['errors']['disparition-postal-code'] ?></p></div>
                    @endif
                </div>
                <!-- Disparition Country -->
                <div class="field">
                    @component('components.form.select', ['name'=>'disparition-country', 'label'=>'Pays'])
                        @foreach ($countries as $country)
                            <option value="<?= $country->code ?>"
                                    @if (isset($_SESSION['old']['disparition-country']) && $country->code === $_SESSION['old']['disparition-country'])
                                        selected
                                    @endif
                            ><?= COUNTRIES[$country->code] ?></option>
                        @endforeach;
                    @endcomponent
                    @if (isset($_SESSION['errors']['disparition-country']))
                        <div class="error"><p><?= $_SESSION['errors']['disparition-country'] ?></p></div>
                    @endif
                </div>
            </div>
        </fieldset>
        @component('components.form.button', ['type'=>'submit'])
            D&eacute;clarer la perte de mon animal
        @endcomponent
    </form>
@endcomponent