<?
echo "<td class=\"center\">
<form action='/Pages/AdminPanel/Delete.php?id=\"".$row["id"]."\"' method=\"post\">
    <input type=\"hidden\" name=\"id\" value=\"".$row["id"]."\">
    <input type=\"hidden\" name=\"page\" value=\"$page\">
    <input type=\"image\" name=\"submit\" value=\"Delete\" src=\"/pictures/icons/edit.php\" style=\"max-width: 25px;\">
</form>
</td>";
echo "<td class=\"center\">
    <form action='/Pages/AdminPanel/Delete.php?id=\"".$row["id"]."\"' method=\"post\">
        <input type=\"hidden\" name=\"id\" value=\"".$row["id"]."\">
        <input type=\"hidden\" name=\"page\" value=\"$page\">
        <input type=\"image\" name=\"submit\" value=\"Delete\" src=\"/pictures/icons/trash.png\" style=\"max-width: 25px;\">
    </form>
</td>";
?>