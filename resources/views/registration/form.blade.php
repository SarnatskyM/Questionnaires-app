<form action="{{ route('registration.submit') }}" method="post">
    @csrf
    <label for="full_name">ФИО:</label>
    <input type="text" id="full_name" name="full_name" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <button type="submit">Зарегистрироваться</button>
</form>
