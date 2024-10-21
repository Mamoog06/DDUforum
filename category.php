﻿<?php
include 'connection.php';
include 'header.php';
$sql = "SELECT 
cat_id, 
cat_name, 
cat_description 
FROM 
categories 
WHERE 
cat_id = " . mysqli_real_escape_string($conn, $_GET['id']);
$result = mysqli_query($conn, $sql);
if(!$result)
{
    echo 'The category could not be displayed, please try again later.' . mysqli_error($conn);
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'This category does not exist.';
    }
    else
    {
        while($row = mysqli_fetch_assoc($result))
        {
            echo '<h2>Posts in ′' . $row['cat_name'] . '′ category</h2>';
        }
        $sql = "SELECT 
        post_id, 
        post_caption,
        post_content,
        post_date, 
        post_cat 
        FROM 
        posts 
        WHERE 
        post_cat = " . mysqli_real_escape_string($conn, $_GET['id']);
        $result = mysqli_query($conn, $sql);
        if(!$result)
        {
            echo 'The posts could not be displayed, please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                echo 'There are no posts in this category yet.';
            }
            else
            {
                echo '<table border="2"> 
                <tr> 
                <th>Posts</th> 
                <th>Created at</th> 
                </tr>';    
                while($row = mysqli_fetch_assoc($result))
                {                
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h3><a href="post.php?id=' . $row['post_id'] . '">' . $row['post_caption'] . '</a></h3>';
                        echo '</td>';
                        echo '<td class="rightpart">';
                            echo date('d-m-Y', strtotime($row['post_date']));
                        echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
        }
    }
}
include 'footer.php';
?>