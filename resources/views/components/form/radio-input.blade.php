<input type="radio"
       name="{{$name}}"
       id="{{$id}}"
       value="{{$value}}"
       <?php
       if (isset($_SESSION['old']['{{$name}}']) && $_SESSION['old']['{{$name}}'] === '{{$value}}') : ?>
       checked
    <?php
    endif ?>
><label for="{{$id}}">{{$value}}</label>