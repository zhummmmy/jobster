<!DOCTYPE html>
<html>
<html lang="eng">
<head>
	<meta charset="utf-8">
	<title>
		Job Form-Fill
	</title>
</head>

<body style = "background-color : #336666;">

<!--Form Begins-->
<form action='PostJobForm_Redirect.php'>
<!--Table Begins-->
<div align = "center">
<table>
	<tr>
		<td width="200">
			<h4 class= "form_sections"  style="display: inline;"> <font color="white"> Job Title</h4>
		</td>
		<td>
			<input type= "text" placeholder="Job title" name="job_title"></tr>
		</td>
	</tr>
	<tr>
		<td>	
			<h4 class= "form_sections" style="display: inline;"><font color="white">  Salary</h4>
		</td>
		<td>	
			<input type= "text" placeholder="annual salary(in $)" name="job_salary">
		</td>
	</tr>
	<tr>
		<td>		
			<h4 class= "form_sections" style="display: inline;"><font color="white">Qualifications</h4>
		</td>
		<td>	
			<input type= "text" placeholder="Minimum Qualification required" name="job_req" style="height:100px; width:400px;"><br />
		</td>
	</tr>
	<tr>
		<td>	
			<h4 class= "form_sections" style="display: inline;"><font color="white">  Job Description</h4>
		</td>
		<td>	
			<input type= "text" placeholder="Describe Job roles and responsibilities" name="job_desc" style="height:300px; width:400px;">
		</td>
	</tr>
	

	
</table>
<div>
<!--Table ends-->

<input type="submit">
<style>
input[type=submit] {
    width: 20%;
    background-color: #3366FF;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
<style>
</form>
</body>
</html>