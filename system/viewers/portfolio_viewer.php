<h1>Портфолио</h1>
<p>
<table>
    Все проекты в следующей таблице являются вымышленными, поэтому даже не пытайтесь перейти по приведенным ссылкам.
    <tr>
        <td>Год</td>
        <td>Проект</td>
        <td>Описание</td>
    </tr>
    <?php

    foreach ($data as $rowData) {
        echo '<tr><td>' . $rowData['id'] . '</td><td>' . $rowData['login'] . '</td><td>' . $rowData['email'] . '</td></tr>';
    }

    ?>
</table>
</p>
