<table id="Market1" style="border: 1px solid White; background-color: rgb(250, 252, 251); font-family: Rod; width: 100%; border-collapse: collapse;" align="Center" border="0" cellpadding="4" cellspacing="0">
<tbody>
<?php
if ($_COOKIE["user"] && $_COOKIE["id"])
    {
     print '<tr style="color: Black; background-color: White; font-family: Verdana; font-size: xx-small;">
	    <td colspan="5">Вы зарегистрированы в системе</td></tr>';
    }
else
    {
     print '<tr style="color: Black; background-color: White; font-family: Verdana; font-size: xx-small;">
	    <td>Логин</td><td align="center"><input type="text" name="name" style="width:50px; height:18px; font-size:10px"></td>';
     print '<td>Пароль</td><td align="center"><input type="text" name="pass" style="width:50px; height:18px; font-size:10px"></td>
	    <td align="center" colspan="4"><input type="submit" value="войти" style="font-family: arial;  font-size:10px"></td>
	    </tr>';
    }
?>
</tbody></table>&nbsp;
