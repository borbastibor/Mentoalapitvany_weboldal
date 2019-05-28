<?php
$sqlstmt = $dbcon->prepare("SELECT msgsendername,msgsenderemail,msgtext FROM messages");
try {
    $sqlstmt->execute();
    ?>
    <table>
        <tr>
            <th>Üzenetküldő neve</th>
            <th>Üzenetküldő e-mail címe</th>
            <th>Üzenet</th>
        </tr>
    <?php
    foreach($sqlstmt->fetchAll(PDO::FETCH_ASSOC) as $row) : ?>
        <tr>
            <td><?php echo($row['msgsendername']); ?></td>
            <td><?php echo($row['msgsenderemail']); ?></td>
            <td><?php echo($row['msgtext']); ?></td>
        </tr>
    <?php endforeach;?>
    </table>
    <?php
} catch(PDOException $e) {
    echo("<script>alert('Nem sikerült az üzenetek lekérése!');</script>");
}
?>