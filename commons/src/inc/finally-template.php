<?php
if ($stmt->rowCount() > 0)
	echo "<script>alert('$message')</script>";
else
	echo "<script>alert('An unexpected error occurred. Please try again later.');</script>";
echo "<script>window.location.href = '$redirect';</script>";
$pdo = NULL;
