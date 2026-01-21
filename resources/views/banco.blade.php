<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bàn cờ {{ $n }} x {{ $n }}</title>
    <style>
        .board {
            display: grid;
            grid-template-columns: repeat({{ $n }}, 50px);
            width: fit-content;
            border: 2px solid #333;
        }

        .cell {
            width: 50px;
            height: 50px;
        }

        .black {
            background-color: #000;
        }

        .white {
            background-color: #fff;
        }
    </style>
</head>

<body>

    <h2>Bàn cờ {{ $n }} × {{ $n }}</h2>

    <div class="board">
        @for ($row = 0; $row < $n; $row++)
            @for ($col = 0; $col < $n; $col++)
                <div class="cell {{ ($row + $col) % 2 == 0 ? 'white' : 'black' }}"></div>
            @endfor
        @endfor
    </div>

</body>

</html>