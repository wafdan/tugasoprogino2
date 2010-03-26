<?php

/*
	File		administrator.php
	Deskripsi	Halaman adminstrasi
*/

require_once('includes/session.php');
require_once('includes/administrator.php');

sessionInit();

if(!isAllowed()) {
    header('Location: index.php');
}

function generateOptionFaculty() {
    $data = getFacultyList();

    echo '<option value=""></option>';
    foreach($data as $faculty) {
        echo '<option value="'.$faculty['facultyid'].'">[ '.$faculty['code'].' ] '.$faculty['name'].'</option>';
    }
}

function generateOptionProgram() {
    $data = getProgramList();

    echo '<option value=""></option';
    foreach($data as $program) {
        echo '<option value="'.$program['programid'].'">[ '.$program['facultycode'].' ] ['.$program['code'].'] '.$program['name'].'</option';
    }
}

function generateOptionCourse() {
    $data = getCourseList();

    echo '<option value=""></option>';
    foreach($data as $course) {
        echo '<option value="'.$course['id'].'">[ '.$course['code'].' ] '.$course['name'].'</option>';
    }
}

?>

<html>
    <head>
        <link id="unique-style" rel="stylesheet" type="text/css" href="css/style1.css" />
    </head>

    <body>
        <div id="header">
            <div id="logo">
                <h1>KulOn&trade;</h1>
                <h2><b>Kuliah Online</b></h2>
            </div>
            <div id="menu">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>

                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php
        if(sessionGet('msg')) {
            ?>

			Message:

            <?php
            echo sessionGet('msg');
            sessionUnset('msg');
        }
        ?>

        <div id="container">
            <h1>Course management</h1>
            <div>
		Add Faculty
                <div>
                    <form action="administratorhandler.php" method="post">
                        <input type="hidden" name="action" value="facultyadd" />
                        <table>
                            <tr>
                                <td>Faculty Code</td>
                                <td><input type="text" name="data[facultyadd][code]" size="6" /></td>
                            </tr>
                            <tr>
                                <td>Faculty Name</td>
                                <td><input type="text" name="data[facultyadd][name]" size="48" /></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" value="Add" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>

            <div>
				Edit Faculty
				<div>
					<form action="administratorhandler.php" method="post">
						<input type="hidden" name="action" value="facultymod" />
						<table>
							<tr>
								<td>Faculty</td>
								<td>
									<select name="data[facultymod][facultyid]">
										<?php generateOptionFaculty(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>New Faculty Code</td>
								<td><input type="text" name="data[facultymod][code]" size="6" /></td>
							</tr>
							<tr>
								<td>New Faculty Name</td>
								<td><input type="text" name="data[facultymod][name]" size="48" /></td>
							</tr>
							<tr>
								<td colspan="2"><input type="submit" value="Update" /></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			
			<div>
				Remove Faculty
                <div>
                    <form action="administratorhandler.php" method="post">
                        <input type="hidden" name="action" value="facultydel" />
                        <table>
                            <tr>
                                <td>Faculty</td>
                                <td>
                                    <select name="data[facultydel][facultyid]">
                                        <?php generateOptionFaculty(); ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" value="Remove" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>

            <div>
				Add Program
                <div>
                    <form action="administratorhandler.php" method="post">
                        <input type="hidden" name="action" value="programadd" />
                        <table>
                            <tr>
                                <td>Faculty</td>
                                <td>
                                    <select name="data[programadd][facultyid]">
                                        <?php generateOptionFaculty(); ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Program Code</td>
                                <td><input type="text" name="data[programadd][code]" size="6" /></td>
                            </tr>
                            <tr>
                                <td>Program Name</td>
                                <td><input type="text" name="data[programadd][name]" size="48" /></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" value="Add" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>

            <div>
			Edit Program
				<div>
					<form action="administratorhandler.php" method="post">
						<input type="hidden" name="action" value="programmod" />
						<table>
							<tr>
								<td>Program</td>
								<td>
									<select name="data[programmod][programid]">
										<?php generateOptionProgram(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>New Program Code</td>
								<td><input type="text" name="data[programmod][code]" size="6" /></td>
							</tr>
							<tr>
								<td>New Program Name</td>
								<td><input type="text" name="data[programmod][name]" size="48" /></td>
							</tr>
							<tr>
								<td colspan="2"><input type="submit" value="Update" /></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			
			<div>
				Remove Program
                <div>
                    <form action="administratorhandler.php" method="post">
                        <input type="hidden" name="action" value="programdel" />
                        <table>
                            <tr>
                                <td>Program</td>
                                <td>
                                    <select name="data[programdel][programid]">
                                        <?php generateOptionProgram(); ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" value="Remove" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>

            <div>
				Add course
                <div>
                    <form action="administratorhandler.php" method="post">
                        <input type="hidden" name="action" value="courseadd" />
                        <table>
                            <tr>
                                <td>Program</td>
                                <td>
                                    <select name="data[courseadd][courseprogram]">
                                        <?php generateOptionProgram(); ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Course Code</td>
                                <td><input type="text" name="data[courseadd][coursecode]" size="6" /></td>
                            </tr>
                            <tr>
                                <td>Course Name</td>
                                <td><input type="text" name="data[courseadd][coursename]" size="48" /></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" value="Add" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>

            <div>
				Remove course
                <div>
                    <form action="administratorhandler.php" method="post">
                        <input type="hidden" name="action" value="coursedel" />
                        <table>
                            <tr>
                                <td>Course</td>
                                <td>
                                    <select name="data[coursedel][courseid]">
                                        <?php generateOptionCourse(); ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" value="Remove" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>

            <div>
				Add course instance
                <div>
                    <form action="administratorhandler.php" method="post">
                        <input type="hidden" name="action" value="courseinstadd" />
                        <table>
                            <tr>
                                <td>Course</td>
                                <td>
                                    <select name="data[courseinstadd][courseid]">
                                        <?php generateOptionCourse(); ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Year</td>
                                <td><input type="text" name="data[courseinstadd][year]" size="4" /> / <span></span></td>
                            </tr>
                            <tr>
                                <td>Semester</td>
                                <td>
                                    <select name="data[courseinstadd][semester]">
                                        <option value=""></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" value="Add" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>

            <div>
				Add lecturer
                <div>
                    <form action="administratorhandler.php" method="post">
                        <input type="hidden" name="action" value="courseinstdelegate" />
                        <table>
                            <tr>
                                <td>Course</td>
                                <td>
                                    <select name="data[courseinstdelegate][courseid]">
                                        <?php generateOptionCourse(); ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Year</td>
                                <td><input type="text" name="data[courseinstdelegate][year]" size="4" /> / <span></span></td>
                            </tr>
                            <tr>
                                <td>Semester</td>
                                <td>
                                    <select name="data[courseinstdelegate][semester]">
                                        <option value=""></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>
                                    <input type="text" name="data[courseinstdelegate][username]" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" value="Add" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>

            <div>
				Remove lecturer
                <div>
                    <form action="administratorhandler.php" method="post">
                        <input type="hidden" name="action" value="courseinstdelegaterm" />
                        <table>
                            <tr>
                                <td>Course</td>
                                <td>
                                    <select name="data[courseinstdelegaterm][courseid]">
                                        <?php generateOptionCourse(); ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Year</td>
                                <td><input type="text" name="data[courseinstdelegaterm][year]" size="4" /> / <span></span></td>
                            </tr>
                            <tr>
                                <td>Semester</td>
                                <td>
                                    <select name="data[courseinstdelegaterm][semester]">
                                        <option value=""></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>
                                    <input type="text" name="data[courseinstdelegaterm][username]" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" value="Remove" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div id="footer">
            <p class="legal"><i>Copyright</i> &copy; 2010 KulOn&trade;. <i>All rights reserved</i>. </p>
        </div>
    </body>
</html>