<?php
// Locally copy the uploaded file.
$tokenized_file_name = explode(".", $file_name);
$file_ext = strtolower(end($tokenized_file_name));
$new_file_name = $post_id.".".$file_ext;
$file_dest = "../../public/img/posts/".$new_file_name;
move_uploaded_file($file_tmp_name, $file_dest);
