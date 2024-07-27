<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 確保所有必填欄位都被填寫
    if (empty($_POST['name']) || empty($_POST['order']) || empty($_POST['delivery-location']) || empty($_POST['delivery-time'])) {
        echo "請填寫所有必填欄位！";
        exit();
    }

    // 獲取表單數據
    $name = htmlspecialchars($_POST['name']);
    $order = htmlspecialchars($_POST['order']);
    $delivery_location = htmlspecialchars($_POST['delivery-location']);
    $delivery_time = htmlspecialchars($_POST['delivery-time']); // datetime-local 格式時間
    $notes = htmlspecialchars($_POST['notes']); // 備註可選

    // 將送貨時間轉換為適合檔名的格式 (去除冒號)
    $formatted_delivery_time = str_replace([':', 'T'], ['_', '_'], $delivery_time);

    // 建立訂單資料夾（如果尚未存在）
    $directory = 'Order';
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true); // 0777 為許可權，true 代表遞迴創建資料夾
    }

    // 創建檔案名（顧客姓名_送貨時間.txt）
    $filename = $directory . '/' . $name . '_' . $formatted_delivery_time . '.txt';

    // 建立要寫入檔案的內容
    $data = "顧客姓名: $name\n";
    $data .= "訂單內容: $order\n";
    $data .= "送貨地點: $delivery_location\n";
    $data .= "送貨時間: $delivery_time\n"; // 24小時制的時間
    $data .= "備註: $notes\n";
    $data .= "------------------------\n";

    // 將數據寫入文本檔案
    $file = fopen($filename, "w");
    if ($file) {
        fwrite($file, $data);
        fclose($file);
    } else {
        echo "無法開啟檔案。";
        exit();
    }

    // 重定向到感謝頁面
    header("Location: thank_you.html");
    exit();
} else {
    echo "非法請求方法。";
}
?>
