<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/index.css') }}" rel="stylesheet">



<form action="{{ route('registration.submit') }}" method="post">
    @csrf
    <div class="container">
        <div class="title">
            <p>Заполнить анкету</p>
        </div>
        <div class="user-name">
            <div class="user-name__text">
                <p>Введите ФИО:</p>
            </div>
            <div class="user-name__main">
                <img class="user-name__img" src="{{ asset('img/Profile.svg') }}" alt="profile">
                <input class="user-name__input" type="text" name="full_name" id="full_name" required placeholder="">
            </div>
        </div>
        <div class="user-mail">
            <div class="user-mail__text">
                <p>Введите почту:</p>
            </div>
            <div class="user-mail__main">
                <img class="user-mail__img" src="img/Send.svg" alt="send">
                <input class="user-mail__input" type="email" name="email" id="email" required>
            </div>
        </div>
        <button class="btn" type="submit">
            Далее
        </button>
    </div>
</form>
