<!DOCTYPE html>
<html lang="en">
<head>
<title>CS 148 Tables</title>
<meta charset="utf-8">
<meta name="author" content="Madison">
<meta name="description" content="index page for assignment three for sql queries">


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

<p>q01. <a href="q01.php">SQL:</a> select distinct fldCourseName from tblCourses where pmkCourseId in(select distinct fnkCourseId from tblEnrolls where fldGrade = 100) </p>

<p>q02. <a href="q02.php">SQL:</a> SELECT DISTINCT fldDays, fldStart, fldStop FROM tblSections WHERE fldStart <> "00:00:00" AND fnkTeacherNetId IN(SELECT DISTINCT pmkNetId FROM tblTeachers WHERE fldFirstName LIKE "%Robert M%" AND fldLastName LIKE "%Erickson%") </p>

<p>q03. <a href="q03.php">SQL:</a> SELECT DISTINCT fldCourseName, pmkCourseId FROM tblCourses WHERE pmkCourseId IN(SELECT DISTINCT fnkCourseId FROM tblSections WHERE fnkTeacherNetId IN(SELECT DISTINCT pmkNetId FROM tblTeachers WHERE fldFirstName LIKE "%Robert M%" AND fldLastName LIKE "%Erickson%")) </p>

<p>q04. <a href="q04.php">SQL:</a> SELECT fldFirstName, fldLastName FROM tblStudents WHERE pmkStudentId IN(SELECT DISTINCT fnkStudentId FROM tblEnrolls WHERE fnkCourseId IN(SELECT DISTINCT pmkCourseId FROM tblCourses WHERE fldDepartment = "CS" AND fldCourseNumber = "148")) </p>

<p>q05. <a href="q05.php">SQL:</a> SELECT fnkTeacherNetId AS NetID, SUM(fldNumStudents) AS Total FROM tblSections GROUP BY fnkTeacherNetId HAVING SUM(fldNumStudents) BETWEEN 190 AND 200 </p>

<p>q06. <a href="q06.php">SQL:</a> SELECT fldFirstName, fldLastName, COUNT(fnkCourseId) FROM tblStudents, tblEnrolls WHERE pmkStudentId = tblEnrolls.fnkStudentId GROUP BY pmkStudentId HAVING COUNT(fnkCourseId) > 2 </p>

<p>q07. <a href="q07.php">SQL:</a> SELECT fldFirstName, fldPhone, fldSalary FROM tblTeachers WHERE fldSalary < (SELECT AVG(fldSalary) FROM tblTeachers) </p>

<p>q08. <a href="q08.php">SQL:</a> SELECT DISTINCT fldCourseName FROM tblCourses WHERE pmkCourseId IN(SELECT fnkCourseId FROM tblEnrolls WHERE fldGrade = 100) </p>

<p>q09. <a href="q09.php">SQL:</a> SELECT fnkStudentId FROM tblEnrolls WHERE fnkCourseId IN(SELECT DISTINCT fnkCourseId FROM tblSections WHERE fnkTeacherNetId LIKE "%rerickso%") </p>


</body>
</html>