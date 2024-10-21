<?php
include 'connection.php';
include 'header.php';
$sql = "SELECT 
post_id, 
post_caption,
post_content,
post_by
FROM 
posts 
WHERE 
post_id = " . mysqli_real_escape_string($conn, $_GET['id']);
$result = mysqli_query($conn, $sql);
if(!$result)
{
    echo 'The post could not be displayed, please try again later.' . mysqli_error($conn);
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'This post does not exist.';
    }
    else
    {
        while($row = mysqli_fetch_assoc($result))
        {
            echo '<h2>Comments in ′' . $row['post_caption'] . '′ post</h2>';
        }
        $sql = "SELECT 
        com_id, 
        com_content,
        com_date, 
        com_post,
        com_by
        FROM 
        comments 
        WHERE 
        com_post = " . mysqli_real_escape_string($conn, $_GET['id']);
        $result = mysqli_query($conn, $sql);
        if(!$result)
        {
            echo 'The comments could not be displayed, please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                echo 'There are no comments on this post yet.';
            }
            else
            {
                echo '<table border="2"> 
                <tr> 
                <th>Comments</th> 
                <th>Created at</th> 
                </tr>';    
                while($row = mysqli_fetch_assoc($result))
                {                
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h5>' . $row['com_id'] . '">' . $row['com_content'] . '</h5>';
                        echo '</td>';
                        echo '<td class="rightpart">';
                            echo date('d-m-Y', strtotime($row['com_date']));
                        echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
            if($_SESSION['signed_in'] == true)
            {
                echo '<a href="comment.php">comment on this post</a>';
            }
        }
    }
}
include 'footer.php';
?>