<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/choice.css') }}" rel="stylesheet">

<div class="container">
    <div class="title">
        <p>Select a test</p>
    </div>
    <div class="main">
        <select id="testDropdown" class="dropdown">
            @foreach ($tests as $test)
                <option class="dropdown-item" value="{{ route('test.show', $test) }}">
                    {{ $test->title }}
                </option>
            @endforeach
        </select>
    </div>
    <button id="nextButton" class="btn">
        <p>Next</p>
    </button>
</div>

<script>
    document.getElementById('nextButton').addEventListener('click', function() {
        var select = document.getElementById('testDropdown');
        var selectedOption = select.options[select.selectedIndex];
        var route = selectedOption.value;
        window.location.href = route;
    });
</script>
