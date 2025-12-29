<?php
// ---------- Налаштування ----------
$historyFile = "history.txt";
$result = "";
$error = "";

// ---------- Обробка форми ----------
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $a = $_POST["a"] ?? "";
    $b = $_POST["b"] ?? "";
    $op = $_POST["op"] ?? "";

    if (!is_numeric($a) || !is_numeric($b)) {
        $error = "Будь ласка, введіть два числа.";
    } else {
        $a = (float)$a;
        $b = (float)$b;

        switch ($op) {
            case "+":
                $result = $a + $b;
                break;
            case "-":
                $result = $a - $b;
                break;
            case "*":
                $result = $a * $b;
                break;
            case "/":
                if ($b == 0) {
                    $error = "Ділення на нуль заборонене.";
                } else {
                    $result = $a / $b;
                }
                break;
            default:
                $error = "Оберіть операцію.";
        }

        // ---------- Запис в історію ----------
        if ($error === "") {
            $line = date("Y-m-d H:i:s") . " | $a $op $b = $result\n";
            file_put_contents($historyFile, $line, FILE_APPEND);
        }
    }
}

// ---------- Зчитування історії ----------
$history = [];
if (file_exists($historyFile)) {
    $history = file($historyFile, FILE_IGNORE_NEW_LINES);
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>ЛР №4</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
        }
        .box {
            background: #fff;
            padding: 20px;
            width: 420px;
            margin: 40px auto;
            border: 1px solid #ccc;
        }
        h2 {
            margin-top: 0;
        }
        input[type="number"] {
            width: 120px;
        }
        .result {
            margin-top: 10px;
            font-weight: bold;
        }
        .error {
            color: red;
        }
        .history {
            margin-top: 20px;
            font-size: 14px;
        }
        .history ul {
            padding-left: 20px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Калькулятор</h2>

    <form method="post">
        <input type="number" step="any" name="a" required>
        
        <label><input type="radio" name="op" value="+" required> +</label>
        <label><input type="radio" name="op" value="-"> −</label>
        <label><input type="radio" name="op" value="*"> *</label>
        <label><input type="radio" name="op" value="/"> /</label>

        <input type="number" step="any" name="b" required>

        <br><br>
        <button type="submit">Обчислити</button>
    </form>

    <?php if ($result !== ""): ?>
        <div class="result">Результат: <?= $result ?></div>
    <?php endif; ?>

    <?php if ($error !== ""): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <div class="history">
        <h3>Історія обчислень</h3>

        <?php if (empty($history)): ?>
            <p>Історія порожня.</p>
        <?php else: ?>
            <ul>
                <?php foreach (array_reverse($history) as $line): ?>
                    <li><?= htmlspecialchars($line) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
