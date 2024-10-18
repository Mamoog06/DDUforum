<?php
session_start();
include 'connection.php';
include 'header.php';
$sql = "SELECT 
cat_id, 
cat_name, 
cat_description 
FROM 
categories";
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo 'The categories could not be displayed, please try again later.';
} else {
    if (mysqli_num_rows($result) == 0) {
        echo 'No categories defined yet.';
    } else {
        echo '<table border="2"> 
<tr> 
<th>Category</th> 
<th>Last post</th> 
</tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td class="leftpart">';
            echo '<h3><a href="category.php?id">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
            echo '</td>';
            echo '<td class="rightpart">';
            echo '<a href="post.php?id=">Post caption</a> at 10-10';
            echo '</td>';
            echo '</tr>';
        }
    }
}
include 'footer.php';
?>