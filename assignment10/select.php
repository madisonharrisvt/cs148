<!DOCTYPE html>
<html lang="en">
<head>
<title>CS 148 Tables</title>
<meta charset="utf-8">
<meta name="author" content="Madison">
<meta name="description" content="index page for assignment two for sql queries">


<!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
<![endif]-->
    
</head>


<?php

$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");
$path_parts = pathinfo($phpSelf);
print '<body id="' . $path_parts['filename'] . '">';

?>

<p>Assignment 2.0</p>

<p>q01. <a href="q01.php">SQL:</a> SELECT pmkNetID FROM tblTeachers</p>

<p>q02. <a href="q02.php">SQL:</a> SELECT fldDepartment FROM tblCourses WHERE fldCourseName = 'Elementary'</p>

<p>q03. <a href="q03.php">SQL:</a> SELECT * FROM tblSections WHERE fldStart = '15:00:00' AND fldBuilding = 'Kalkin'</p>

<p>q04. <a href="q04.php">SQL:</a> SELECT * FROM tblSections WHERE fldCRN = 92189</p>

<p>q05. <a href="q05.php">SQL:</a>SELECT fldFirstName, fldLastName FROM tblTeachers WHERE pmkNetId LIKE 'r%o'</p>

<p>q06. <a href="q06.php">SQL:</a>SELECT fldCourseName FROM tblCourses WHERE fldCourseName LIKE '%data%' AND fldDepartment <> 'CS'</p>

<p>q07. <a href="q07.php">SQL:</a>SELECT COUNT(DISTINCT fldDepartment) FROM tblCourses</p>

<p>q08. <a href="q08.php">SQL:</a>SELECT fldBuilding, COUNT(fldSection) FROM tblSections GROUP BY fldBuilding</p>

<p>q09. <a href="q09.php">SQL:</a>SELECT fldBuilding, fldNumStudents FROM tblSections WHERE fldDays like '%W%' GROUP BY fldBuilding ORDER BY fldNumStudents DESC</p>

<p>q10. <a href="q10.php">SQL:</a>SELECT fnkCourseId FROM tblSections GROUP BY fnkCourseId HAVING COUNT(fldSection) >= 50;</p>


</body>
</html>