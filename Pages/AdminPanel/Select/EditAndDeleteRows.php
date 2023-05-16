<?
if ($row["id"] == 1 && $page == "Staff") {
    echo "<td class=\"center\">
    <form action='#' method=\"post\">
        <input type=\"image\" name=\"submit\" value=\"Edit\" src=\"/pictures/icons/stop.png\" style=\"max-width: 30px;border: 0;\">
    </form>
    </td>";
    echo "<td class=\"center\">
        <form action='#' method=\"post\">
            <input type=\"image\" name=\"submit\" value=\"Delete\" src=\"/pictures/icons/stop.png\" style=\"max-width: 25px;border: 0;\">
        </form>
    </td>";
} else {
    echo "<td class=\"center\">
    <form action='/Pages/AdminPanel/EditPage.php?id=\"".$row["id"]."\"' method=\"post\">
        <input type=\"hidden\" name=\"id\" value=\"".$row["id"]."\">
        <input type=\"hidden\" name=\"page\" value=\"$page\">
        <input type=\"image\" name=\"submit\" value=\"Edit\" src=\"/pictures/icons/edit_orange.png\" style=\"max-width: 30px;border: 0;\">
    </form>
    </td>";
    echo "<td class=\"center\">
        <form action='/Pages/AdminPanel/Delete.php?id=\"".$row["id"]."\"' method=\"post\">
            <input type=\"hidden\" name=\"id\" value=\"".$row["id"]."\">
            <input type=\"hidden\" name=\"page\" value=\"$page\">
            <input type=\"image\" name=\"submit\" value=\"Delete\" src=\"/pictures/icons/trash.png\" style=\"max-width: 25px;border: 0;\">
        </form>
    </td>";
}
?>